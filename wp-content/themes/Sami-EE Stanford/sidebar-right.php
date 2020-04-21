<div class="sidebar-module well-1" id="quick-link-nav">
	<h2>Liên kết nhanh </h2>
<?php
	wp_nav_menu( array('menu' => 'primary', 'theme_location' => 'quick-link-nav', 'menu_class'      => 'quick-link-nav vertical-nav nav' ));
?>
</div>

<?php
global $post_type;
if ('' == $post_type){
	$post_type = get_post_type();
}
if ('tin-tuc' == $post_type || 'tin-tuyen-dung' == $post_type){
if ( is_active_sidebar( 'news-categories-widget' ) ) : ?>
<div class="sidebar-module">
<div id="related-article" class="well">
	<h2>Tin tức</h2>
	<?php dynamic_sidebar( 'news-categories-widget' ); ?>
</div>
</div>
<?php endif; }
?>

<?php
if ('thong-bao' == $post_type){
if ( is_active_sidebar( 'notification-categories-widget' ) ) : ?>
<div class="sidebar-module">
<div id="related-article" class="well">
<h2>Thông báo</h2>
	<?php dynamic_sidebar( 'notification-categories-widget' ); ?>
</div>
</div>
<?php endif; }
?>

<!--
<?php
if (!in_array($post_type, array('tin-tuc', 'thong-bao', 'tin-tuyen-dung'))){
if ( is_active_sidebar( 'sidebar-widget-area' ) ) : ?>
<div class="sidebar-module">
<div id="related-article" class="well">
	<?php dynamic_sidebar( 'sidebar-widget-area' ); ?>
</div>
</div>
<?php endif; }
?>
-->