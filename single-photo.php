<?php

use Timber\Timber;

/*
 * On va chercher les post (prev et next) avec la query de wp (WP_Query).
 * Ensuite on va transformer ces posts en post Timber (via id?).
 */

$context = Timber::context();

$post = $context['post'];

$args_prev = array(
    'post_type' => 'photo',
    'posts_per_page' => 1,
    'orderby' => 'date',
    'order' => 'DESC',
    'date_query' => array(
        array(
            'before' => $post->date(),
        ),
        'inclusive' => true,
    ),
    'post__not_in' => array($post->ID),
);

$prev_posts = Timber::get_posts($args_prev);

foreach ($prev_posts as $post) {
    $prev_post = $post;
}

$context['prev_post'] = $prev_post;

$args_next = array(
    'post_type' => 'photo',
    'posts_per_page' => 1,
    'orderby' => 'date',
    'order' => 'DESC',
    'date_query' => array(
        array(
            'after' => $post->date(),
        ),
        'inclusive' => true,
    ),
    'post__not_in' => array($post->ID),
);

$next_posts = Timber::get_posts($args_next);

foreach ($next_posts as $post) {
    $next_post = $post;
}

$context['next_post'] = $next_post;

Timber::render('single-photo.twig', $context);
