<?php

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

    $photos = front_page_query($page, $order, $categorie, $format);

    $context = Timber::context();
    $context['photos'] = $photos;
    $context['page'] = $page;
    $html = Timber::compile('/components/photo-cards.twig', $context);

    echo $html;
    exit();

}

add_action('rest_api_init', 'nathalie_mota_register_routes');
