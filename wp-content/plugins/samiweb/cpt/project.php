<?php

function project_post_type() {
	$labels = array(
		'name'               => _x( 'Đề tài khoa học', 'post type general name' ),
		'singular_name'      => _x( 'Đề tài', 'post type singular name' ),
		'add_new'            => _x( 'Thêm đề tài', 'book' ),
		'add_new_item'       => __( 'Thêm đề tài' ),
		'edit_item'          => __( 'Sửa' ),
		'new_item'           => __( 'Thêm đề tài' ),
		'all_items'          => __( 'Tất cả đề tài' ),
		'view_item'          => __( 'Xem đề tài' ),
		'search_items'       => __( 'Tìm kiếm đề tài' ),
		'not_found'          => __( 'Không tìm thấy đề tài' ),
		'not_found_in_trash' => __( 'Không tìm thấy đề tài ' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Đề tài'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our products and product specific data',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-admin-page',
		'supports'      => array( ''),
		'has_archive'   => true,
		'rewrite'       => array( 'slug' => 'de-tai' ),
		'capability_type' => 'post',
		'capabilities' => array(
				'edit_post' => 'edit_project',
				'read_post' => 'read_project',
				'delete_post' => 'delete_project',
				'read_others_posts' => 'read_others_projects',
				
				'edit_posts' => 'edit_projects',
				'edit_others_posts' => 'edit_others_projects',
				'edit_private_posts' => 'edit_private_projects',
				'edit_published_posts' => 'edit_published_projects',
								
				'publish_posts' => 'publish_projects',
				'read_private_posts' => 'read_private_projects',
				'delete_posts' => 'delete_projects',
				'delete_private_posts' => 'delete_private_projects',
				'delete_published_posts' => 'delete_published_projects',
				'delete_others_posts' => 'delete_others_projects',
		),
	);
	register_post_type( 'project', $args );	
	
	add_project_caps();
}
add_action( 'init', 'project_post_type' );

function project_type_taxonomies() {
	$labels = array(
		'name'              => _x( 'Loại đề tài', 'taxonomy general name' ),
		'singular_name'     => _x( 'Loại đề tài', 'taxonomy singular name' ),
		'search_items'      => __( 'Tìm kiếm' ),
		'all_items'         => __( 'Các loại đề tài' ),
		'parent_item'       => __( 'Danh mục cha' ),
		'parent_item_colon' => __( 'Danh mục cha:' ),
		'edit_item'         => __( 'Sửa đổi phân loại' ), 
		'update_item'       => __( 'Cập nhật phân loại' ),
		'add_new_item'      => __( 'Thêm mới phân loại' ),
		'new_item_name'     => __( 'Thêm phân loại mới' ),
		'menu_name'         => __( 'Loại đề tài' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'rewrite'       => array( 'slug' => 'loai-de-tai' ),
		'show_ui' => false,
		'show_tagcloud' => false,
		'show_in_nav_menus' => false,
		'show_admin_column' => true,
	);
	register_taxonomy( 'project-type', 'project', $args );
	
	
}

function project_role_taxonomies() {
	$labels = array(
		'name'              => _x( 'Vai trò', 'taxonomy general name' ),
		'singular_name'     => _x( 'Vai trò', 'taxonomy singular name' ),
		'search_items'      => __( 'Tìm kiếm' ),
		'all_items'         => __( 'Tất cả vai trò' ),
		'edit_item'         => __( 'Sửa đổi vai trò' ), 
		'update_item'       => __( 'Cập nhật vai trò' ),
		'add_new_item'      => __( 'Thêm mới phân loại' ),
		'new_item_name'     => __( 'Thêm vai trò' ),
		'menu_name'         => __( 'Quản trị vai trò' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'rewrite'       => array( 'slug' => 'vai-tro' ),
		'show_ui' => false,
		'show_admin_column' => true,
	);
	register_taxonomy( 'project_role', 'project', $args );
}

add_action( 'init', 'project_type_taxonomies', 0 );
add_action( 'init', 'project_role_taxonomies', 0 );

add_project_caps();

function add_project_caps() {
    // gets the administrator role
    $admins = get_role( 'administrator' );

	$admins->add_cap( 'manage_project' );
    $admins->add_cap( 'edit_project' ); 
    $admins->add_cap( 'edit_projects' ); 
    $admins->add_cap( 'edit_others_projects' ); 
    $admins->add_cap( 'publish_projects' );
    $admins->add_cap( 'edit_published_projects' ); 
    $admins->add_cap( 'read_project' ); 
    $admins->add_cap( 'read_private_projects' ); 
    $admins->add_cap( 'delete_project' );
    $admins->add_cap( 'delete_published_projects' );
    $admins->add_cap( 'delete_others_projects' );
    
    $admins->add_cap( 'manage_project_tags' );
    $admins->add_cap( 'edit_project_tags' );
    $admins->add_cap( 'delete_project_tags' );
    $admins->add_cap( 'assign_project_tags' ); 
	
    $content_manager = get_role( 'content-manager' );

	$content_manager->add_cap( 'manage_project' );
    $content_manager->add_cap( 'edit_project' ); 
    $content_manager->add_cap( 'edit_projects' ); 
    $content_manager->add_cap( 'edit_others_projects' ); 
    $content_manager->add_cap( 'publish_projects' );
    $content_manager->add_cap( 'edit_published_projects' ); 
    $content_manager->add_cap( 'read_project' ); 
    $content_manager->add_cap( 'read_private_projects' ); 
    $content_manager->add_cap( 'delete_project' );
    $content_manager->add_cap( 'delete_published_projects' );
    $content_manager->add_cap( 'delete_others_projects' );
    
    $content_manager->add_cap( 'manage_project_tags' );
    $content_manager->add_cap( 'edit_project_tags' );
    $content_manager->add_cap( 'delete_project_tags' );
    $content_manager->add_cap( 'assign_project_tags' );  	
}
?>
