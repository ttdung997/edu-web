<?php
	get_header('page');
?>
			<h1>Tin tức</h1>
			<div class="article-list">
		<?php
			if (have_posts()) :
			while  (have_posts()): the_post();
		?>	
			<div class="article-info">
				<div class="date-repeat-instance"><?php echo date('d/m/Y', strtotime($post->post_date)); ?></div>
				<h2 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>				
			</div>
		<?php
			endwhile;
			endif;
		?>
			</div>
<?php
	get_footer('page');
?>