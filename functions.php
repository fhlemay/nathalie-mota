<?php
// Load Composer dependencies.
require_once __DIR__ . '/vendor/autoload.php';

Timber\Timber::init();

// Sets the directories (inside your theme) to find .twig files.
Timber::$dirname = ['views'];

add_theme_support('post-thumbnails');  // prise en charge des images mises en avant
add_theme_support('title-tag');  // ajouter auto. le titre du site dans l'en-tête

function nathalie_mota_custom_styles()
{
    wp_enqueue_style('nathalie-mota-style', get_stylesheet_uri());  // charge style.css
    wp_enqueue_style('nathalie-mota-fonts', get_stylesheet_directory_uri() . '/assets/css/fonts.css');
    wp_enqueue_style('nathalie-mota-variables', get_stylesheet_directory_uri() . '/assets/css/variables.css');
    wp_enqueue_style('nathalie-mota-site-widths', get_stylesheet_directory_uri() . '/assets/css/site-widths.css');
    wp_enqueue_style('nathalie-mota-menus', get_stylesheet_directory_uri() . '/assets/css/menus.css');
    wp_enqueue_style('nathalie-mota-modal-contact', get_stylesheet_directory_uri() . '/assets/css/modal-contact.css');
    wp_enqueue_style('nathalie-mota-tailwind', get_stylesheet_directory_uri() . '/assets/css/tailwind.css');
}

add_action('wp_enqueue_scripts', 'nathalie_mota_custom_styles');

function nathalie_mota_scripts()
{
    wp_enqueue_script('nathalie-mota-modal-contact-script', get_stylesheet_directory_uri() . '/assets/js/modal-contact.js');
    wp_enqueue_script('nathalie-mota-mobile-menu-script', get_stylesheet_directory_uri() . '/assets/js/mobile-menu.js');
    wp_localize_script('nathalie-mota-mobile-menu-script', 'variables', array(
        'themeUrl' => get_stylesheet_directory_uri(),
    ));
}

add_action('wp_enqueue_scripts', 'nathalie_mota_scripts');

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

function add_contact_link_to_main_nav_menu($items, $args)
{
    if ($args->theme_location == 'main') {
        // Add your custom content here. You can use HTML to format it.
        $custom_text = '<li class="menu-item menu-item-type-custom menu-item-object-custom"><a id="openModal" href="#">Contact</a></li>';

        // Append the custom text to the menu items
        $items .= $custom_text;
    }

    return $items;
}

add_filter('wp_nav_menu_items', 'add_contact_link_to_main_nav_menu', 10, 2);

// Images sizes
// From the beginings : no resize
// add_filter('intermediate_image_sizes_advanced', 'disable_image_resizing');
// function disable_image_resizing($sizes)
// {
//   return [];
// }
// add_filter('big_image_size_threshold', '__return_false');
update_option('thumbnail_size_w', 150);
update_option('thumbnail_size_h', 150);
update_option('medium_size_w', 300);
update_option('medium_size_h', 300);
update_option('large_size_w', 768);
update_option('large_size_h', 768);
