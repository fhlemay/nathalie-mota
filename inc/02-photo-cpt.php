<?php
function create_photo_post_type()
{
  // Labels for the Post Type
  $labels = array(
    'name'                  => _x('Photos', 'Post type general name', TEXT_DOMAIN),
    'singular_name'         => _x('Photo', 'Post type singular name', TEXT_DOMAIN),
    'menu_name'             => _x('Photos', 'Admin Menu text', TEXT_DOMAIN),
    'name_admin_bar'        => _x('Photo', 'Add New on Toolbar', TEXT_DOMAIN),
    'add_new'               => __('Ajouter photo', TEXT_DOMAIN),
    'add_new_item'          => __('Ajouter nouvelle photo', TEXT_DOMAIN),
    'new_item'              => __('Nouvelle photo', TEXT_DOMAIN),
    'edit_item'             => __('Éditer photo', TEXT_DOMAIN),
    'view_item'             => __('Voir photo', TEXT_DOMAIN),
    'all_items'             => __('Toutes les photos', TEXT_DOMAIN),
    'search_items'          => __('Rechercher photos', TEXT_DOMAIN),
    'parent_item_colon'     => __('Photo parente:', TEXT_DOMAIN),
    'not_found'             => __('Aucune photo trouvée.', TEXT_DOMAIN),
    'not_found_in_trash'    => __('Aucune photo trouvée dans la corbeille.', TEXT_DOMAIN),
    'featured_image'        => _x('Photo couverture', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', TEXT_DOMAIN),
    'set_featured_image'    => _x('Définir la photo couverture', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', TEXT_DOMAIN),
    'remove_featured_image' => _x('Retirer la photo couverture', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', TEXT_DOMAIN),
    'use_featured_image'    => _x('Utiliser comme photo couverture', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', TEXT_DOMAIN),
    'archives'              => _x('Archives des photos', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', TEXT_DOMAIN),
    'insert_into_item'      => _x('Insérer dans photo', 'Overrides the “Insert into post”/“Insert into page” phrase (used when inserting media into a post). Added in 4.4', TEXT_DOMAIN),
    'uploaded_to_this_item' => _x('Téléversé sur cette photo', 'Overrides the “Uploaded to this post”/“Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', TEXT_DOMAIN),
    'filter_items_list'     => _x('Filtrer la liste des photos', 'Screen reader text for the filter links heading on the post type listing screen. Added in 4.4', TEXT_DOMAIN),
    'items_list_navigation' => _x('Navigation liste des photos', 'Screen reader text for the pagination heading on the post type listing screen. Added in 4.4', TEXT_DOMAIN),
    'items_list'            => _x('Liste des photos', 'Screen reader text for the items list heading on the post type listing screen. Added in 4.4', TEXT_DOMAIN),
  );

  // Args for the Post Type
  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array('slug' => 'photo'),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => 5,
    'menu_icon'          => 'dashicons-camera',
    'supports'           => array('title', 'thumbnail', 'custom-fields'),
    'show_in_rest'       => false, // no Gutenberg please!
  );

  // Register the post type
  register_post_type('photo', $args);
}
add_action('init', 'create_photo_post_type');
