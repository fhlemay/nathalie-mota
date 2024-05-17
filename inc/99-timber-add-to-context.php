<?php

/**
 * Global Timber context.
 *
 * @param array $context Global context variables.
 */
function add_to_context($context)
{
    // Now, in similar fashion, you add a Timber Menu and send it along to the context.
    $context['main_menu'] = Timber::get_menu('main');
    $context['footer_menu'] = Timber::get_menu('footer');

    return $context;
}
add_filter('timber/context', 'add_to_context');

