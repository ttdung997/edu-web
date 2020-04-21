<?php
	get_header();
?>
<div class="container">
<div class="row" id="article-detail">
	<div class="col-md-9 col-sm-8 well" id="article-main">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>			
	<h1 class="article-title"><?php the_title(); ?></h1>
	<div class="article-content">
<?php
	//echo wpautop($post_content);
	the_content();
?>
	</div>
<?php
	endwhile;
	else : ?>
	
	<p><?php _e("Không tồn tại bài viết."); ?></p>
	
	<?php endif; ?>

	</div><!-- #article-main -->

	<div class="col-md-3 col-sm-4 block-views" id="sidebar-right">
<?php
	get_sidebar('right');
?>
	</div><!-- /#sidebar-right -->
</div><!-- /.row -->
</div><!-- container -->
<?php
	get_footer();
?>
