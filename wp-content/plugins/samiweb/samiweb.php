<?php
/*
Plugin Name: SamiWeb
Plugin URI: http://sami.hust.edu.vn
Description: a plugin for the School of Applied Mathematics and Informatics
Version: 1.0
Author: Mr. Nguyen Thai Binh
Author URI: http://thaibinhnguyen.com
License: GPL2
Plugin Type: Piklist
*/

define( 'SAMIWEB_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

load_files();
	
function load_files(){
	require_once( SAMIWEB_PLUGIN_DIR . 'roles.php');
	//require_once( SAMIWEB_PLUGIN_DIR . 'includes/departments.php');
	require_once( SAMIWEB_PLUGIN_DIR . 'cpt/cpt_include.php' );
	require_once( SAMIWEB_PLUGIN_DIR . 'includes/post-custom.php' );
	require_once( SAMIWEB_PLUGIN_DIR . 'includes/menu-order.php');
	require_once( SAMIWEB_PLUGIN_DIR . 'includes/fix-count.php');
	require_once( SAMIWEB_PLUGIN_DIR . 'includes/send-email.php');
	require_once( SAMIWEB_PLUGIN_DIR . 'includes/sami-widgets.php' );
	require_once( SAMIWEB_PLUGIN_DIR . 'includes/admin-custom-style.php' );
	require_once( SAMIWEB_PLUGIN_DIR . 'setting/setting-section.php');
	require_once( SAMIWEB_PLUGIN_DIR . 'export-data/export-data.php');
}	
// Hide Administrator From User List
function isa_pre_user_query($user_search) {
  $user = wp_get_current_user();
  if (!current_user_can('administrator')) { // Is Not Administrator - Remove Administrator
    global $wpdb;

    $user_search->query_where = 
        str_replace('WHERE 1=1', 
            "WHERE 1=1 AND {$wpdb->users}.ID IN (
                 SELECT {$wpdb->usermeta}.user_id FROM $wpdb->usermeta 
                    WHERE {$wpdb->usermeta}.meta_key = '{$wpdb->prefix}capabilities'
                    AND {$wpdb->usermeta}.meta_value NOT LIKE '%administrator%')", 
            $user_search->query_where
        );
  }
}
add_action('pre_user_query','isa_pre_user_query');

function test($actions, $user_object)
{
	if (current_user_can('administrator')) return $actions;
    if ( 'administrator' == $user_object->roles[0]){
		unset($actions['delete']);
		unset($actions['edit']);
	}
    return $actions;
}
add_filter('user_row_actions','test',1,2);

function wpse_80220_filter( $roles ) {
    $current_user = wp_get_current_user();
	unset( $roles['lecturer-alumni'] );
	if (!current_user_can('administrator')){
		unset( $roles['administrator'] );
	}

    return $roles;
}
add_filter( 'editable_roles', 'wpse_80220_filter' );

remove_action( 'welcome_panel', 'wp_welcome_panel' );

function remove_dashboard_widgets() {
	global $wp_meta_boxes;

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );

add_action( 'admin_menu', 'pending_posts_bubble_wpse_89028', 999 );

function pending_posts_bubble_wpse_89028() 
{
    global $menu;

    // Get all post types and remove Attachments from the list
    // Add '_builtin' => false to exclude Posts and Pages
    $args = array( 'public' => true ); 
    $post_types = get_post_types( $args );
    unset( $post_types['attachment'] );

    foreach( $post_types as $pt )
    {
        // Count posts
        $cpt_count = wp_count_posts( $pt );

        if ( $cpt_count->pending ) 
        {
            // Menu link suffix, Post is different from the rest
            $suffix = ( 'post' == $pt ) ? '' : "?post_type=$pt";

            // Locate the key of 
            $key = recursive_array_search_php_91365( "edit.php$suffix", $menu );

            // Not found, just in case 
            if( !$key )
                return;

            // Modify menu item
            $menu[$key][0] .= sprintf(
                '<span class="update-plugins count-%1$s"><span class="plugin-count">%1$s</span></span>',
                $cpt_count->pending 
            );
        }
    }
}

// http://www.php.net/manual/en/function.array-search.php#91365
function recursive_array_search_php_91365( $needle, $haystack ) 
{
    foreach( $haystack as $key => $value ) 
    {
        $current_key = $key;
        if( 
            $needle === $value 
            OR ( 
                is_array( $value )
                && recursive_array_search_php_91365( $needle, $value ) !== false 
            )
        ) 
        {
            return $current_key;
        }
    }
    return false;
}

function register_sami_theme_menu() {
    register_nav_menu( 'top-nav-menu', 'Menu chính' );
    register_nav_menu( 'quick-link-nav', 'Danh sách Liên kết nhanh' );
    register_nav_menu( 'web-lien-ket', 'Web liên kết' );
	register_nav_menu( 'student-page-nav-menu', 'Menu trang sinh viên' );
	register_nav_menu( 'news-nav-menu', 'Menu danh mục tin tức' );
	register_nav_menu( 'notification-nav-menu', 'Menu danh mục thông báo' );
	register_nav_menu( 'header-nav-menu', 'Menu trên header' );
	register_nav_menu( 'alumni-nav-menu', 'Menu cựu sinh viên' );
}
add_action( 'init', 'register_sami_theme_menu' );

add_theme_support('post-thumbnails', array('tin-tuc'));

remove_filter( 'the_content', 'wpautop' );

add_image_size( 'portrait', 300, true );
add_image_size( 'portrait-thumbnail', 100, true );

remove_filter('manage_edit-department_columns',  array('piklist_taxonomy', 'user_taxonomy_column'));

// Add link to personal page to admin bar menu
add_action( 'admin_bar_menu', 'toolbar_link_to_mypage', 999 );

function toolbar_link_to_mypage( $wp_admin_bar ){
	if (!current_user_can('lecturer')) return false;
	global $current_user;
	$site_url = home_url('/');
	$args = array(
		'id'    => 'my_page',
		'title' => '| Xem trang cá nhân',
		'href'  => $site_url . 'giang-vien/?name=' . $current_user->user_login,
		'meta'  => array( 'class' => 'personal_info_page', 'target' => '_blank' ),
	);
	$wp_admin_bar->add_node( $args );
	return true;
}

// Hide update notices to user except admin
function hide_update_notice_to_all_but_admin_users() 
{
    if (!current_user_can('update_core')) {
        remove_action( 'admin_notices', 'update_nag', 3 );
    }
}
add_action( 'admin_notices', 'hide_update_notice_to_all_but_admin_users', 1 );

//Remove nodes from admin bar
function wps_admin_bar() {
    global $wp_admin_bar;
   
    $wp_admin_bar->remove_node('about');
    $wp_admin_bar->remove_node('wporg');
    $wp_admin_bar->remove_node('documentation');
    $wp_admin_bar->remove_node('support-forums');
    $wp_admin_bar->remove_node('feedback');
    //$wp_admin_bar->remove_node('view-site');
	$wp_admin_bar->remove_menu('comments');
	$wp_admin_bar->remove_menu('new-content');
}
add_action( 'wp_before_admin_bar_render', 'wps_admin_bar' );

// Change admin footer text
add_filter('admin_footer_text', 'remove_footer_admin'); //change admin footer text
function remove_footer_admin () {
	echo 'Copyright 2013 Viện Toán ứng dụng và Tin học, ĐHBK Hà Nội. Poweredby <a href="http://www.wordpress.org">Wordpress</a>';
}

// When login, set display name equal to first name + last name
add_action( 'wp_login', 'wpse_9326315_format_user_display_name_on_login' );

function wpse_9326315_format_user_display_name_on_login( $username ) {
    $user = get_user_by( 'login', $username );

    $first_name = get_user_meta( $user->ID, 'first_name', true );
    $last_name = get_user_meta( $user->ID, 'last_name', true );

    $full_name = trim( $first_name . ' ' . $last_name );

	if ( ! empty( $full_name ) && ( $user->data->display_name != $full_name ) ) {
		$userdata = array(
			'ID' => $user->ID,
			'display_name' => $full_name,
		);

		wp_update_user( $userdata );
	}
}

// When register new user, set display name to first name + last name
function set_default_display_name( $user_id ) {
  $user = get_userdata( $user_id );
  $name = sprintf( '%s %s', $user->first_name, $user->last_name );
  $args = array(
    'ID' => $user_id,
    'display_name' => $name,
    'nickname' => $name
  );
  wp_update_user( $args );
}
add_action( 'user_register', 'set_default_display_name' );

/*
user_nickname_is_login( $meta, $user, $update ){
    $meta['nickname'] = $user->user_login;
    return $meta;
}
add_filter( 'insert_user_meta', 'user_nickname_is_login', 10, 3 );
*/
?>