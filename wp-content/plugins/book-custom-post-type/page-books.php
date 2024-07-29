<?php
/* Template Name: Books List */

get_header(); ?>

<div class="books-list">
    <?php
    $args = array(
        'post_type' => 'book',
        'posts_per_page' => -1,
    );
    $books = new WP_Query($args);
    if ($books->have_posts()) : ?>
        <ul>
            <?php while ($books->have_posts()) : $books->the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <?php the_post_thumbnail('thumbnail'); ?>
                    <div><?php the_excerpt(); ?></div>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else : ?>
        <p><?php esc_html_e('No books found.'); ?></p>
    <?php endif;
    wp_reset_postdata(); ?>
</div>

<?php get_footer(); ?>