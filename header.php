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
    <div class="content">
      <a class="logo" href="<?php echo home_url('/'); ?>">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" alt="Logo">
      </a>
        <img id="toggle-menu" src="<?php echo get_template_directory_uri(); ?>/assets/img/burger.svg" alt="Burger icon">
      <?php wp_nav_menu(array(
        'theme_location' => 'main',
        'container' => 'nav',
        'container_class' => 'menu-container',
        'menu_class' => 'menu',
      ));
      ?>
    </div>
  </header>
