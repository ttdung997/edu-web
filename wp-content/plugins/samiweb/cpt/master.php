<?php

function master_post_type() {
	$labels = array(
		'name'               => _x( 'Học viên cao học', 'post type general name' ),
		'singular_name'      => _x( 'Học viên cao học', 'post type singular name' ),
		'add_new'            => _x( 'Thêm Học viên cao học', 'book' ),
		'add_new_item'       => __( 'Thêm Học viên cao học' ),
		'edit_item'          => __( 'Sửa' ),
		'new_item'           => __( 'Thêm Học viên cao học' ),
		'all_items'          => __( 'Tất cả Học viên cao học' ),
		'view_item'          => __( 'Xem Học viên cao học' ),
		'search_items'       => __( 'Tìm kiếm Học viên cao học' ),
		'not_found'          => __( 'Không tìm thấy Học viên cao học' ),
		'not_found_in_trash' => __( 'Không tìm thấy Học viên cao học' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Học viên cao học'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Học viên cao học trong Viện',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array(''),
		'has_archive'   => true,
		'rewrite' => array('slug' => 'hoc-vien-thac-si'),
		'capability_type' => 'post',
		'capabilities' => array(
			'edit_post' => 'edit_master',
			'read_post' => 'read_master',
			'delete_post' => 'delete_master',
			'read_others_posts' => 'read_others_masters',
			
			'edit_posts' => 'edit_masters',
			'edit_others_posts' => 'edit_others_masters',
			'edit_private_posts' => 'edit_private_masters',
			'edit_published_posts' => 'edit_published_masters',
							
			'publish_posts' => 'publish_masters',
			'read_private_posts' => 'read_private_masters',
			'delete_posts' => 'delete_masters',
			'delete_private_posts' => 'delete_private_masters',
			'delete_published_posts' => 'delete_published_masters',
			'delete_others_posts' => 'delete_others_masters',
		),
		'show_ui'            => true,
		'show_in_menu'       => true,
		);
	register_post_type( 'master', $args );	
}
add_action( 'init', 'master_post_type' );

add_master_caps();

function add_master_caps() {
    // gets the administrator role
    $admins = get_role( 'administrator' );

	$admins->remove_cap( 'manage-master' );
	$admins->add_cap( 'manage_master' );
    $admins->add_cap( 'edit_master' ); 
    $admins->add_cap( 'edit_masters' ); 
    $admins->add_cap( 'edit_others_masters' ); 
    $admins->add_cap( 'publish_masters' );
    $admins->add_cap( 'edit_published_masters' ); 
    $admins->add_cap( 'read_master' ); 
    $admins->add_cap( 'read_private_masters' ); 
    $admins->add_cap( 'delete_master' );
    $admins->add_cap( 'delete_published_masters' );
    $admins->add_cap( 'delete_others_masters' );
    
    $admins->add_cap( 'manage_master_tags' );
    $admins->add_cap( 'edit_master_tags' );
    $admins->add_cap( 'delete_master_tags' );
    $admins->add_cap( 'assign_master_tags' );
	
    $content_manager = get_role( 'content-manager' );

	$content_manager->remove_cap( 'manage-master' );
	$content_manager->add_cap( 'manage_master' );
    $content_manager->add_cap( 'edit_master' ); 
    $content_manager->add_cap( 'edit_masters' ); 
    $content_manager->add_cap( 'edit_others_masters' ); 
    $content_manager->add_cap( 'publish_masters' );
    $content_manager->add_cap( 'edit_published_masters' ); 
    $content_manager->add_cap( 'read_master' ); 
    $content_manager->add_cap( 'read_private_masters' ); 
    $content_manager->add_cap( 'delete_master' );
    $content_manager->add_cap( 'delete_published_masters' );
    $content_manager->add_cap( 'delete_others_masters' );
    
    $content_manager->add_cap( 'manage_master_tags' );
    $content_manager->add_cap( 'edit_master_tags' );
    $content_manager->add_cap( 'delete_master_tags' );
    $content_manager->add_cap( 'assign_master_tags' );	
	
    $master_manager = get_role( 'student-list-manager' );

	$master_manager->remove_cap( 'manage-master' );
	$master_manager->add_cap( 'manage_master' );
    $master_manager->add_cap( 'edit_master' ); 
    $master_manager->add_cap( 'edit_masters' ); 
    $master_manager->add_cap( 'edit_others_masters' ); 
    $master_manager->add_cap( 'publish_masters' );
    $master_manager->add_cap( 'edit_published_masters' ); 
    $master_manager->add_cap( 'read_master' ); 
    $master_manager->add_cap( 'read_private_masters' ); 
    $master_manager->add_cap( 'delete_master' );
    $master_manager->add_cap( 'delete_published_masters' );
    $master_manager->add_cap( 'delete_others_masters' );
	
    $master_manager->add_cap( 'assign_master_tags' );
}
?>