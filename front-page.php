<?php


use Timber\Timber;

$current_template = pathinfo(__FILE__, PATHINFO_FILENAME) . '.twig';

$context = Timber::context();

$args = array(
    'post_type' => 'photo',  // custom post type
    'posts_per_page' => 1,  // retrieve only 1 post for the hero image
    'orderby' => 'rand',  // Order posts randomly
    'tax_query' => array(
        array(
            'taxonomy' => 'format',  // query photos that have a specific format...
            'field' => 'slug',  // use term slug for filtering
            'terms' => 'paysage',  // ... paysage (landscape)
        ),
    ),
);

$hero_post_query = new WP_Query($args);

if ($hero_post_query->have_posts()) {
    while ($hero_post_query->have_posts()) {
        $hero_post_query->the_post();
        $post_id = get_the_ID();
        $hero_image_url = get_the_post_thumbnail_url($post_id, 'full');
        $hero_image_alt = get_the_title($post_id);

        $context['hero_image_url'] = $hero_image_url;
        $context['hero_image_alt'] = $hero_image_alt;
    }

    wp_reset_postdata();
} else {
    echo "No photo found";
}

Timber::render($current_template, $context);
