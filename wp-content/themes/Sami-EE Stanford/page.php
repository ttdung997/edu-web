<?php
	get_header('page');

if (have_posts()) : while (have_posts()) : the_post(); ?>			
	<h1 class="article-title"><?php the_title(); ?></h1>
	<hr class="page-hr"> 
	<div class="article-content text-justify">
<?php
	//echo wpautop($post_content);
	add_filter('the_content','wpautop');
	the_content();
	
	//$content = get_the_content();
	//echo wpautop( $content );
	
?>
	</div>
<?php
endwhile;
else : ?>

<p><?php _e("Không tồn tại bài viết."); ?></p>

<?php
	endif;
	
	get_footer('page');
?>