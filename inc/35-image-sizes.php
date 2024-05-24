<?php
// Images sizes



// Tailles de base de WordPress
// update_option('thumbnail_size_w', 150);
// update_option('thumbnail_size_h', 150);
// update_option('medium_size_w', 300);
// update_option('medium_size_h', 300);
// update_option('large_size_w', 768);
// update_option('large_size_h', 768);

/* function disable_default_image_sizes() {
    // Set thumbnail dimensions to zero
    update_option('thumbnail_size_w', 0);
    update_option('thumbnail_size_h', 0);

    // Set medium dimensions to zero
    update_option('medium_size_w', 0);
    update_option('medium_size_h', 0);

    // Set large dimensions to zero
    update_option('large_size_w', 0);
    update_option('large_size_h', 0);

    // Optionally, set medium_large dimensions to zero (used in responsive images)
    update_option('medium_large_size_w', 0);
    update_option('medium_large_size_h', 0);
}
add_action('init', 'disable_default_image_sizes'); */

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
    // add_image_size('custom-size', 800, 600, true); // 800 pixels wide by 600 pixels tall, hard crop mode
    add_image_size('hero-desktop', 1440, 1440, false);
    add_image_size('hero-mobile', 375, 375, false);
}
add_action('after_setup_theme', 'my_custom_sizes');

