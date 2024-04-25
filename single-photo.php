<?php get_header(); ?>

<?php if (have_posts()):
    while (have_posts()):
        the_post(); ?>
<div class="w-[70%] md:w-[1148px] mx-auto">
    <div class="single-photo-container relative grid grid-cols-1 md:grid-cols-2 gap-5 border-b border-black">
      <section class="single-photo-image order-1 md:order-2">
        <?php has_post_thumbnail() ? the_post_thumbnail('') : ''; ?>
      </section>
      <section class="single-photo-meta order-2 md:order-1 font-spacemono font-regular text-sm tracking-widest uppercase space-y-4 border-b border-black flex flex-col justify-end items-start pb-9">
        <h1 class="text-5xl italic tracking-normal"><?php the_title(); ?></h1>
        <p>Référence : <?php echo get_post_meta(get_the_ID(), 'reference', true); ?></p>
        <p>Catégorie : <?php the_terms(get_the_ID(), 'categorie', '', ', '); ?></p>
        <p>Format : <?php the_terms(get_the_ID(), 'format', '', ', '); ?></p>
        <p>Type : <?php echo get_post_meta(get_the_ID(), 'type', true); ?></p>
        <p>Année : <?php echo get_the_date('Y') ?></p>
      </section>
      <section class="single-contact-button order-3 font-poppins flex flex-col md:flex-row justify-between items-center">
        <p class="font-light text-sm md:flex-1">Cette photo vous intéresse ?</p>
        <button type="button" class="font-spacemono font-regular w-full md:w-64 bg-gray-300 rounded-sm h-12">Contact</button>
      </section>
    <section class="single-photo-nav hidden order-4 md:block">
    <p>Photos navigation</p>
    </section>
  </div>
</div>
<?php
    endwhile;
endif;
?>

<?php get_footer(); ?>
