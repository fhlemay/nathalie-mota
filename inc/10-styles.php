<?php

function nathalie_mota_custom_styles()
{
    wp_enqueue_style('nathalie-mota-style', get_stylesheet_uri());  // charge style.css
    wp_enqueue_style('nathalie-mota-fonts', get_stylesheet_directory_uri() . '/assets/css/fonts.css');
    wp_enqueue_style('nathalie-mota-modal-contact', get_stylesheet_directory_uri() . '/assets/css/modal-contact.css');
    wp_enqueue_style('nathalie-mota-tailwind', get_stylesheet_directory_uri() . '/assets/css/tailwind.css');
}

add_action('wp_enqueue_scripts', 'nathalie_mota_custom_styles');
