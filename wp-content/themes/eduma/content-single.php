<?php
/**
 * @package thim
 */

$theme_options_data = get_theme_mods();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<div class="page-content-inner">
		<header class="entry-header">
			<?php the_title( '<h4 class="entry-title">', '</h4>' ); ?>
			<?php thim_entry_meta(); ?>
		</header>
		<?php
		/* Video, Audio, Image, Gallery, Default will get thumb */
		do_action( 'thim_entry_top', 'full' );
		?>
		<!-- .entry-header -->
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</div>
</article>