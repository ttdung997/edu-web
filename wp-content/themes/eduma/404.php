<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package thim
 */
?>
<section class="error-404 not-found">
	<div class="page-404-content">
		<div class="row">
			<div class="col-xs-6">
				<img src="<?php echo esc_url(get_template_directory_uri() . '/images/image-404.jpg'); ?>" alt="404-page" />
			</div>
			<div class="col-xs-6 text-left">
				<h2><?php echo esc_attr__('404', 'eduma');?><br><span class="thim-color"><?php echo esc_attr__('Không tồn tại nội dung yêu cầu!', 'eduma');?></span></h2>
				<p><?php echo esc_attr__('Rất tiếc, chúng tôi không tìm thấy nội dung bạn yêu cầu. Vui lòng quay lại ', 'eduma');?><a href="<?php echo esc_url(get_home_url()); ?>" class="thim-color"><?php echo esc_attr__('Trang chủ.', 'eduma');?></a></p>
			</div>
		</div>
	</div>
	<!-- .page-content -->
</section>