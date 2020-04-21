<?php

function bieumau_post_type() {
	$labels = array(
		'name'               => _x( 'Biểu mẫu', 'post type general name' ),
		'singular_name'      => _x( 'Biểu mẫu', 'post type singular name' ),
		'add_new'            => _x( 'Thêm biểu mẫu', 'book' ),
		'add_new_item'       => __( 'Thêm biểu mẫu' ),
		'edit_item'          => __( 'Sửa biểu mẫu' ),
		'new_item'           => __( 'Tạo biểu mẫu mới' ),
		'all_items'          => __( 'Tất cả biểu mẫu' ),
		'view_item'          => __( 'Xem biểu mẫu' ),
		'search_items'       => __( 'Tìm kiếm biểu mẫu' ),
		'not_found'          => __( 'Không tìm thấy biểu mẫu' ),
		'not_found_in_trash' => __( 'Không có biểu mẫu nào trong thùng rác' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Biểu mẫu-Quy định'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our products and product specific data',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-media-code',
		'supports'      => array( ''),
		'rewrite'       => array( 'slug' => 'bieu-mau' ),
		'has_archive'   => true,
		'capabilities' => array(
			'edit_post' => 'edit_bieumau',
			'read_post' => 'read_bieumau',
			'delete_post' => 'delete_bieumau',
			'read_others_posts' => 'read_others_bieumaus',
			
			'edit_posts' => 'edit_bieumaus',
			'edit_others_posts' => 'edit_others_bieumaus',
			'edit_private_posts' => 'edit_private_bieumaus',
			'edit_published_posts' => 'edit_published_bieumaus',
							
			'publish_posts' => 'publish_bieumaus',
			'read_private_posts' => 'read_private_bieumaus',
			'delete_posts' => 'delete_bieumaus',
			'delete_private_posts' => 'delete_private_bieumaus',
			'delete_published_posts' => 'delete_published_bieumaus',
			'delete_others_posts' => 'delete_others_bieumaus',
		),
	);
	register_post_type('bieu-mau', $args );	
	
	//add_bieumau_caps();
}

add_action( 'init', 'bieumau_post_type' );

add_bieumau_caps();
function add_bieumau_caps() {
    // gets the administrator role
    $admins = get_role( 'administrator' );

	$admins->add_cap( 'manage_bieu-mau' );
    $admins->add_cap( 'edit_bieumau' ); 
    $admins->add_cap( 'edit_bieumaus' ); 
    $admins->add_cap( 'edit_others_bieumaus' ); 
    $admins->add_cap( 'publish_bieumaus' );
    $admins->add_cap( 'edit_published_bieumaus' ); 
    $admins->add_cap( 'read_bieumau' ); 
    $admins->add_cap( 'read_private_bieumaus' ); 
    $admins->add_cap( 'delete_bieumau' );
    $admins->add_cap( 'delete_published_bieumaus' );
    $admins->add_cap( 'delete_others_bieumaus' );
    
    $admins->add_cap( 'manage_bieumau_tags' );
    $admins->add_cap( 'edit_bieumau_tags' );
    $admins->add_cap( 'delete_bieumau_tags' );
    $admins->add_cap( 'assign_bieumau_tags' );

    $content_manager = get_role( 'content-manager' );

	$content_manager->add_cap( 'manage_bieu-mau' );
    $content_manager->add_cap( 'edit_bieumau' ); 
    $content_manager->add_cap( 'edit_bieumaus' ); 
    $content_manager->add_cap( 'edit_others_bieumaus' ); 
    $content_manager->add_cap( 'publish_bieumaus' );
    $content_manager->add_cap( 'edit_published_bieumaus' ); 
    $content_manager->add_cap( 'read_bieumau' ); 
    $content_manager->add_cap( 'read_private_bieumaus' ); 
    $content_manager->add_cap( 'delete_bieumau' );
    $content_manager->add_cap( 'delete_published_bieumaus' );
    $content_manager->add_cap( 'delete_others_bieumaus' );
    
    $content_manager->add_cap( 'manage_bieumau_tags' );
    $content_manager->add_cap( 'edit_bieumau_tags' );
    $content_manager->add_cap( 'delete_bieumau_tags' );
    $content_manager->add_cap( 'assign_bieumau_tags' );  	
}
?>