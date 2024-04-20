<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <h1><?php the_title(); ?></h1>
    <div>
    </div>
    <div class="grid grid-cols-2 gap-2">
      <section class="">

        <?php the_terms(get_the_ID(), 'categorie', 'Catégories: ', ', '); ?>
        <?php the_terms(get_the_ID(), 'format', 'Format: ', ', '); ?>
        <?php get_post_meta(get_the_ID(), 'type', true); ?></p>
        <p><strong>Référence:</strong> <?php echo get_post_meta(get_the_ID(), 'reference', true); ?></p>
      </section>
      <section class="">
        <?php has_post_thumbnail() ? the_post_thumbnail('large') : ''; ?>
      </section>
      <section class=""></section>
      <section class=""></section>
    </div>
<?php endwhile;
endif; ?>

<?php get_footer(); ?>
