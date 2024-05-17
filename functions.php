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
