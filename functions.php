<?php
// Load Composer dependencies.
require_once __DIR__ . '/vendor/autoload.php';


// Include all files in inc
// when you load a file using require_once in functions.php, the contents of that file (such as functions, classes, and global variables) become available throughout your WordPress theme. This includes all template files such as front-page.php, header.php, footer.php, and others.
$inc_dir = get_template_directory() . '/inc/';
$files = glob($inc_dir . '*.php'); // Use glob to get all PHP files in the directory
// Include each file
foreach ($files as $file) {
    if (file_exists($file)) {
        require_once $file;
    }
}



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

function register_menus()
{
    register_nav_menus(array(
        'main' => 'Menu Principal',
        'footer' => 'Bas de page',
    ));
}

add_action('init', 'register_menus');

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






function nathalie_mota_register_routes() {
    register_rest_route('nathalie-mota/v1', '/photos', [
        'methods' => 'GET',
        'callback' => 'nathalie_mota_get_photos',
    ]);
}

function nathalie_mota_get_photos(WP_REST_Request $request) {

    // TO CHECK : when filters state changes, should always be the first page.
    $page = (int)($request->get_param('page') ?? 1);

    // filter parameters
    $categorie = $request->get_param('categorie') ?? '';
    $format = $request->get_param('format') ?? '';
    $order = $request->get_param('order') ?? 'DESC';

    // include get_template_directory() . '/inc/front-page-query.php';
    $photos = front_page_query($page, $order, $categorie, $format);

    $context = Timber::context();
    $context['photos'] = $photos;
    $context['page'] = $page;
    $html = Timber::compile('/components/photo-cards.twig', $context);

    echo $html;
    exit();

}

add_action('rest_api_init', 'nathalie_mota_register_routes');
