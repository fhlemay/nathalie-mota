<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <?php wp_body_open(); ?>

  <header class="header">
    <a class="logo" href="<?php echo home_url('/'); ?>">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-desktop.svg" alt="Logo">
    </a>
    <?php wp_nav_menu(array(
      'theme_location' => 'main',
      'container' => 'nav',
      'menu_class' => 'menu',
    ));
    ?>
  </header>
