<?php

use Timber\Timber;

$current_template = pathinfo(__FILE__, PATHINFO_FILENAME) . '.twig';

$context = Timber::context();

// The custom data attached to each recommanded photo that will send to the template engine
$data = [];

if (have_posts()) {
    while (have_posts()) {
        the_post();

        $post_id = get_the_ID();
        $permalink = get_permalink($post_id);
        $thumbnail_url = get_the_post_thumbnail_url($post_id);
        $meta_reference = get_post_meta($post_id, 'reference', true);
        $terms_categorie = wp_get_post_terms($post_id, 'categorie', ['fields' => 'names']);  // Get categories as names
        // $title = get_the_title();
        // $meta_type = get_post_meta($post_id, 'type', true);
        // $terms_format = wp_get_post_terms($post_id, 'format', ['fields' => 'names']); // Get formats as names
        // $date_year = get_the_date('Y');

        $data[] = [
            'link' => $permalink,
            'thumbnail_src' => $thumbnail_url ? $thumbnail_url : null,
            'reference' => $meta_reference,
            'categorie' => $terms_categorie,
        ];
    }

    // Add the custom data to the related posts in the Timber's context variable
    $context['photos'] = $data;

    wp_reset_postdata();
} else {
    echo 'No photos found.';
}

Timber::render($current_template, $context);
