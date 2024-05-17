<?php
// https://stackoverflow.com/questions/60589503/moving-wordpress-theme-template-files-to-subdirectory
function relocate() {
    // All available templates from 
    // https://developer.wordpress.org/reference/hooks/type_template_hierarchy/#description
    $predefined_names = [
        '404', 'archive', 'attachment', 'author', 'category', 
        'date', 'embed', 'frontpage', 'home', 'index', 'page', 
        'paged', 'privacypolicy', 'search', 'single', 'singular', 
        'tag', 'taxonomy', 
    ];

    // Iteration over names
    foreach ($predefined_names as $type) {
        // For each name we add filter, using anonymus function
        add_filter("{$type}_template_hierarchy", function ($templates) {
            return array_map(function ($template_name) {
                return "controllers/$template_name";
            }, $templates);
        });
    }
}

// Now simply call our function
relocate();


