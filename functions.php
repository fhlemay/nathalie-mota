<?php

add_theme_support('post-thumbnails'); // prise en charge des images mises en avant
add_theme_support('title-tag'); // ajouter auto. le titre du site dans l'en-tête

function nathalie_mota_custom_styles()
{
  wp_enqueue_style('normalize-style', get_stylesheet_directory_uri() . '/assets/css/normalize.css');
  wp_enqueue_style('nathalie-mota-fonts', get_stylesheet_directory_uri() . '/assets/css/fonts.css');
  wp_enqueue_style('nathalie-mota-variables', get_stylesheet_directory_uri() . '/assets/css/variables.css');
  wp_enqueue_style('nathalie-mota-site-widths', get_stylesheet_directory_uri() . '/assets/css/site-widths.css');
  wp_enqueue_style('nathalie-mota-menus', get_stylesheet_directory_uri() . '/assets/css/menus.css');
  // wp_enqueue_style('nathalie-mota-style', get_stylesheet_uri()); // charge style.css
}
add_action('wp_enqueue_scripts', 'nathalie_mota_custom_styles');

register_nav_menus(array(
  'main' => 'Menu Principal',
  'footer' => 'Bas de page',
));

function add_text_to_footer_nav_menu($items, $args)
{
  if ($args->theme_location == 'footer') {
    // Add your custom content here. You can use HTML to format it.
    $custom_text = '<li class="menu-item menu-item-type-custom menu-item-object-custom">Tous droits réservés</li>';

    // Append the custom text to the menu items
    $items .= $custom_text;
  }

  return $items;
}
add_filter('wp_nav_menu_items', 'add_text_to_footer_nav_menu', 10, 2);
