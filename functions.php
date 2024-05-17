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
