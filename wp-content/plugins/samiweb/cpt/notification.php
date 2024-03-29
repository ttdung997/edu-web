<?php
function notification_post_type() {
	$labels = array(
		'name'               => _x( 'Thông báo', 'post type general name' ),
		'singular_name'      => _x( 'Thông báo', 'post type singular name' ),
		'add_new'   => _x( 'Viết thông báo', 'book' ),
		'add_new_item'  => __( 'Viết thông báo mới' ),
		'edit_item'          => __( 'Sửa thông báo' ),
		'new_item'  => __( 'Thông báo mới' ),
		'all_items'          => __( 'Tất cả thông báo' ),
		'view_item'          => __( 'Xem thông báo' ),
		'search_items'       => __( 'Tìm kiếm thông báo' ),
		'not_found'          => __( 'Không tìm thấy thông báo' ),
		'not_found_in_trash' => __( 'Không có thông báo nào trong thùng rác' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Thông báo'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Đăng các thông báo của viện',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-pressthis',
		'rewrite' => array('slug' => 'thong-bao'),
		'supports'      => array('title', 'editor'),
		'has_archive'   => true,
		'capabilities' => array(
			'edit_post' => 'edit_notification',
			'read_post' => 'read_notification',
			'delete_post' => 'delete_notification',
			'read_others_posts' => 'read_others_notifications',
			
			'edit_posts' => 'edit_notifications',
			'edit_others_posts' => 'edit_others_notifications',
			'edit_private_posts' => 'edit_private_notifications',
			'edit_published_posts' => 'edit_published_notifications',
							
			'publish_posts' => 'publish_notifications',
			'read_private_posts' => 'read_private_notifications',
			'delete_posts' => 'delete_notifications',
			'delete_private_posts' => 'delete_private_notifications',
			'delete_published_posts' => 'delete_published_notifications',
			'delete_others_posts' => 'delete_others_notifications',
		),
	);
	register_post_type( 'thong-bao', $args );	
}

add_action( 'init', 'notification_post_type' );

function my_taxonomies_notification() {
	$labels = array(
		'name'              => _x( 'Loại thông báo', 'taxonomy general name' ),
		'singular_name'     => _x( 'Loại thông báo', 'taxonomy singular name' ),
		'search_items'      => __( 'Tìm kiếm loại thông báo' ),
		'all_items'         => __( 'Tất cả loại thông báo' ),
		'parent_item'       => __( 'Danh mục cha' ),
		'parent_item_colon' => __( 'Danh mục cha:' ),
		'edit_item'         => __( 'Sửa loại tin' ), 
		'update_item'       => __( 'Cập nhật loại tin' ),
		'add_notification_item'      => __( 'Thêm loại thông báo' ),
		'notification_item_name'     => __( 'Thêm loại thông báo' ),
		'menu_name'         => __( 'Phân loại thông báo' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
      'capabilities' => array(
            'manage_terms' => 'manage_notification_tags',
            'edit_terms' => 'edit_notification_tags',
            'delete_terms' => 'delete_notification_tags',
            'assign_terms' => 'assign_notification_tags'
        ),
      'show_ui' => true,
	  'show_admin_column' => true,
      'rewrite' => array('slug' => 'loai-thong-bao'),		
	);
	register_taxonomy( 'loai-thong-bao', 'thong-bao', $args );
}

add_action( 'init', 'my_taxonomies_notification', 0 );

add_notification_caps();

function add_notification_caps() {
    // gets the administrator role
    $admins = get_role( 'administrator' );

	$admins->remove_cap( 'manage-thong-bao' );
	$admins->add_cap( 'manage_thong-bao' );
    $admins->add_cap( 'edit_notification' ); 
    $admins->add_cap( 'edit_notifications' ); 
    $admins->add_cap( 'edit_others_notifications' ); 
    $admins->add_cap( 'publish_notifications' );
    $admins->add_cap( 'edit_published_notifications' ); 
    $admins->add_cap( 'read_notification' ); 
    $admins->add_cap( 'read_private_notifications' ); 
    $admins->add_cap( 'delete_notification' );
    $admins->add_cap( 'delete_published_notifications' );
    $admins->add_cap( 'delete_others_notifications' );
    
    $admins->add_cap( 'manage_notification_tags' );
    $admins->add_cap( 'edit_notification_tags' );
    $admins->add_cap( 'delete_notification_tags' );
    $admins->add_cap( 'assign_notification_tags' );
	
    $content_manager = get_role( 'content-manager' );

	$content_manager->remove_cap( 'manage-thong-bao' );
	$content_manager->add_cap( 'manage_thong-bao' );
    $content_manager->add_cap( 'edit_notification' ); 
    $content_manager->add_cap( 'edit_notifications' ); 
    $content_manager->add_cap( 'edit_others_notifications' ); 
    $content_manager->add_cap( 'publish_notifications' );
    $content_manager->add_cap( 'edit_published_notifications' ); 
    $content_manager->add_cap( 'read_notification' ); 
    $content_manager->add_cap( 'read_private_notifications' ); 
    $content_manager->add_cap( 'delete_notification' );
    $content_manager->add_cap( 'delete_published_notifications' );
    $content_manager->add_cap( 'delete_others_notifications' );
    
    $content_manager->add_cap( 'manage_notification_tags' );
    $content_manager->add_cap( 'edit_notification_tags' );
    $content_manager->add_cap( 'delete_notification_tags' );
    $content_manager->add_cap( 'assign_notification_tags' );	
	
    $notice_manager = get_role( 'news-manager' );

	$notice_manager->remove_cap( 'manage-thong-bao' );
	$notice_manager->add_cap( 'manage_thong-bao' );
    $notice_manager->add_cap( 'edit_notification' ); 
    $notice_manager->add_cap( 'edit_notifications' ); 
    $notice_manager->add_cap( 'edit_others_notifications' ); 
    $notice_manager->add_cap( 'publish_notifications' );
    $notice_manager->add_cap( 'edit_published_notifications' ); 
    $notice_manager->add_cap( 'read_notification' ); 
    $notice_manager->add_cap( 'read_private_notifications' ); 
    $notice_manager->add_cap( 'delete_notification' );
    $notice_manager->add_cap( 'delete_published_notifications' );
    $notice_manager->add_cap( 'delete_others_notifications' );
	
    $notice_manager->add_cap( 'assign_notification_tags' );  	
}
?>
