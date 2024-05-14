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

    if ($related_posts_query->have_posts()) {

        $related_posts = Timber::get_posts($related_posts_query);

        $context['related_posts'] = $related_posts;

        wp_reset_postdata();
    } else {
        echo 'No photos found.';
    }
}

Timber::render($current_template, $context);
