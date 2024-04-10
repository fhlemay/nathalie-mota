<?php

add_theme_support('post-thumbnails'); // prise en charge des images mises en avant
add_theme_support('title-tag'); // ajouter auto. le titre du site dans l'en-tête

function nathalie_mota_custom_styles()
{
  wp_enqueue_style('normalize_style', get_stylesheet_directory_uri() . '/assets/css/normalize.css');
  wp_enqueue_style('nathalie-mota-fonts', get_stylesheet_directory_uri() . '/assets/css/fonts.css');
  wp_enqueue_style('nathalie-mota-variables', get_stylesheet_directory_uri() . '/assets/css/variables.css');
  wp_enqueue_style('nathalie-mota-menus', get_stylesheet_directory_uri() . '/assets/css/menus.css');
  // wp_enqueue_style('nathalie-mota-style', get_stylesheet_uri()); // charge style.css
}
add_action('wp_enqueue_scripts', 'nathalie_mota_custom_styles');

register_nav_menus(array(
  'main' => 'Menu Principal',
  'footer' => 'Bas de page',
));
