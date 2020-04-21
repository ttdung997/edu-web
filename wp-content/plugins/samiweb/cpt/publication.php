<?php

function publication_post_type() {
	$labels = array(
		'name'               => _x( 'Bài báo khoa học', 'post type general name' ),
		'singular_name'      => _x( 'Bài báo', 'post type singular name' ),
		'add_new'            => _x( 'Thêm bài báo', 'book' ),
		'add_new_item'       => __( 'Thêm bài báo' ),
		'edit_item'          => __( 'Sửa' ),
		'new_item'           => __( 'Thêm bài báo' ),
		'all_items'          => __( 'Tất cả bài báo' ),
		'view_item'          => __( 'Xem bài báo' ),
		'search_items'       => __( 'Tìm kiếm bài báo' ),
		'not_found'          => __( 'Không tìm thấy bài báo' ),
		'not_found_in_trash' => __( 'Không tìm thấy bài báo' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Bài báo khoa học (Journal papers)'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Thông tin các bài báo khoa học đã và đang chờ xuất bản',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-portfolio',
		'supports'      => array( ''),
		'has_archive'   => true,
		'capability_type' => array('publication', 'publications'),
		'capabilities' => array(
			'edit_post' => 'edit_publication',
			'read_post' => 'read_publication',
			'delete_post' => 'delete_publication',
			'read_others_posts' => 'read_others_publications',
			
			'edit_posts' => 'edit_publications',
			'edit_others_posts' => 'edit_others_publications',
			'edit_private_posts' => 'edit_private_publications',
			'edit_published_posts' => 'edit_published_publications',
							
			'publish_posts' => 'publish_publications',
			'read_private_posts' => 'read_private_publications',
			'delete_posts' => 'delete_publications',
			'delete_private_posts' => 'delete_private_publications',
			'delete_published_posts' => 'delete_published_publications',
			'delete_others_posts' => 'delete_others_publications',
		),
	);
	register_post_type( 'publication', $args );	
	

}
add_action( 'init', 'publication_post_type' );

add_publication_caps();
	
function add_publication_caps() {
    // gets the administrator role
    $admins = get_role( 'administrator' );
	
	$admins->add_cap('manage_publication');

    $admins->add_cap( 'edit_publication' ); 
    $admins->add_cap( 'edit_publications' ); 
    $admins->add_cap( 'edit_others_publications' ); 
    $admins->add_cap( 'publish_publications' );
    $admins->add_cap( 'edit_published_publications' ); 
    $admins->add_cap( 'read_publication' ); 
    $admins->add_cap( 'read_private_publications' ); 
    $admins->add_cap( 'delete_publication' );
    $admins->add_cap( 'delete_published_publications' );
    $admins->add_cap( 'delete_others_publications' );
    
    $admins->add_cap( 'manage_publication_tags' );
    $admins->add_cap( 'edit_publication_tags' );
    $admins->add_cap( 'delete_publication_tags' );
    $admins->add_cap( 'assign_publication_tags' ); 
	
    $content_manager = get_role( 'content-manager' );
	
	$content_manager->add_cap('manage_publication');

    $content_manager->add_cap( 'edit_publication' ); 
    $content_manager->add_cap( 'edit_publications' ); 
    $content_manager->add_cap( 'edit_others_publications' ); 
    $content_manager->add_cap( 'publish_publications' );
    $content_manager->add_cap( 'edit_published_publications' ); 
    $content_manager->add_cap( 'read_publication' ); 
    $content_manager->add_cap( 'read_private_publications' ); 
    $content_manager->add_cap( 'delete_publication' );
    $content_manager->add_cap( 'delete_published_publications' );
    $content_manager->add_cap( 'delete_others_publications' );
    
    $content_manager->add_cap( 'manage_publication_tags' );
    $content_manager->add_cap( 'edit_publication_tags' );
    $content_manager->add_cap( 'delete_publication_tags' );
    $content_manager->add_cap( 'assign_publication_tags' ); 	
}
?>
