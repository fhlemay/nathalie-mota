<?php


// use Timber\Timber;
use Timber\Image;

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
        $context['hero'] =  Timber::get_post($post_id);
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


// Initial photo set query parameters (no filter).
$page = 1;
$order = 'DESC';
$categorie = '';
$format = '';

$photos = front_page_query($page, $order, $categorie, $format);

$context['initial_set_photos'] =  $photos;

Timber::render($current_template, $context);
