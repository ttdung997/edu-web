<?php

function seminar_post_type() {
	$labels = array(
		'name'               => _x( 'Seminar', 'post type general name' ),
		'singular_name'      => _x( 'Seminar', 'post type singular name' ),
		'add_new'            => _x( 'Thêm lịch seminar', 'book' ),
		'add_new_item'       => __( 'Thêm lịch seminar' ),
		'edit_item'          => __( 'Sửa' ),
		'new_item'           => __( 'Thêm lịch seminar' ),
		'all_items'          => __( 'Tất cả lịch seminar' ),
		'view_item'          => __( 'Xem lịch seminar' ),
		'search_items'       => __( 'Tìm kiếm lịch seminar' ),
		'not_found'          => __( 'Không tìm thấy lịch seminar' ),
		'not_found_in_trash' => __( 'Không tìm thấy lịch seminar' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Lịch seminar'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Lịch các seminar trong Viện',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-calendar',
		'supports'      => array( ''),
		'rewrite'       => array( 'slug' => 'lich-seminar' ),
		'has_archive'   => true,
		'capability_type' => array('seminar', 'seminars'),
		'capabilities' => array(
				'edit_post' => 'edit_seminar',
				'read_post' => 'read_seminar',
				'delete_post' => 'delete_seminar',
				'read_others_posts' => 'read_others_seminars',
				
				'edit_posts' => 'edit_seminars',
				'edit_others_posts' => 'edit_others_seminars',
				'edit_private_posts' => 'edit_private_seminars',
				'edit_published_posts' => 'edit_published_seminars',
								
				'publish_posts' => 'publish_seminars',
				'read_private_posts' => 'read_private_seminars',
				'delete_posts' => 'delete_seminars',
				'delete_private_posts' => 'delete_private_seminars',
				'delete_published_posts' => 'delete_published_seminars',
				'delete_others_posts' => 'delete_others_seminars',
		),
		'show_ui'            => true,
		'show_in_menu'       => true,
		);
	register_post_type( 'seminar', $args );	
	
	
}
add_action( 'init', 'seminar_post_type' );

function my_taxonomies_seminar() {
	$labels = array(
		'name'              => _x( 'Danh mục seminar', 'taxonomy general name' ),
		'singular_name'     => _x( 'Danh mục seminar', 'taxonomy singular name' ),
		'search_items'      => __( 'Tìm kiếm' ),
		'all_items'         => __( 'Các loại seminar' ),
		'parent_item'       => __( 'Danh mục cha' ),
		'parent_item_colon' => __( 'Danh mục cha:' ),
		'edit_item'         => __( 'Sửa đổi danh mục' ), 
		'update_item'       => __( 'Cập nhật danh mục' ),
		'add_new_item'      => __( 'Thêm mới danh mục' ),
		'new_item_name'     => __( 'Thêm danh mục mới' ),
		'menu_name'         => __( 'Danh mục seminar' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'show_ui' => true,
		'show_in_menu'       => true,
	);
	register_taxonomy( 'seminars', 'seminar', $args );
}

add_action( 'init', 'my_taxonomies_seminar', 0 );

add_seminar_caps();

function add_seminar_caps() {
    // gets the administrator role
    $admins = get_role( 'administrator' );

	$admins->add_cap( 'manage_seminar' );
    $admins->add_cap( 'edit_seminar' ); 
    $admins->add_cap( 'edit_seminars' ); 
    $admins->add_cap( 'edit_others_seminars' ); 
    $admins->add_cap( 'publish_seminars' );
    $admins->add_cap( 'edit_published_seminars' ); 
    $admins->add_cap( 'read_seminar' ); 
    $admins->add_cap( 'read_private_seminars' ); 
    $admins->add_cap( 'delete_seminar' );
    $admins->add_cap( 'delete_published_seminars' );
    $admins->add_cap( 'delete_others_seminars' );
    
    $admins->add_cap( 'manage_seminar_tags' );
    $admins->add_cap( 'edit_seminar_tags' );
    $admins->add_cap( 'delete_seminar_tags' );
    $admins->add_cap( 'assign_seminar_tags' ); 
	
    $content_manager = get_role( 'content-manager' );

	$content_manager->add_cap( 'manage_seminar' );
    $content_manager->add_cap( 'edit_seminar' ); 
    $content_manager->add_cap( 'edit_seminars' ); 
    $content_manager->add_cap( 'edit_others_seminars' ); 
    $content_manager->add_cap( 'publish_seminars' );
    $content_manager->add_cap( 'edit_published_seminars' ); 
    $content_manager->add_cap( 'read_seminar' ); 
    $content_manager->add_cap( 'read_private_seminars' ); 
    $content_manager->add_cap( 'delete_seminar' );
    $content_manager->add_cap( 'delete_published_seminars' );
    $content_manager->add_cap( 'delete_others_seminars' );
    
    $content_manager->add_cap( 'manage_seminar_tags' );
    $content_manager->add_cap( 'edit_seminar_tags' );
    $content_manager->add_cap( 'delete_seminar_tags' );
    $content_manager->add_cap( 'assign_seminar_tags' ); 	
}
?>
