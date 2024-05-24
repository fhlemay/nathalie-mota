<?php

function save_custom_fields($post_id)
{

  // Check if it's a valid nonce
  if (
    !isset($_POST['reference_nonce_name'], $_POST['type_nonce_name'])
    || !wp_verify_nonce($_POST['reference_nonce_name'], 'reference_nonce_action')
    || !wp_verify_nonce($_POST['type_nonce_name'], 'type_nonce_action')
  ) {
    return;
  }

  // Check if the current user can edit the post
  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  // Save or Update meta
  if (isset($_POST['type'])) {
    update_post_meta($post_id, 'type', sanitize_text_field($_POST['type']));
  }
  if (isset($_POST['reference'])) {
    update_post_meta($post_id, 'reference', sanitize_text_field($_POST['reference']));
  }
}
add_action('save_post_' . POST_TYPE_SLUG, 'save_custom_fields');
