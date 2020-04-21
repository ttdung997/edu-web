<?php
/**
 * The template for displaying all single posts.
 *
 * @package thim
 */
?>

<div class="page-content">
<?php 
    while ( have_posts() ) : the_post(); ?>
         <?php get_template_part( 'content', 'single' ); ?>
    <?php endwhile; // end of the loop. ?>
</div>