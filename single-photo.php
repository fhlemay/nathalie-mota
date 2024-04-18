<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <div>
          <?php the_content(); ?>
          <?php 
          if ( has_post_thumbnail() ) {
    the_post_thumbnail('large');
}
          ?>
<?php the_terms( $post->ID, 'categorie', 'Catégories: ', ', ' ); ?>
<?php the_terms( $post->ID, 'format', 'Format: ', ', ' ); ?>
          
          <p>Custom fields (meta)</p>
          <p><strong>Type:</strong> <?php echo get_post_meta(get_the_ID(), 'type', true); ?></p>
          <p><strong>Référence:</strong> <?php echo get_post_meta(get_the_ID(), 'reference', true); ?></p>
        </div>
<?php endwhile; endif; ?>

<?php get_footer(); ?>
