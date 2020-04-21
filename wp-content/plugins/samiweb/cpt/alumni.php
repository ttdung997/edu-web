<?php

function alumni_post_type() {
	$labels = array(
		'name'               => _x( 'Tin tức cho cựu sinh viên', 'post type general name' ),
		'singular_name'      => _x( 'Viết tin', 'post type singular name' ),
		'add_new'            => _x( 'Viết tin', 'book' ),
		'add_new_item'       => __( 'Viết tin' ),
		'edit_item'          => __( 'Sửa tin' ),
		'new_item'           => __( 'Viết tin mới' ),
		'all_items'          => __( 'Tất cả tin' ),
		'view_item'          => __( 'Xem tin' ),
		'search_items'       => __( 'Tìm tin' ),
		'not_found'          => __( 'Không tìm thấy' ),
		'not_found_in_trash' => __( 'Không tìm thấy tin trong thùng rác' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Tin tức, thông báo cựu sinh viên'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our products and product specific data',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-info',
		'supports'      => array( 'title', 'editor'),
		'rewrite'       => array( 'slug' => 'tin-tuc-cuu-sinh-vien' ),
		'has_archive'   => true,
		'capabilities' => array(
				'edit_post' => 'edit_alumni',
				'read_post' => 'read_alumni',
				'delete_post' => 'delete_alumni',
				'read_others_posts' => 'read_others_alumnis',
				
				'edit_posts' => 'edit_alumnis',
				'edit_others_posts' => 'edit_others_alumnis',
				'edit_private_posts' => 'edit_private_alumnis',
				'edit_published_posts' => 'edit_published_alumnis',
								
				'publish_posts' => 'publish_alumnis',
				'read_private_posts' => 'read_private_alumnis',
				'delete_posts' => 'delete_alumnis',
				'delete_private_posts' => 'delete_private_alumnis',
				'delete_published_posts' => 'delete_published_alumnis',
				'delete_others_posts' => 'delete_others_alumnis',
		),
	);
	register_post_type( 'alumni', $args );	
}
add_action( 'init', 'alumni_post_type' );

function my_taxonomies_alumni() {
	$labels = array(
		'name'              => _x( 'Loại tin', 'taxonomy general name' ),
		'singular_name'     => _x( 'Loại tin', 'taxonomy singular name' ),
		'search_items'      => __( 'Tìm kiếm loại tin' ),
		'all_items'         => __( 'Tất cả loại tin' ),
		'parent_item'       => __( 'Danh mục cha' ),
		'parent_item_colon' => __( 'Danh mục cha:' ),
		'edit_item'         => __( 'Sửa loại tin' ), 
		'update_item'       => __( 'Cập nhật loại tin' ),
		'add_new_item'      => __( 'Thêm loại tin' ),
		'new_item_name'     => __( 'Thêm loại tin' ),
		'menu_name'         => __( 'Phân loại tin' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'capabilities' => array(
            'manage_terms' => 'manage_new_tags',
            'edit_terms' => 'edit_new_tags',
            'delete_terms' => 'delete_new_tags',
            'assign_terms' => 'assign_new_tags',
        ),
		
	  'show_admin_column' => true,
	  'rewrite'       => array( 'slug' => 'tin-tuc-thong-bao-cuu-sinh-vien' ),
      'show_ui' => true,
	);
	register_taxonomy( 'alumni_category', 'alumni', $args );
}

add_action( 'init', 'my_taxonomies_alumni', 0 );

add_alumni_caps();

function add_alumni_caps() {
    // gets the administrator role
    $admins = get_role( 'administrator' );

	$admins->add_cap( 'manage_alumni' );
    $admins->add_cap( 'edit_alumni' ); 
    $admins->add_cap( 'edit_alumnis' ); 
    $admins->add_cap( 'edit_others_alumnis' ); 
    $admins->add_cap( 'publish_alumnis' );
    $admins->add_cap( 'edit_published_alumnis' ); 
    $admins->add_cap( 'read_alumni' ); 
    $admins->add_cap( 'read_private_alumnis' ); 
    $admins->add_cap( 'delete_alumni' );
    $admins->add_cap( 'delete_published_alumnis' );
    $admins->add_cap( 'delete_others_alumnis' );
    
    $admins->add_cap( 'manage_alumni_tags' );
    $admins->add_cap( 'edit_alumni_tags' );
    $admins->add_cap( 'delete_alumni_tags' );
    $admins->add_cap( 'assign_alumni_tags' );
	
    $content_manager = get_role( 'content-manager' );

	$content_manager->add_cap( 'manage_alumni' );
    $content_manager->add_cap( 'edit_alumni' ); 
    $content_manager->add_cap( 'edit_alumnis' ); 
    $content_manager->add_cap( 'edit_others_alumnis' ); 
    $content_manager->add_cap( 'publish_alumnis' );
    $content_manager->add_cap( 'edit_published_alumnis' ); 
    $content_manager->add_cap( 'read_alumni' ); 
    $content_manager->add_cap( 'read_private_alumnis' ); 
    $content_manager->add_cap( 'delete_alumni' );
    $content_manager->add_cap( 'delete_published_alumnis' );
    $content_manager->add_cap( 'delete_others_alumnis' );
    
    $content_manager->add_cap( 'manage_alumni_tags' );
    $content_manager->add_cap( 'edit_alumni_tags' );
    $content_manager->add_cap( 'delete_alumni_tags' );
    $content_manager->add_cap( 'assign_alumni_tags' );
	
	
    $alumni_manager = get_role( 'alumni-manager' );

	$alumni_manager->add_cap( 'manage_alumni' );
    $alumni_manager->add_cap( 'edit_alumni' ); 
    $alumni_manager->add_cap( 'edit_alumnis' ); 
    $alumni_manager->add_cap( 'edit_others_alumnis' ); 
    $alumni_manager->add_cap( 'publish_alumnis' );
    $alumni_manager->add_cap( 'edit_published_alumnis' ); 
    $alumni_manager->add_cap( 'read_alumni' ); 
    $alumni_manager->add_cap( 'read_private_alumnis' ); 
    $alumni_manager->add_cap( 'delete_alumni' );
    $alumni_manager->add_cap( 'delete_published_alumnis' );
    $alumni_manager->add_cap( 'delete_others_alumnis' );
    
    $alumni_manager->add_cap( 'assign_alumni_tags' );
}

?>
