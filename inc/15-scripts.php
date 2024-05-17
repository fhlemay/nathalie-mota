<?php

function nathalie_mota_scripts()
{
    wp_enqueue_script('alpinejs', get_stylesheet_directory_uri() . '/assets/js/alpine.min.js');
    wp_enqueue_script('htmx', get_stylesheet_directory_uri() . '/assets/js/htmx.min.js');
}

add_action('wp_enqueue_scripts', 'nathalie_mota_scripts');

// Add defer to Alpine.js script : differ the script exec to the end of the document
function add_defer_attribute($tag, $handle)
{
    if ('alpinejs' !== $handle)
        return $tag;
    return str_replace(' src', ' defer="defer" src', $tag);
}

add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);
