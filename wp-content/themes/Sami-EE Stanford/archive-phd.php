<?php
	get_header('page');
	
?>
	<h1>Nghiên cứu sinh các khóa</h1>
	<div class="article-list">
	<ol class="file-list">
	<?php
		if (have_posts()) : while (have_posts()) : the_post();
	?>
	<li class="file-info">
		<h2 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	</li>
	<?php
		endwhile;
		endif;
	?>
	</ol>
	</div><!-- article-list -->
<?php
	get_footer('page');
?>