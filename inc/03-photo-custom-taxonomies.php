<?php

define('POST_TYPE_SLUG', 'photo');

function create_photo_taxonomies()
{

  // Register Taxonomies for the Post Type
  register_taxonomy('categorie', POST_TYPE_SLUG, array(
    'labels' => array(
      'name' => _x('Catégories', 'taxonomy general name', TEXT_DOMAIN),
      'singular_name' => _x('Catégorie', 'taxonomy singular name', TEXT_DOMAIN),
    ),
    'rewrite' => array('slug' => 'categorie'),
    'show_in_rest' => false, // no Gutenberg please!
    'hierarchical' => false,
  ));

  register_taxonomy('format', POST_TYPE_SLUG, array(
    'labels' => array(
      'name' => _x('Formats', 'taxonomy general name', TEXT_DOMAIN),
      'singular_name' => _x('Format', 'taxonomy singular name', TEXT_DOMAIN),
    ),
    'rewrite' => array('slug' => 'format'),
    'show_in_rest' => false, // no Gutenberg please!
    'hierarchical' => false,
  ));

  // New formats to add
  $formats = ['paysage', 'portrait'];
  foreach ($formats as $format) {
    if (!term_exists($format, 'format')) {
      wp_insert_term($format, 'format');
    }
  }

  // New categories to add
  $categories = ['réception', 'concert', 'mariage', 'télévision'];
  foreach ($categories as $category) {
    if (!term_exists($category, 'categorie')) {
      wp_insert_term($category, 'categorie');
    }
  }
}
add_action('init', 'create_photo_taxonomies');


function save_custom_taxonomies_meta($post_id)
{

  // Check if it's a valid nonce
  if (
    !isset($_POST['categorie_nonce_name'], $_POST['format_nonce_name'])
    || !wp_verify_nonce($_POST['categorie_nonce_name'], 'categorie_nonce_action')
    || !wp_verify_nonce($_POST['format_nonce_name'], 'format_nonce_action')
  ) {
    return;
  }

  // Check if the current user can edit the post
  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  // Saving logic for 'categorie' taxonomy
  if (isset($_POST['categorie'])) {
    $categorie = array_map('intval', $_POST['categorie']);
    wp_set_object_terms($post_id, $categorie, 'categorie');
  } else {
    wp_set_object_terms($post_id, [], 'categorie');
  }

  // Saving logic for 'format' taxonomy
  if (!empty($_POST['format'])) {
    $format = intval($_POST['format']);
    wp_set_object_terms($post_id, $format, 'format');
  } else {
    wp_set_object_terms($post_id, [], 'format');
  }
}
add_action('save_post_' . POST_TYPE_SLUG, 'save_custom_taxonomies_meta');
