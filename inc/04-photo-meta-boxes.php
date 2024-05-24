<?php
// Remove the default meta boxes of custom taxonomies to replace them with a custom versions.
function remove_custom_taxonomies_default_meta_box()
{
  remove_meta_box('tagsdiv-categorie', POST_TYPE_SLUG, 'side');
  remove_meta_box('tagsdiv-format', POST_TYPE_SLUG, 'side');
}
add_action('admin_menu', 'remove_custom_taxonomies_default_meta_box');

// The meta-boxe's order in the admin panel will be the same as the ones here
function add_custom_meta_boxes()
{
  add_meta_box(
    'reference_meta_box',
    __('Référence', TEXT_DOMAIN),
    'reference_meta_box_html',
    POST_TYPE_SLUG,
    'normal',
    'default'
  );

  add_meta_box(
    'categorie_meta_box',
    __('Catégories', TEXT_DOMAIN),
    'categorie_meta_box_html',
    POST_TYPE_SLUG,
    'normal',
    'default'
  );

  add_meta_box(
    'format_meta_box',
    __('Format', TEXT_DOMAIN),
    'format_meta_box_html',
    POST_TYPE_SLUG,
    'normal',
    'default'
  );

  add_meta_box(
    'type_meta_box',
    __('Type', TEXT_DOMAIN),
    'type_meta_box_html',
    POST_TYPE_SLUG,
    'normal',
    'default'
  );
}
add_action('add_meta_boxes', 'add_custom_meta_boxes');

function categorie_meta_box_html($post)
{
  wp_nonce_field('categorie_nonce_action', 'categorie_nonce_name');
  $terms = get_terms(array('taxonomy' => 'categorie', 'hide_empty' => false));
  foreach ($terms as $term) {
    $checked = has_term($term->term_id, 'categorie', $post) ? 'checked' : '';
    echo '<input type="radio" name="categorie" value="' . esc_attr($term->term_id) . '" ' . $checked . '> ' . esc_html($term->name) . '<br />';
  }
}

function format_meta_box_html($post)
{
  wp_nonce_field('format_nonce_action', 'format_nonce_name');
  $terms = get_terms(array('taxonomy' => 'format', 'hide_empty' => false));
  foreach ($terms as $term) {
    $checked = has_term($term->term_id, 'format', $post) ? 'checked' : '';
    echo '<input type="radio" name="format" value="' . esc_attr($term->term_id) . '" ' . $checked . '> ' . esc_html($term->name) . '<br />';
  }
}

function type_meta_box_html($post)
{
  wp_nonce_field('type_nonce_action', 'type_nonce_name');

  $type = get_post_meta($post->ID, 'type', true);

?>
  <p>
    <label for="type">Type:</label>
    <select name="type" id="type">
      <option value="Argentique" <?php selected($type, 'Argentique'); ?>>Argentique</option>
      <option value="Numérique" <?php selected($type, 'Numérique'); ?>>Numérique</option>
    </select>
  </p>
<?php
}

function reference_meta_box_html($post)
{
  wp_nonce_field('reference_nonce_action', 'reference_nonce_name');

  $reference = get_post_meta($post->ID, 'reference', true);

?>
  <p>
    <label for="reference">Référence:</label>
    <input type="text" name="reference" id="reference" value="<?php echo esc_attr($reference); ?>" class="">
  </p>
<?php
}

// Styling meta boxes
// function custom_admin_styles()
// {
//   echo '<style>
//         #custom_categorie_meta_box { 
//             float: left; 
//             width: 40%; 
//             margin-right: 15px;
//         }
//         #custom_format_meta_box { 
//             float: left; 
//             width: 40%; 
//         }
//     </style>';
// }
// add_action('admin_head', 'custom_admin_styles');
