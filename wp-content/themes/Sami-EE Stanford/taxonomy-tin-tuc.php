<?php
	$term =	$wp_query->queried_object;
	$term_name = $term->name;
	$term_id = $term->term_id;
	global $cat_types;
	$cat_types = get_terms('loai-tin', 'hide_empty=0');
?>

<div class="container">
	<div class="row" id="article-list">
		<div class="col-md-9 col-sm-8 well" id="main-content">
			<h1><?php echo $term_name; ?></h1>
			<div class="article-list">
		<?php
			while  (have_posts()): the_post();
		?>	
			<div class="article_item">
				<a href="<?php echo get_permalink(); ?>"><h2 class="article_title"><span>»</span><?php the_title(); ?> <span class="entry_date">(<?php echo date('d/m/Y', strtotime($post->post_date)); ?>)</span></h2></a>
			</div>
		<?php
			endwhile;
		?>
			</div>
		</div><!-- #main-content -->
	<div class="col-md-3 col-sm-4 block-views" id="sidebar-right">
	<?php
		get_sidebar('right');
	?>
	</div><!-- sidebar-right -->
	</div>
</div>
<?php
	get_footer();
?>