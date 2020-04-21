
<?php
	get_header('page');
?>

<?php
if ( function_exists('yoast_breadcrumb') ) {
yoast_breadcrumb('
<p id="breadcrumbs">','</p>
');
}
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>			
		<h1 class="article-title"><?php the_title(); ?></h1>
		<div class="article-content">
	<?php
		//echo wpautop($post_content);
		if (in_array(get_post_type(), array('tin-tuc-dao-tao', 'tin_tuc_dao_tao', 'tin-tuc', 'thong-bao', 'tin-tuyen-dung'))){
	?>
		<div class="date-repeat-instance"><?php the_time('d/m/Y'); ?></div>
	<?php
			$content = get_the_content();
			echo wpautop( $content );//the_content();
		}elseif (in_array(get_post_type(), array('project'))){
			$summary = get_post_meta(get_the_ID(), 'SAMI_PROJECTS_project_summary', true);
			echo wpautop( $summary );
		}else{
			get_template_part('content', get_post_type( ));

		}
if (in_array(get_post_type(), array('thong-bao', 'student', 'page', 'alumni', 'tin-tuyen-dung'))){
	$files = rwmb_meta( 'SAMI_POSTS_file', 'type=file' );
	if (sizeof($files) > 0){
?>
<div class="post_attach_file">
<p style="font-weight: bold; margin-bottom: 0px;">File đính kèm</p>
<?php
	
	foreach ( $files as $info )
	{
		echo "<a href='{$info['url']}' title='{$info['title']}'>{$info['name']}</a><br />";
	}
?>
</div>
<?php
}
}
?>
	
		</div>
	<?php
		endwhile;
		else : ?>
		
		<p><?php _e("Không tồn tại bài viết."); ?></p>
		
		<?php endif; ?>
<br/>

<div id="more-article">
<h3>Đánh giá bài viết</h3>
<?php if(function_exists("kk_star_ratings")) : echo kk_star_ratings($pid); endif; ?>
</div>
<br/>
<div id="more-article">
<h3>Xem thêm</h3>

<?php

global $post;
$current_post = $post; 

for($i = 1; $i <= 3; $i++){
  $post = get_previous_post(); // this uses $post->ID
  if (isset($post)){
  setup_postdata($post);
  if (get_the_title() != ''){
?>

<div title="<?php the_title(); ?>" style="display: table;"><span class="date-repeat-instance" style="display: table-cell; width: 70px;"><?php echo date('d/m/Y', strtotime($post->post_date)); ?>.</span> <a href="<?php echo get_permalink(); ?>" style="display: table-cell;"><?php the_title(); ?></a></div>

<?php
	}
}
}
$post = $current_post;
for($i = 1; $i <= 3; $i++){
  $post = get_next_post(); // this uses $post->ID
  if (isset($post)){
  setup_postdata($post);
  if (get_the_title() != ''){
?>

<div title="<?php the_title(); ?>" style="display: table;"><span class="date-repeat-instance" style="display: table-cell; width: 70px;"><?php echo date('d/m/Y', strtotime($post->post_date)); ?>.</span> <a href="<?php echo get_permalink(); ?>" style="display: table-cell;"><?php the_title(); ?></a></div>
 
<?php
	}
	}
}
$post = $current_post;

?>



</div><!-- more-article -->


<?php
	get_footer('page');
?>
