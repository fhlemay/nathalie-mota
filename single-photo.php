<?php

use Timber\Timber;

$current_template = pathinfo(__FILE__, PATHINFO_FILENAME) . '.twig';

$context = Timber::context();

// Recommanded photos share the same categorie as the current photo.
// Get the terms of the current photo in the 'categorie' taxonomy.
$current_terms = wp_get_post_terms(get_the_ID(), 'categorie', array('fields' => 'ids'));

if (!empty($current_terms)) {
    // Prepare the arguments for the WP_Query
    $args = array(
        'post_type' => 'photo',  // custom post type
        'posts_per_page' => 2,  // retrieve 2 posts for the recommanded photos
        'orderby' => 'rand',  // Order posts randomly
        'tax_query' => array(
                array(
                    'taxonomy' => 'categorie',  // the taxonomy to query
                    'field' => 'term_id',  // use term IDs for filtering
                    'terms' => $current_terms,  // Pass the obtained term IDs
                ),
        ),
    );

    // Run the WP_Query
    $related_posts_query = new WP_Query($args);

    // The custom data attached to each recommanded photo that will send to the template engine
    $data = [];

    if ($related_posts_query->have_posts()) {
        while($related_posts_query->have_posts()) {
            
            $related_posts_query->the_post();

            $post_id = get_the_ID();
            $permalink = get_permalink($post_id);
            $thumbnail_url = get_the_post_thumbnail_url($post_id);
            $meta_reference = get_post_meta($post_id, 'reference', true);
            $terms_categorie = wp_get_post_terms($post_id, 'categorie', ['fields' => 'names']); // Get categories as names
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
        $context['related_posts'] = $data;

        wp_reset_postdata();

    } else {
        echo 'No photos found.';
    }

}

Timber::render($current_template, $context);
