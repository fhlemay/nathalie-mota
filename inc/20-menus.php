<?php

function register_menus()
{
    register_nav_menus(array(
        'main' => 'Menu Principal',
        'footer' => 'Bas de page',
    ));
}

add_action('init', 'register_menus');
