<?php
get_header('page');

if (have_posts()) :
	while  (have_posts()): the_post();
?>
<h1> <?php the_title(); ?></h1>
<hr class="page-hr"> 
<div class="article-content">
	<?php
	$meta_value = get_post_meta($post->ID, 'student_info', true);

	$n_size = sizeof($meta_value);
	?>
	<?php
	for($i = 0; $i < $n_size; $i++){
		$cur_student = $meta_value[$i];
		$thumbnail_images = $cur_student['student_thumbnail_image'];
		$student_name = $cur_student['student_name'];
		$employer_name = $cur_student['employer_name'];
		$supervisor_names = $cur_student['supervisor_names'];
		$subject_title = $cur_student['subject_title'];
		$student_details = $cur_student['student_detail'];
		$subject_img=$cur_student['subject_img'];

			//var_dump($cur_student);
		
		$image = '';
		$image_num = sizeof($thumbnail_images);
		if ($image_num > 0){
			$image = $thumbnail_images[0];
		}

		$file = '';
		$file_num = sizeof($student_details);
		if ($file_num > 0){
			$file = $student_details[0];
		}
		?>
		
			<div class="col-lg-6 col-md-6">
				<div class="row student-info">
					<div class="col-xs-6 col-sm-4">
						<!--<img src="<?php echo wp_get_attachment_url( $image ); ?>" />-->
						<img src="<?=$subject_img?>">
					</div>
					<div class="col-xs-6 col-sm-8 text-justify">
						<div><?php echo $student_name; ?><?php echo $employer_name;?></div>
						<p> <?php echo $supervisor_names; ?></p>
					</div>
				</div>
			</div>
<?php
}
endwhile;
endif;
?>
<?php
get_footer('page');
?>