<?php

function student_post_type() {
	$labels = array(
		'name'               => _x( 'Dành cho sinh viên', 'post type general name' ),
		'singular_name'      => _x( 'Thêm bài viết', 'post type singular name' ),
		'add_new'            => _x( 'Thêm bài viết', 'book' ),
		'add_new_item'       => __( 'Thêm bài viết' ),
		'edit_item'          => __( 'Sửa bài viết' ),
		'new_item'           => __( 'Thêm bài viết mới' ),
		'all_items'          => __( 'Tất cả bài viết' ),
		'view_item'          => __( 'Xem bài viết' ),
		'search_items'       => __( 'Tìm bài viết' ),
		'not_found'          => __( 'Không tìm thấy' ),
		'not_found_in_trash' => __( 'Không tìm thấy bài viết trong thùng rác' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Dành cho sinh viên'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our products and product specific data',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt'),
		'has_archive'   => true,
		'capabilities' => array(
			'publish_posts' => 'publish_students',
			'edit_posts' => 'edit_students',
			'edit_others_posts' => 'edit_others_students',
			'delete_posts' => 'delete_students',
			'delete_others_posts' => 'delete_others_students',
			'read_private_posts' => 'read_private_students',
			'edit_post' => 'edit_student',
			'delete_post' => 'delete_student',
			'read_post' => 'read_student',
			'publish_post' => 'publish_student',
		),
	);
	register_post_type( 'student', $args );	
}
add_action( 'init', 'student_post_type' );

function student_categories() {
	$labels = array(
		'name'              => _x( 'Tất cả danh mục', 'taxonomy general name' ),
		'singular_name'     => _x( 'Danh mục', 'taxonomy singular name' ),
		'search_items'      => __( 'Tìm kiếm danh mục' ),
		'all_items'         => __( 'Tất cả danh mục' ),
		'parent_item'       => __( 'Danh mục cha' ),
		'parent_item_colon' => __( 'Danh mục cha:' ),
		'edit_item'         => __( 'Sửa danh mục' ), 
		'update_item'       => __( 'Cập nhật danh mục' ),
		'add_new_item'      => __( 'Thêm danh mục' ),
		'new_item_name'     => __( 'Thêm danh mục' ),
		'menu_name'         => __( 'Danh mục' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'priority' => 1,
	);
	register_taxonomy( 'sinh-vien', 'student', $args );
}

add_action( 'init', 'student_categories', 0 );
?>