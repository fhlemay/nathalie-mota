<footer class="footer">
  <?php get_template_part('parts/modal-contact') ?>
  <div class="content">
    <?php wp_nav_menu(array(
      'theme_location' => 'footer',
      'container' => 'nav',
      'menu_class' => 'menu',
    ));
    ?>
  </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>
