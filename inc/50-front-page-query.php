<?php

/*
 * This query has to be identical in different places.
 * front-page controller & rest request's response when Ajax calls from front-page.
 */

function front_page_query($page, $order, $categorie, $format)
{
    $args = [
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'paged' => $page,
        'order' => $order,
    ];

    if ($categorie) {
        $args['tax_query'][] = [
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => $categorie,
        ];
    }

    if ($format) {
        $args['tax_query'][] = [
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $format,
        ];
    }

    return Timber::get_posts($args);
}
