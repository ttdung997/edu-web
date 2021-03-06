<?php
function dethi_post_type() {
	$labels = array(
		'name'               => _x( 'Đề thi', 'post type general name' ),
		'singular_name'      => _x( 'Đề thi', 'post type singular name' ),
		'add_new'            => _x( 'Thêm đề thi mới', 'book' ),
		'add_new_item'       => __( 'Thêm đề thi' ),
		'edit_item'          => __( 'Sửa đề thi' ),
		'new_item'           => __( 'Đăng đề thi mới' ),
		'all_items'          => __( 'Tất cả đề thi' ),
		'view_item'          => __( 'Xem đề thi' ),
		'search_items'       => __( 'Tìm kiếm đề thi' ),
		'not_found'          => __( 'Không tìm thấy đề thi nào' ),
		'not_found_in_trash' => __( 'Không có đề thi nào trong thùng rác' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Đề thi các môn'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our products and product specific data',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-book',
		'supports'      => array( ''),
		'rewrite'       => array( 'slug' => 'de-thi' ),
		'has_archive'   => true,
		'capabilities' => array(
			'edit_post' => 'edit_dethi',
			'read_post' => 'read_dethi',
			'delete_post' => 'delete_dethi',
			'read_others_posts' => 'read_others_dethis',
			
			'edit_posts' => 'edit_dethis',
			'edit_others_posts' => 'edit_others_dethis',
			'edit_private_posts' => 'edit_private_dethis',
			'edit_published_posts' => 'edit_published_dethis',
							
			'publish_posts' => 'publish_dethis',
			'read_private_posts' => 'read_private_dethis',
			'delete_posts' => 'delete_dethis',
			'delete_private_posts' => 'delete_private_dethis',
			'delete_published_posts' => 'delete_published_dethis',
			'delete_others_posts' => 'delete_others_dethis',
		),
	);
	register_post_type( 'dethi', $args );
}

add_action( 'init', 'dethi_post_type' );

add_dethi_caps();

function add_dethi_caps() {
    // gets the administrator role
    $admins = get_role( 'administrator' );
	
	$admins->add_cap( 'manage_dethi' ); 
    $admins->add_cap( 'edit_dethi' ); 
    $admins->add_cap( 'edit_dethis' ); 
    $admins->add_cap( 'edit_others_dethis' ); 
    $admins->add_cap( 'publish_dethis' );
    $admins->add_cap( 'edit_published_dethis' ); 
    $admins->add_cap( 'read_dethi' ); 
    $admins->add_cap( 'read_private_dethis' ); 
    $admins->add_cap( 'delete_dethi' );
    $admins->add_cap( 'delete_published_dethis' );
    $admins->add_cap( 'delete_others_dethis' );
    
    $admins->add_cap( 'manage_dethi_tags' );
    $admins->add_cap( 'edit_dethi_tags' );
    $admins->add_cap( 'delete_dethi_tags' );
    $admins->add_cap( 'assign_dethi_tags' ); 
	
    $content_manager = get_role( 'content-manager' );
	
	$content_manager->add_cap( 'manage_dethi' ); 
    $content_manager->add_cap( 'edit_dethi' ); 
    $content_manager->add_cap( 'edit_dethis' ); 
    $content_manager->add_cap( 'edit_others_dethis' ); 
    $content_manager->add_cap( 'publish_dethis' );
    $content_manager->add_cap( 'edit_published_dethis' ); 
    $content_manager->add_cap( 'read_dethi' ); 
    $content_manager->add_cap( 'read_private_dethis' ); 
    $content_manager->add_cap( 'delete_dethi' );
    $content_manager->add_cap( 'delete_published_dethis' );
    $content_manager->add_cap( 'delete_others_dethis' );
    
    $content_manager->add_cap( 'manage_dethi_tags' );
    $content_manager->add_cap( 'edit_dethi_tags' );
    $content_manager->add_cap( 'delete_dethi_tags' );
    $content_manager->add_cap( 'assign_dethi_tags' ); 	
}
?>
