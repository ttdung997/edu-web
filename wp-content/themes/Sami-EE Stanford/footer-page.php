	<?php
	if ((is_post_type_archive() && (!is_post_type_archive('seminar'))) || (is_tax())){
		if (function_exists('wp_pagenavi')) wp_pagenavi();
	}
	?>
	</div><!-- #article-main -->
</div><!-- /.row -->
</div><!-- container -->
<?php
	get_footer();
?>
