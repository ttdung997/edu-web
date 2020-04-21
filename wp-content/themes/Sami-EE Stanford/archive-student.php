<?php
	get_header('student');
	
	global $wp_query;
	
	query_posts($wp_query->query_vars);
	
?>
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
			//if (function_exists('wp_corenavi')) wp_corenavi();
			endif;
		?>
	</div><!-- article-list -->
<?php
	get_footer('page');
?>