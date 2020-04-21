<?php

function maudon_post_type() {
	$labels = array(
		'name'               => _x( 'Mẫu đơn', 'post type general name' ),
		'singular_name'      => _x( 'Mẫu đơn', 'post type singular name' ),
		'add_new'            => _x( 'Thêm mẫu đơn', 'book' ),
		'add_new_item'       => __( 'Thêm mẫu đơn' ),
		'edit_item'          => __( 'Sửa mẫu đơn' ),
		'new_item'           => __( 'Mẫu đơn mới' ),
		'all_items'          => __( 'Tất cả mẫu đơn' ),
		'view_item'          => __( 'Xem mẫu đơn' ),
		'search_items'       => __( 'Tìm kiếm mẫu đơn' ),
		'not_found'          => __( 'Không tìm thấy mẫu đơn' ),
		'not_found_in_trash' => __( 'Không có mẫu đơn nào trong thùng rác' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Mẫu đơn cho sinh viên'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our products and product specific data',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-media-text',
		'supports'      => array( ''),
		'rewrite'       => array( 'slug' => 'mau-don' ),
		'has_archive'   => true,
		'capabilities' => array(
			'edit_post' => 'edit_maudon',
			'read_post' => 'read_maudon',
			'delete_post' => 'delete_maudon',
			'read_others_posts' => 'read_others_maudons',
			
			'edit_posts' => 'edit_maudons',
			'edit_others_posts' => 'edit_others_maudons',
			'edit_private_posts' => 'edit_private_maudons',
			'edit_published_posts' => 'edit_published_maudons',
							
			'publish_posts' => 'publish_maudons',
			'read_private_posts' => 'read_private_maudons',
			'delete_posts' => 'delete_maudons',
			'delete_private_posts' => 'delete_private_maudons',
			'delete_published_posts' => 'delete_published_maudons',
			'delete_others_posts' => 'delete_others_maudons',
		),
	);
	register_post_type('mau-don', $args );
	
	add_maudon_caps();
}

add_action( 'init', 'maudon_post_type' );

add_maudon_caps();

function add_maudon_caps() {
    // gets the administrator role
    $admins = get_role( 'administrator' );

	$admins->add_cap( 'manage_mau-don' ); 
    $admins->add_cap( 'edit_maudon' ); 
    $admins->add_cap( 'edit_maudons' ); 
    $admins->add_cap( 'edit_others_maudons' ); 
    $admins->add_cap( 'publish_maudons' );
    $admins->add_cap( 'edit_published_maudons' ); 
    $admins->add_cap( 'read_maudon' ); 
    $admins->add_cap( 'read_private_maudons' ); 
    $admins->add_cap( 'delete_maudon' );
    $admins->add_cap( 'delete_published_maudons' );
    $admins->add_cap( 'delete_others_maudons' );
    
    $admins->add_cap( 'manage_maudon_tags' );
    $admins->add_cap( 'edit_maudon_tags' );
    $admins->add_cap( 'delete_maudon_tags' );
    $admins->add_cap( 'assign_maudon_tags' ); 
	
    $content_manager = get_role( 'content-manager' );

	$content_manager->add_cap( 'manage_mau-don' );
    $content_manager->add_cap( 'edit_maudon' ); 
    $content_manager->add_cap( 'edit_maudons' ); 
    $content_manager->add_cap( 'edit_others_maudons' ); 
    $content_manager->add_cap( 'publish_maudons' );
    $content_manager->add_cap( 'edit_published_maudons' ); 
    $content_manager->add_cap( 'read_maudon' ); 
    $content_manager->add_cap( 'read_private_maudons' ); 
    $content_manager->add_cap( 'delete_maudon' );
    $content_manager->add_cap( 'delete_published_maudons' );
    $content_manager->add_cap( 'delete_others_maudons' );
    
    $content_manager->add_cap( 'manage_maudon_tags' );
    $content_manager->add_cap( 'edit_maudon_tags' );
    $content_manager->add_cap( 'delete_maudon_tags' );
    $content_manager->add_cap( 'assign_maudon_tags' ); 	
}
?>
