<?php

function syllabus_post_type() {
	$labels = array(
		'name'               => _x( 'Đề cương môn học', 'post type general name' ),
		'singular_name'      => _x( 'Tạo đề cương mới', 'post type singular name' ),
		'add_new'            => _x( 'Tạo đề cương mới', 'book' ),
		'add_new_item'       => __( 'Tạo đề cương mới' ),
		'edit_item'          => __( 'Sửa đề cương' ),
		'new_item'           => __( 'Tạo đề cương mới' ),
		'all_items'          => __( 'Tất cả đề cương' ),
		'view_item'          => __( 'Xem đề cương' ),
		'search_items'       => __( 'Tìm đề cương' ),
		'not_found'          => __( 'Không tìm thấy' ),
		'not_found_in_trash' => __( 'Không tìm thấy thông báo trong thùng rác' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Đề cương môn học'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our products and product specific data',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-admin-page',
		'supports'      => array( ''),
		'rewrite'       => array( 'slug' => 'de-cuong' ),
		'has_archive'   => true,
		'capabilities' => array(
				'edit_post' => 'edit_syllabus',
				'read_post' => 'read_syllabus',
				'delete_post' => 'delete_syllabus',
				'read_others_posts' => 'read_others_syllabuses',
				
				'edit_posts' => 'edit_syllabuses',
				'edit_others_posts' => 'edit_others_syllabuses',
				'edit_private_posts' => 'edit_private_syllabuses',
				'edit_published_posts' => 'edit_published_syllabuses',
								
				'publish_posts' => 'publish_syllabuses',
				'read_private_posts' => 'read_private_syllabuses',
				'delete_posts' => 'delete_syllabuses',
				'delete_private_posts' => 'delete_private_syllabuses',
				'delete_published_posts' => 'delete_published_syllabuses',
				'delete_others_posts' => 'delete_others_syllabuses',
		),
	);
	register_post_type( 'syllabus', $args );
	
	add_syllabus_caps();
}
add_action( 'init', 'syllabus_post_type' );

add_syllabus_caps();

function add_syllabus_caps() {
    // gets the administrator role
    $admins = get_role( 'administrator' );

	$admins->add_cap( 'manage_syllabus' ); 
    $admins->add_cap( 'edit_syllabus' ); 
    $admins->add_cap( 'edit_syllabuses' ); 
    $admins->add_cap( 'edit_others_syllabuses' ); 
    $admins->add_cap( 'publish_syllabuses' );
    $admins->add_cap( 'edit_published_syllabuses' ); 
    $admins->add_cap( 'read_syllabus' ); 
    $admins->add_cap( 'read_private_syllabuses' ); 
    $admins->add_cap( 'delete_syllabus' );
    $admins->add_cap( 'delete_published_syllabuses' );
    $admins->add_cap( 'delete_others_syllabuses' );
    
    $admins->add_cap( 'manage_syllabus_tags' );
    $admins->add_cap( 'edit_syllabus_tags' );
    $admins->add_cap( 'delete_syllabus_tags' );
    $admins->add_cap( 'assign_syllabus_tags' ); 
	
    $content_manager = get_role( 'content-manager' );

	$content_manager->add_cap( 'manage_syllabus' ); 
    $content_manager->add_cap( 'edit_syllabus' ); 
    $content_manager->add_cap( 'edit_syllabuses' ); 
    $content_manager->add_cap( 'edit_others_syllabuses' ); 
    $content_manager->add_cap( 'publish_syllabuses' );
    $content_manager->add_cap( 'edit_published_syllabuses' ); 
    $content_manager->add_cap( 'read_syllabus' ); 
    $content_manager->add_cap( 'read_private_syllabuses' ); 
    $content_manager->add_cap( 'delete_syllabus' );
    $content_manager->add_cap( 'delete_published_syllabuses' );
    $content_manager->add_cap( 'delete_others_syllabuses' );
    
    $content_manager->add_cap( 'manage_syllabus_tags' );
    $content_manager->add_cap( 'edit_syllabus_tags' );
    $content_manager->add_cap( 'delete_syllabus_tags' );
    $content_manager->add_cap( 'assign_syllabus_tags' );  	
}

?>