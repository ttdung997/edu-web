<?php

$admins = get_role( 'administrator' );
$admins->add_cap( 'manage_settings' );

$content_manager = get_role( 'content-manager' );
$content_manager->add_cap( 'manage_settings' );

function piklist_add_setting_pages($pages)
{
	$pages[] = array(
		'page_title' => __('Cấu hình')
		,'menu_title' => __('Cấu hình', 'piklist')
		//,'sub_menu' => 'themes.php' //Under Appearance menu
		,'capability' => 'manage_settings'
		,'menu_slug' => 'sami-settings'
		,'setting' => 'sami-settings'
		,'menu_icon' => 'dashicons-admin-generic'
		,'page_icon' => plugins_url('piklist/parts/img/piklist-page-icon-32.png')
		,'single_line' => true
		,'default_tab' => 'Thông tin liên hệ'
		,'save_text' => 'Lưu'
	);
	
	$pages[] = array(
		'page_title' => __('Đặt tin nổi bật')
		,'menu_title' => __('Đặt tin nổi bật', 'piklist')
		,'sub_menu' => 'edit.php?post_type=tin-tuc' //Under Appearance menu
		,'capability' => 'manage_options'
		,'menu_slug' => 'tin-noi-bat'
		,'setting' => 'sami-stickynews-settings'
		,'menu_icon' => 'dashicons-admin-generic'
		,'page_icon' => plugins_url('piklist/parts/img/piklist-page-icon-32.png')
		,'single_line' => true
		,'default_tab' => 'Đặt tin nổi bật'
		,'save_text' => 'Lưu'
	);	
	
	$pages[] = array(
		'page_title' => __('Đặt thông báo nổi bật')
		,'menu_title' => __('Đặt thông báo nổi bật', 'piklist')
		,'sub_menu' => 'edit.php?post_type=thong-bao' //Under Appearance menu
		,'capability' => 'manage_options'
		,'menu_slug' => 'thong-bao-noi-bat'
		,'setting' => 'sami-sticky-notification-settings'
		,'menu_icon' => 'dashicons-admin-generic'
		,'page_icon' => plugins_url('piklist/parts/img/piklist-page-icon-32.png')
		,'single_line' => true
		,'default_tab' => 'Đặt thông báo nổi bật'
		,'save_text' => 'Lưu'
	);		

	return $pages;
}

add_filter('piklist_admin_pages', 'piklist_add_setting_pages');
