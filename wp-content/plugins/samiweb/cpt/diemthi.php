<?php
function diemthi_post_type() {
	$labels = array(
		'name'               => _x( 'Điểm thi', 'post type general name' ),
		'singular_name'      => _x( 'Điểm thi', 'post type singular name' ),
		'add_new'            => _x( 'Thêm điểm thi mới', 'book' ),
		'add_new_item'       => __( 'Thêm điểm thi' ),
		'edit_item'          => __( 'Sửa điểm thi' ),
		'new_item'           => __( 'Đăng điểm thi mới' ),
		'all_items'          => __( 'Tất cả điểm thi' ),
		'view_item'          => __( 'Xem điểm thi' ),
		'search_items'       => __( 'Tìm kiếm điểm thi' ),
		'not_found'          => __( 'Không tìm thấy điểm thi nào' ),
		'not_found_in_trash' => __( 'Không có điểm thi nào trong thùng rác' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Điểm thi các môn'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our products and product specific data',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-book',
		'supports'      => array( ''),
		'rewrite'       => array( 'slug' => 'diem-thi' ),
		'has_archive'   => true,
		'capabilities' => array(
			'edit_post' => 'edit_diemthi',
			'read_post' => 'read_diemthi',
			'delete_post' => 'delete_diemthi',
			'read_others_posts' => 'read_others_diemthis',
			
			'edit_posts' => 'edit_diemthis',
			'edit_others_posts' => 'edit_others_diemthis',
			'edit_private_posts' => 'edit_private_diemthis',
			'edit_published_posts' => 'edit_published_diemthis',
							
			'publish_posts' => 'publish_diemthis',
			'read_private_posts' => 'read_private_diemthis',
			'delete_posts' => 'delete_diemthis',
			'delete_private_posts' => 'delete_private_diemthis',
			'delete_published_posts' => 'delete_published_diemthis',
			'delete_others_posts' => 'delete_others_diemthis',
		),
	);
	register_post_type( 'diemthi', $args );
}

add_action( 'init', 'diemthi_post_type' );

add_diemthi_caps();

function add_diemthi_caps() {
    // gets the administrator role
    $admins = get_role( 'administrator' );

	$admins->add_cap( 'manage_diemthi' );
    $admins->add_cap( 'edit_diemthi' ); 
    $admins->add_cap( 'edit_diemthis' ); 
    $admins->add_cap( 'edit_others_diemthis' ); 
    $admins->add_cap( 'publish_diemthis' );
    $admins->add_cap( 'edit_published_diemthis' ); 
    $admins->add_cap( 'read_diemthi' ); 
    $admins->add_cap( 'read_private_diemthis' ); 
    $admins->add_cap( 'delete_diemthi' );
    $admins->add_cap( 'delete_published_diemthis' );
    $admins->add_cap( 'delete_others_diemthis' );
    
    $admins->add_cap( 'manage_diemthi_tags' );
    $admins->add_cap( 'edit_diemthi_tags' );
    $admins->add_cap( 'delete_diemthi_tags' );
    $admins->add_cap( 'assign_diemthi_tags' ); 
	
    $content_manager = get_role( 'content-manager' );

	$content_manager->add_cap( 'manage_diemthi' );
    $content_manager->add_cap( 'edit_diemthi' ); 
    $content_manager->add_cap( 'edit_diemthis' ); 
    $content_manager->add_cap( 'edit_others_diemthis' ); 
    $content_manager->add_cap( 'publish_diemthis' );
    $content_manager->add_cap( 'edit_published_diemthis' ); 
    $content_manager->add_cap( 'read_diemthi' ); 
    $content_manager->add_cap( 'read_private_diemthis' ); 
    $content_manager->add_cap( 'delete_diemthi' );
    $content_manager->add_cap( 'delete_published_diemthis' );
    $content_manager->add_cap( 'delete_others_diemthis' );
    
    $content_manager->add_cap( 'manage_diemthi_tags' );
    $content_manager->add_cap( 'edit_diemthi_tags' );
    $content_manager->add_cap( 'delete_diemthi_tags' );
    $content_manager->add_cap( 'assign_diemthi_tags' ); 	
}
?>
