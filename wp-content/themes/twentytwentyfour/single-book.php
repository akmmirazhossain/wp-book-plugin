<?php
get_header();

while (have_posts()) :
    the_post();
?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        </header>

        <div class="entry-content">
            <?php
            // Display featured image
            if (has_post_thumbnail()) {
                the_post_thumbnail('large');
            }

            // Display book content
            the_content();

            // Display image gallery
            $gallery = get_post_meta(get_the_ID(), '_book_gallery', true);
            if ($gallery) {
                echo '<div class="book-gallery">';
                foreach ($gallery as $image_id) {
                    $image_url = wp_get_attachment_image_url($image_id, 'large');
                    $full_image_url = wp_get_attachment_image_url($image_id, 'full');
                    if (
                        $image_url
                    ) {
                        echo '<a href="' . esc_url($full_image_url) . '" data-fancybox="gallery">';
                        echo '<img src="' . esc_url($image_url) . '" alt="Gallery image" />';
                        echo '</a>';
                    }
                }
                echo '</div>';
            }
            ?>
        </div>
    </article>
<?php
endwhile;

get_footer();
?>