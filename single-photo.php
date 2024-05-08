<?php

use Timber\Timber;

$current_template = pathinfo(__FILE__, PATHINFO_FILENAME) . '.twig';

// Timber's shenanigans
$context = Timber::context();

// Get the terms of the current post in the 'categorie' taxonomy
$current_terms = wp_get_post_terms(get_the_ID(), 'categorie', array('fields' => 'ids'));

// Ensure there are terms associated with the current post
if (!empty($current_terms)) {
    // Prepare the arguments for the WP_Query
    $args = array(
        'post_type' => 'photo',  // Your custom post type
        'posts_per_page' => 2,  // Number of posts to retrieve
        'orderby' => 'rand',  // Order posts randomly
        'tax_query' => array(
            array(
                'taxonomy' => 'categorie',  // The taxonomy to query
                'field' => 'term_id',  // Use term IDs for filtering
                'terms' => $current_terms,  // Pass the obtained term IDs
            ),
        ),
    );

    // Run the WP_Query
    $related_posts_query = new WP_Query($args);

    // Check if posts were found
    if ($related_posts_query->have_posts()) {
        // Convert the results to Timber posts
        $related_posts = Timber::get_posts($related_posts_query);

        $context['related_posts'] = $related_posts;

        // Reset post data after the custom loop
        wp_reset_postdata();
    } else {
        // No related posts found
        echo '<p>No related photos found.</p>';
    }
}

Timber::render($current_template, $context);
