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
    wp_enqueue_style('nathalie-mota-modal-contact', get_stylesheet_directory_uri() . '/assets/css/modal-contact.css');
    wp_enqueue_style('nathalie-mota-tailwind', get_stylesheet_directory_uri() . '/assets/css/tailwind.css');
}

add_action('wp_enqueue_scripts', 'nathalie_mota_custom_styles');

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

function register_my_menus()
{
    register_nav_menus(array(
        'main' => 'Menu Principal',
        'footer' => 'Bas de page',
    ));
}

add_action('init', 'register_my_menus');

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

add_filter('timber/context', 'add_to_context');

/**
 * Global Timber context.
 *
 * @param array $context Global context variables.
 */
function add_to_context($context)
{
    // So here you are adding data to Timber's context object, i.e...
    $context['foo'] = 'I am some other typical value set in your functions.php file, unrelated to the menu';

    // Now, in similar fashion, you add a Timber Menu and send it along to the context.
    $context['main_menu'] = Timber::get_menu('main');
    $context['footer_menu'] = Timber::get_menu('footer');

    return $context;
}





function nathalie_mota_register_routes() {
    register_rest_route('nathalie-mota/v1', '/photos', [
        'methods' => 'GET',
        'callback' => 'nathalie_mota_get_photos',
    ]);
}

function nathalie_mota_get_photos(WP_REST_Request $request) {

    $page = $request->get_param('page');

    $args = [
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'paged' => $page
    ];
    $photos = Timber::get_posts($args);

    $context = Timber::context();
    $context['photos'] = $photos;
    $html = Timber::compile('/components/photo-cards.twig', $context);

    echo $html;
    exit();

}

add_action('rest_api_init', 'nathalie_mota_register_routes');
