<?php


use Timber\Timber;

$current_template = pathinfo(__FILE__, PATHINFO_FILENAME) . '.twig';

$context = Timber::context();

$hero_args = array(
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

$hero_post_query = new WP_Query($hero_args);

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

// Get category taxonomy values
$context['categories'] = get_terms([
    'taxonomy' => 'categorie',
    'hide_empty' => false, // Set to true if you only want categories with posts
]);

// Get format taxonomy values
$context['formats'] = get_terms([
    'taxonomy' => 'format',
    'hide_empty' => false, // Set to true if you only want formats with posts
]);


$tmp_photos = Timber::get_posts([
    'post_type' => 'photo',
    'posts_per_page' => 8, 
]);

$context['tmp_photos'] =  $tmp_photos;

Timber::render($current_template, $context);
