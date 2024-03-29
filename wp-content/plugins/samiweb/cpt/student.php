<?php

function student_post_type() {
	$labels = array(
		'name'               => _x( 'Thông báo cho sinh viên', 'post type general name' ),
		'singular_name'      => _x( 'Viết thông báo', 'post type singular name' ),
		'add_new'            => _x( 'Viết thông báo', 'book' ),
		'add_new_item'       => __( 'Viết thông báo' ),
		'edit_item'          => __( 'Sửa thông báo' ),
		'new_item'           => __( 'Viết thông báo mới' ),
		'all_items'          => __( 'Tất cả thông báo' ),
		'view_item'          => __( 'Xem thông báo' ),
		'search_items'       => __( 'Tìm thông báo' ),
		'not_found'          => __( 'Không tìm thấy' ),
		'not_found_in_trash' => __( 'Không tìm thấy thông báo trong thùng rác' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Thông báo cho sinh viên'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our products and product specific data',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-info',
		'supports'      => array( 'title', 'editor'),
		'rewrite'       => array( 'slug' => 'thong-bao-sinh-vien' ),
		'has_archive'   => true,
		'capabilities' => array(
				'edit_post' => 'edit_student',
				'read_post' => 'read_student',
				'delete_post' => 'delete_student',
				'read_others_posts' => 'read_others_students',
				
				'edit_posts' => 'edit_students',
				'edit_others_posts' => 'edit_others_students',
				'edit_private_posts' => 'edit_private_students',
				'edit_published_posts' => 'edit_published_students',
								
				'publish_posts' => 'publish_students',
				'read_private_posts' => 'read_private_students',
				'delete_posts' => 'delete_students',
				'delete_private_posts' => 'delete_private_students',
				'delete_published_posts' => 'delete_published_students',
				'delete_others_posts' => 'delete_others_students',
		),
	);
	register_post_type( 'student', $args );	
	
	add_student_caps();
}
add_action( 'init', 'student_post_type' );

add_student_caps();

function add_student_caps() {
    // gets the administrator role
    $admins = get_role( 'administrator' );

	$admins->add_cap( 'manage_student' );
    $admins->add_cap( 'edit_student' ); 
    $admins->add_cap( 'edit_students' ); 
    $admins->add_cap( 'edit_others_students' ); 
    $admins->add_cap( 'publish_students' );
    $admins->add_cap( 'edit_published_students' ); 
    $admins->add_cap( 'read_student' ); 
    $admins->add_cap( 'read_private_students' ); 
    $admins->add_cap( 'delete_student' );
    $admins->add_cap( 'delete_published_students' );
    $admins->add_cap( 'delete_others_students' );
    
    $admins->add_cap( 'manage_student_tags' );
    $admins->add_cap( 'edit_student_tags' );
    $admins->add_cap( 'delete_student_tags' );
    $admins->add_cap( 'assign_student_tags' ); 
	
    $content_manager = get_role( 'content-manager' );

	$content_manager->add_cap( 'manage_student' );
    $content_manager->add_cap( 'edit_student' ); 
    $content_manager->add_cap( 'edit_students' ); 
    $content_manager->add_cap( 'edit_others_students' ); 
    $content_manager->add_cap( 'publish_students' );
    $content_manager->add_cap( 'edit_published_students' ); 
    $content_manager->add_cap( 'read_student' ); 
    $content_manager->add_cap( 'read_private_students' ); 
    $content_manager->add_cap( 'delete_student' );
    $content_manager->add_cap( 'delete_published_students' );
    $content_manager->add_cap( 'delete_others_students' );
    
    $content_manager->add_cap( 'manage_student_tags' );
    $content_manager->add_cap( 'edit_student_tags' );
    $content_manager->add_cap( 'delete_student_tags' );
    $content_manager->add_cap( 'assign_student_tags' );	
}

?>
