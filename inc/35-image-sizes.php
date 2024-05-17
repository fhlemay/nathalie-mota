<?php

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

