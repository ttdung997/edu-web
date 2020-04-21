<?php
function event_post_type() {
	$labels = array(
		'name'               => _x( 'Sự kiện', 'post type general name' ),
		'singular_name'      => _x( 'Sự kiện', 'post type singular name' ),
		'add_new'            => _x( 'Thêm sự kiện', 'book' ),
		'add_new_item'       => __( 'Thêm sự kiện' ),
		'edit_item'          => __( 'Sửa sự kiện' ),
		'new_item'           => __( 'Sự kiện mới' ),
		'all_items'          => __( 'Tất cả sự kiện' ),
		'view_item'          => __( 'Xem sự kiện' ),
		'search_items'       => __( 'Tìm kiếm sự kiện' ),
		'not_found'          => __( 'Không tìm thấy sự kiện nào' ),
		'not_found_in_trash' => __( 'Không có sự kiện nào trong thùng rác' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Sự kiện'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our products and product specific data',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-clock',
		'supports'      => array( ''),
		'has_archive'   => true,
		'rewrite'       => array( 'slug' => 'su-kien' ),
		'capability_type' => array('event', 'events'),
		'capabilities' => array(
				'edit_post' => 'edit_event',
				'read_post' => 'read_event',
				'delete_post' => 'delete_event',
				'read_others_posts' => 'read_others_events',
				
				'edit_posts' => 'edit_events',
				'edit_others_posts' => 'edit_others_events',
				'edit_private_posts' => 'edit_private_events',
				'edit_published_posts' => 'edit_published_events',
								
				'publish_posts' => 'publish_events',
				'read_private_posts' => 'read_private_events',
				'delete_posts' => 'delete_events',
				'delete_private_posts' => 'delete_private_events',
				'delete_published_posts' => 'delete_published_events',
				'delete_others_posts' => 'delete_others_events',

			),
			'map_meta_cap' => true,
	);
	register_post_type( 'event', $args );
}

add_action( 'init', 'event_post_type' );

function my_taxonomies_event() {
	$labels = array(
		'name'              => _x( 'Danh mục sự kiện', 'taxonomy general name' ),
		'singular_name'     => _x( 'Danh mục sự kiện', 'taxonomy singular name' ),
		'search_items'      => __( 'Tìm kiếm danh mục sự kiện' ),
		'all_items'         => __( 'Tất cả danh mục' ),
		'parent_item'       => __( 'Danh mục cha' ),
		'parent_item_colon' => __( 'Danh mục cha:' ),
		'edit_item'         => __( 'Sửa danh mục' ), 
		'update_item'       => __( 'Cập nhật danh mục' ),
		'add_new_item'      => __( 'Thêm danh mục' ),
		'new_item_name'     => __( 'Thêm danh mục' ),
		'menu_name'         => __( 'Danh mục sự kiện' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
      'capabilities' => array(
            'manage_terms' => 'manage_event_tags',
            'edit_terms' => 'edit_event_tags',
            'delete_terms' => 'delete_event_tags',
            'assign_terms' => 'assign_event_tags'
        ),
        'show_ui' => false,		
	);
	register_taxonomy( 'event-category', 'event', $args );
}

add_action( 'init', 'my_taxonomies_event', 0 );

add_event_caps();

function add_event_caps() {
    // gets the administrator role
    $admins = get_role( 'administrator' );

	$admins->add_cap('manage_event');
    $admins->add_cap( 'edit_event' ); 
    $admins->add_cap( 'edit_events' ); 
    $admins->add_cap( 'edit_others_events' ); 
    $admins->add_cap( 'publish_events' );
    $admins->add_cap( 'edit_published_events' ); 
    $admins->add_cap( 'read_event' ); 
    $admins->add_cap( 'read_private_events' ); 
    $admins->add_cap( 'delete_event' );
    $admins->add_cap( 'delete_published_events' );
    $admins->add_cap( 'delete_others_events' );
    
    $admins->add_cap( 'manage_event_tags' );
    $admins->add_cap( 'edit_event_tags' );
    $admins->add_cap( 'delete_event_tags' );
    $admins->add_cap( 'assign_event_tags' );
	
    $content_manager = get_role( 'content-manager' );

	$content_manager->add_cap('manage_event');
    $content_manager->add_cap( 'edit_event' ); 
    $content_manager->add_cap( 'edit_events' ); 
    $content_manager->add_cap( 'edit_others_events' ); 
    $content_manager->add_cap( 'publish_events' );
    $content_manager->add_cap( 'edit_published_events' ); 
	$content_manager->add_cap( 'edit_private_events' ); 
    $content_manager->add_cap( 'read_event' ); 
    $content_manager->add_cap( 'read_private_events' ); 
    $content_manager->add_cap( 'delete_event' );
	$content_manager->add_cap( 'delete_events' );
    $content_manager->add_cap( 'delete_published_events' );
    $content_manager->add_cap( 'delete_others_events' );
	$content_manager->add_cap( 'delete_private_events' );
	//$content_manager->remove_cap( 'edit_others_posts' );	
	
    $event_manager = get_role( 'news-manager' );

	$event_manager->add_cap('manage_event');
    $event_manager->add_cap( 'edit_event' ); 
    $event_manager->add_cap( 'edit_events' ); 
    $event_manager->add_cap( 'edit_others_events' ); 
    $event_manager->add_cap( 'publish_events' );
    $event_manager->add_cap( 'edit_published_events' ); 
	$event_manager->add_cap( 'edit_private_events' ); 
    $event_manager->add_cap( 'read_event' ); 
    $event_manager->add_cap( 'read_private_events' ); 
    $event_manager->add_cap( 'delete_event' );
	$event_manager->add_cap( 'delete_events' );
    $event_manager->add_cap( 'delete_published_events' );
    $event_manager->add_cap( 'delete_others_events' );
	$event_manager->add_cap( 'delete_private_events' );
	$event_manager->remove_cap( 'edit_others_posts' );
}
?>