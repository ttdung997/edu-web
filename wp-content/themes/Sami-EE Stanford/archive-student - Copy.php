<?php
	get_header('student');
	
?>
<div class="container">
<div class="row">
<div class="col-md-3 col-sm-4 block-views" id="sidebar-right">
<?php 
	get_sidebar('student');
?>
</div>
<div class="col-md-7 col-sm-7 well" id="main-content">
	<h1>Thông báo</h1>
	<div class="article-list">
		<?php
			if (have_posts()) :
			while  (have_posts()): the_post();
		?>	
			<div class="article-info">
				<!-- <div class="cat-icon science"><a href="http://news.harvard.edu/gazette/section/science-n-health/">View all posts in Science &amp; Health</a></div> -->
				<div class="date-repeat-instance"><?php echo date('d/m/Y', strtotime($post->post_date)); ?></div>

				<h2 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

			</div>
		<?php
			endwhile;
			endif;
		?>
	</div><!-- article-list -->
</div><!-- main-content -->
	</div><!-- row -->
</div><!-- container -->
<?php
	get_footer();
?>