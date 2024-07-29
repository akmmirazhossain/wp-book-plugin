<?php
/*
Plugin Name: Book Custom Post Type
Description: A simple plugin to create a custom post type for Books with an image gallery.
Version: 1.0
Author: AKM Miraz Hossain
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Register Custom Post Type
function create_book_cpt()
{
    $labels = array(
        'name' => _x('Books', 'Post Type General Name', 'textdomain'),
        'singular_name' => _x('Book', 'Post Type Singular Name', 'textdomain'),
        'menu_name' => __('Books', 'textdomain'),
        'name_admin_bar' => __('Book', 'textdomain'),
        'archives' => __('Book Archives', 'textdomain'),
        'attributes' => __('Book Attributes', 'textdomain'),
        'parent_item_colon' => __('Parent Book:', 'textdomain'),
        'all_items' => __('All Books', 'textdomain'),
        'add_new_item' => __('Add New Book', 'textdomain'),
        'add_new' => __('Add New', 'textdomain'),
        'new_item' => __('New Book', 'textdomain'),
        'edit_item' => __('Edit Book', 'textdomain'),
        'update_item' => __('Update Book', 'textdomain'),
        'view_item' => __('View Book', 'textdomain'),
        'view_items' => __('View Books', 'textdomain'),
        'search_items' => __('Search Book', 'textdomain'),
        'not_found' => __('Not found', 'textdomain'),
        'not_found_in_trash' => __('Not found in Trash', 'textdomain'),
        'featured_image' => __('Featured Image', 'textdomain'),
        'set_featured_image' => __('Set featured image', 'textdomain'),
        'remove_featured_image' => __('Remove featured image', 'textdomain'),
        'use_featured_image' => __('Use as featured image', 'textdomain'),
        'insert_into_item' => __('Insert into Book', 'textdomain'),
        'uploaded_to_this_item' => __('Uploaded to this Book', 'textdomain'),
        'items_list' => __('Books list', 'textdomain'),
        'items_list_navigation' => __('Books list navigation', 'textdomain'),
        'filter_items_list' => __('Filter Books list', 'textdomain'),
    );
    $args = array(
        'label' => __('Book', 'textdomain'),
        'description' => __('A list of all books', 'textdomain'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail'),
        'taxonomies' => array('category', 'post_tag'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'show_in_rest' => true,
    );
    register_post_type('book', $args);
}
add_action('init', 'create_book_cpt', 0);

// Add Image Gallery Meta Box
function book_add_meta_boxes()
{
    add_meta_box(
        'book_gallery',
        __('Image Gallery', 'textdomain'),
        'book_gallery_meta_box_callback',
        'book',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'book_add_meta_boxes');

function book_gallery_meta_box_callback($post)
{
    wp_nonce_field('book_gallery_meta_box', 'book_gallery_meta_box_nonce');
    $gallery = get_post_meta($post->ID, '_book_gallery', true);
    echo '<div id="book-gallery">';
    if ($gallery) {
        foreach ($gallery as $image_id) {
            $image_url = wp_get_attachment_url($image_id);
            echo '<div class="book-gallery-item"><img src="' . esc_url($image_url) . '" /><input type="hidden" name="book_gallery[]" value="' . esc_attr($image_id) . '" /><button class="remove-image">Remove</button></div>';
        }
    }
    echo '</div>';
    echo '<button id="add-image">' . __('Add Image', 'textdomain') . '</button>';
}

function book_save_meta_box_data($post_id)
{
    if (!isset($_POST['book_gallery_meta_box_nonce']) || !wp_verify_nonce($_POST['book_gallery_meta_box_nonce'], 'book_gallery_meta_box')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['book_gallery'])) {
        update_post_meta($post_id, '_book_gallery', array_map('sanitize_text_field', $_POST['book_gallery']));
    } else {
        delete_post_meta($post_id, '_book_gallery');
    }
}
add_action('save_post', 'book_save_meta_box_data');



// SHORTCODE FOR BOOK LIST
function books_list_shortcode($atts)
{
    // Set default attributes and merge with incoming attributes
    $atts = shortcode_atts(
        array(
            'count' => 5, // Default number of books to display
        ),
        $atts,
        'books_list'
    );

    ob_start();

    // Fetch all categories
    $categories = get_terms(array(
        'taxonomy' => 'category',
        'hide_empty' => true,
    ));

    // echo '<div class="book-categories">';
    // echo '<ul class="category-list">';
    // // Add "All" category
    // echo '<li class="category-item"><a href="' . esc_url(remove_query_arg('book_category')) . '">All</a></li>';
    // if (!empty($categories) && !is_wp_error($categories)) {
    //     foreach ($categories as $category) {
    //         echo '<li class="category-item"><a href="' . esc_url(add_query_arg('book_category', $category->slug)) . '">' . esc_html($category->name) . '</a></li>';
    //     }
    // }
    // echo '</ul>';
    // echo '</div>';

    echo '<div class="book-categories">';
    echo '<ul class="category-list">';
    echo '<li class="category-item"><a href="#" data-category="">All</a></li>';
    if (!empty($categories) && !is_wp_error($categories)) {
        foreach ($categories as $category) {
            echo '<li class="category-item"><a href="#" data-category="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</a></li>';
        }
    }
    echo '</ul>';
    echo '</div>';

    echo '<ul class="books-list"></ul>';
    echo '<div class="load-more-container">';
    echo '<button id="load-more-books" data-page="1" data-category="" data-count="' . intval($atts['count']) . '">Load More</button>';
    echo '</div>';

    return ob_get_clean();


    // Check if a specific category is selected
    $category = isset($_GET['book_category']) ? sanitize_text_field($_GET['book_category']) : '';

    $args = array(
        'post_type' => 'book',
        'posts_per_page' => intval($atts['count']),
    );

    if ($category) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $category,
            ),
        );
    }

    $books = new WP_Query($args);
    if ($books->have_posts()) : ?>
        <ul class="books-list">
            <?php while ($books->have_posts()) : $books->the_post(); ?>
                <li class="book-item">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?>
                        <?php the_post_thumbnail('thumbnail'); ?>
                        <div><?php //the_excerpt(); 
                                ?></div>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
        <?php if ($books->found_posts > intval($atts['count'])) : ?>
            <button id="load-more-books" data-page="2" data-category="<?php echo esc_attr($category); ?>" data-count="<?php echo intval($atts['count']); ?>">Load More</button>
        <?php endif; ?>
    <?php else : ?>
        <p><?php esc_html_e('No books found.'); ?></p>
<?php endif;
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('books_list', 'books_list_shortcode');


// AJAX LOADER PHP
function load_more_books()
{
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
    $initial_count = isset($_POST['initial_count']) ? intval($_POST['initial_count']) : 5;
    $posts_per_page = $page === 1 ? $initial_count : 4;

    $args = array(
        'post_type' => 'book',
        'posts_per_page' => $posts_per_page,
        'offset' => $page === 1 ? 0 : $initial_count + (($page - 2) * 4),
    );

    if ($category) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $category,
            ),
        );
    }

    $books = new WP_Query($args);
    ob_start();
    if ($books->have_posts()) :
        while ($books->have_posts()) : $books->the_post();
            echo '<li class="book-item">';
            echo '<a href="' . get_permalink() . '">' . get_the_title();
            echo get_the_post_thumbnail(null, 'thumbnail');
            echo '<div></div></a>';
            echo '</li>';
        endwhile;
    endif;
    wp_reset_postdata();
    $response = array(
        'html' => ob_get_clean(),
        'has_more_posts' => ($books->found_posts > ($page === 1 ? $initial_count : $initial_count + (($page - 1) * 4)))
    );
    wp_send_json($response);
}
add_action('wp_ajax_load_more_books', 'load_more_books');
add_action('wp_ajax_nopriv_load_more_books', 'load_more_books');

// Enqueue scripts and styles for the frontend
function book_frontend_scripts()
{
    wp_enqueue_script('book-frontend-script', plugins_url('/js/book.js', __FILE__), array('jquery'), null, true);
    wp_enqueue_style('book-frontend-style', plugins_url('/css/book.css', __FILE__));

    // Localize the script with new data
    wp_localize_script('book-frontend-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

    // Enqueue Fancybox if on a single book page
    if (is_singular('book')) {
        wp_enqueue_script('fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js', array(), '4.0', true);
        wp_enqueue_style('fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css', array(), '4.0');
    }
}
add_action('wp_enqueue_scripts', 'book_frontend_scripts');
