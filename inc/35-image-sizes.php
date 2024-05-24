<?php
// Images sizes
function remove_default_image_sizes($sizes) {
    unset($sizes['thumbnail']);   // Remove Thumbnail size
    unset($sizes['medium']);      // Remove Medium size
    unset($sizes['large']);       // Remove Large size
    unset($sizes['medium_large']); // Remove Medium Large size (introduced in WP 4.4)
    unset($sizes['1536x1536']); // Introduced in WP 5.3 for responsive image
    unset($sizes['2048x2048']); // Retina
    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'remove_default_image_sizes');

function my_custom_sizes() {
    add_image_size('hero-desktop', 1440, 9999, false);
    add_image_size('hero-mobile', 375, 9999, false);
    add_image_size('photo-card-desktop', 566, 495, true);
    add_image_size('photo-card-mobile', 318, 279, true);
    add_image_size('single-photo-desktop', 566, 9999, false);
    add_image_size('single-photo-mobile', 265, 9999, false);
    add_image_size('photo-nav-thumbnail', 80, 80, true);
}
add_action('after_setup_theme', 'my_custom_sizes');

