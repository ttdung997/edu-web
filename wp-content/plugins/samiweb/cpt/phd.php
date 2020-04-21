<?php

function phdstudent_post_type() {
	$labels = array(
		'name'               => _x( 'Nhóm nghiên cứu sinh', 'post type general name' ),
		'singular_name'      => _x( 'Nhóm nghiên cứu sinh', 'post type singular name' ),
		'add_new'            => _x( 'Thêm Nhóm nghiên cứu sinh', 'book' ),
		'add_new_item'       => __( 'Thêm Nhóm nghiên cứu sinh' ),
		'edit_item'          => __( 'Sửa' ),
		'new_item'           => __( 'Thêm Nhóm nghiên cứu sinh' ),
		'all_items'          => __( 'Tất cả Nhóm nghiên cứu sinh' ),
		'view_item'          => __( 'Xem Nhóm nghiên cứu sinh' ),
		'search_items'       => __( 'Tìm kiếm Nhóm nghiên cứu sinh' ),
		'not_found'          => __( 'Không tìm thấy Nhóm nghiên cứu sinh' ),
		'not_found_in_trash' => __( 'Không tìm thấy Nhóm nghiên cứu sinh' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Các nhóm nghiên cứu sinh'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Nhóm nghiên cứu sinh trong Viện',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array(''),
		'has_archive'   => true,
		'rewrite' => array('slug' => 'nghien-cuu-sinh'),
		'capability_type' => 'post',
		'capabilities' => array(
			'edit_post' => 'edit_phdstudent',
			'read_post' => 'read_phdstudent',
			'delete_post' => 'delete_phdstudent',
			'read_others_posts' => 'read_others_phdstudents',
			
			'edit_posts' => 'edit_phdstudents',
			'edit_others_posts' => 'edit_others_phdstudents',
			'edit_private_posts' => 'edit_private_phdstudents',
			'edit_published_posts' => 'edit_published_phdstudents',
							
			'publish_posts' => 'publish_phdstudents',
			'read_private_posts' => 'read_private_phdstudents',
			'delete_posts' => 'delete_phdstudents',
			'delete_private_posts' => 'delete_private_phdstudents',
			'delete_published_posts' => 'delete_published_phdstudents',
			'delete_others_posts' => 'delete_others_phdstudents',
		),
		'show_ui'            => true,
		'show_in_menu'       => true,
		);
	register_post_type( 'phd', $args );	
}
add_action( 'init', 'phdstudent_post_type' );

add_phdstudent_caps();

function add_phdstudent_caps() {
    // gets the administrator role
    $admins = get_role( 'administrator' );

	$admins->remove_cap( 'manage-phd' );
	$admins->add_cap( 'manage_phd' );
    $admins->add_cap( 'edit_phdstudent' ); 
    $admins->add_cap( 'edit_phdstudents' ); 
    $admins->add_cap( 'edit_others_phdstudents' ); 
    $admins->add_cap( 'publish_phdstudents' );
    $admins->add_cap( 'edit_published_phdstudents' ); 
    $admins->add_cap( 'read_phdstudent' ); 
    $admins->add_cap( 'read_private_phdstudents' ); 
    $admins->add_cap( 'delete_phdstudent' );
    $admins->add_cap( 'delete_published_phdstudents' );
    $admins->add_cap( 'delete_others_phdstudents' );
    
    $admins->add_cap( 'manage_phdstudent_tags' );
    $admins->add_cap( 'edit_phdstudent_tags' );
    $admins->add_cap( 'delete_phdstudent_tags' );
    $admins->add_cap( 'assign_phdstudent_tags' );
	
    $content_manager = get_role( 'content-manager' );

	$content_manager->remove_cap( 'manage-phdstudent' );
	$content_manager->add_cap( 'manage_phd' );
    $content_manager->add_cap( 'edit_phdstudent' ); 
    $content_manager->add_cap( 'edit_phdstudents' ); 
    $content_manager->add_cap( 'edit_others_phdstudents' ); 
    $content_manager->add_cap( 'publish_phdstudents' );
    $content_manager->add_cap( 'edit_published_phdstudents' ); 
    $content_manager->add_cap( 'read_phdstudent' ); 
    $content_manager->add_cap( 'read_private_phdstudents' ); 
    $content_manager->add_cap( 'delete_phdstudent' );
    $content_manager->add_cap( 'delete_published_phdstudents' );
    $content_manager->add_cap( 'delete_others_phdstudents' );
    
    $content_manager->add_cap( 'manage_phdstudent_tags' );
    $content_manager->add_cap( 'edit_phdstudent_tags' );
    $content_manager->add_cap( 'delete_phdstudent_tags' );
    $content_manager->add_cap( 'assign_phdstudent_tags' );	
	
    $phdstudent_manager = get_role( 'student-list-manager' );

	$phdstudent_manager->remove_cap( 'manage-hoc-vien' );
	$phdstudent_manager->add_cap( 'manage_phd' );
    $phdstudent_manager->add_cap( 'edit_phdstudent' ); 
    $phdstudent_manager->add_cap( 'edit_phdstudents' ); 
    $phdstudent_manager->add_cap( 'edit_others_phdstudents' ); 
    $phdstudent_manager->add_cap( 'publish_phdstudents' );
    $phdstudent_manager->add_cap( 'edit_published_phdstudents' ); 
    $phdstudent_manager->add_cap( 'read_phdstudent' ); 
    $phdstudent_manager->add_cap( 'read_private_phdstudents' ); 
    $phdstudent_manager->add_cap( 'delete_phdstudent' );
    $phdstudent_manager->add_cap( 'delete_published_phdstudents' );
    $phdstudent_manager->add_cap( 'delete_others_phdstudents' );
	
    $phdstudent_manager->add_cap( 'assign_phdstudent_tags' ); 
}
?>