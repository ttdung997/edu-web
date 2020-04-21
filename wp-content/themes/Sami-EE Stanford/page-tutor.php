<?php
/*
Template Name: Trang cố vấn học tập
*/

get_header('tutor');

if (have_posts()) : while (have_posts()) : the_post(); ?>			
	<h1 class="article-title"><?php the_title(); ?></h1>
	<div class="article-content">
<?php
	//echo wpautop($post_content);
	add_filter('the_content', 'wpautop');
	the_content();
	//$content = get_the_content();	
	//echo wpautop( $content );
	
	$files = rwmb_meta( 'SAMI_POSTS_file', 'type=file' );
?>
	<div class="row">
<?php
	foreach ( $files as $info ){
?>
		<div class="col-sm-4 col-xs-6"><p class="article-title"><a href="<?php echo $info['url']; ?>"><?php echo $info['name']; ?></a></p></div>
<?php
	}
?>
	</div>
	</div>
<?php
	endwhile;
	else : ?>
	
	<p><?php _e("Không tồn tại bài viết."); ?></p>
	
	<?php endif;
	
	get_footer('page');
?>
