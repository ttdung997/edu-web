<?php
function giangvien_post_type() {
	$labels = array(
		'name'               => _x( 'Danh sách giảng viên', 'post type general name' ),
		'singular_name'      => _x( 'Danh sách giảng viên', 'post type singular name' ),
		'add_new'            => _x( 'Thêm Danh sách giảng viên', 'book' ),
		'add_new_item'       => __( 'Thêm Danh sách giảng viên' ),
		'edit_item'          => __( 'Sửa Danh sách giảng viên' ),
		'new_item'           => __( 'Danh sách giảng viên mới' ),
		'all_items'          => __( 'Tất cả Danh sách giảng viên' ),
		'view_item'          => __( 'Xem Danh sách giảng viên' ),
		'search_items'       => __( 'Tìm kiếm Danh sách giảng viên' ),
		'not_found'          => __( 'Không tìm thấy Danh sách giảng viên nào' ),
		'not_found_in_trash' => __( 'Không có Danh sách giảng viên nào trong thùng rác' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Danh sách giảng viên'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our products and product specific data',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-groups',
		'supports'      => array( ''),
		'has_archive'   => true,
		'rewrite'       => array( 'slug' => 'danh-sach-giang-vien' ),
		'capability_type' => array('giangvien', 'giangviens'),
		'capabilities' => array(
				'edit_post' => 'edit_giangvien',
				'read_post' => 'read_giangvien',
				'delete_post' => 'delete_giangvien',
				'read_others_posts' => 'read_others_giangviens',
				
				'edit_posts' => 'edit_giangviens',
				'edit_others_posts' => 'edit_others_giangviens',
				'edit_private_posts' => 'edit_private_giangviens',
				'edit_published_posts' => 'edit_published_giangviens',
								
				'publish_posts' => 'publish_giangviens',
				'read_private_posts' => 'read_private_giangviens',
				'delete_posts' => 'delete_giangviens',
				'delete_private_posts' => 'delete_private_giangviens',
				'delete_published_posts' => 'delete_published_giangviens',
				'delete_others_posts' => 'delete_others_giangviens',

			),
			'map_meta_cap' => true,
	);
	register_post_type( 'danh-sach-giang-vien', $args );
	
	add_giangvien_caps();
}

add_action( 'init', 'giangvien_post_type' );

add_giangvien_caps();

function add_giangvien_caps() {
    // gets the administrator role
    $admins = get_role( 'administrator' );

    $admins->add_cap( 'edit_giangvien' ); 
    $admins->add_cap( 'edit_giangviens' ); 
    $admins->add_cap( 'edit_others_giangviens' ); 
    $admins->add_cap( 'publish_giangviens' );
    $admins->add_cap( 'edit_published_giangviens' ); 
    $admins->add_cap( 'read_giangvien' ); 
    $admins->add_cap( 'read_private_giangviens' ); 
    $admins->add_cap( 'delete_giangvien' );
    $admins->add_cap( 'delete_published_giangviens' );
    $admins->add_cap( 'delete_others_giangviens' );
	
    // gets the administrator role
	
    $content_manager = get_role( 'content-manager' );

	$content_manager->add_cap( 'manage_danh-sach-giang-vien' ); 
    $content_manager->add_cap( 'edit_giangvien' ); 
    $content_manager->add_cap( 'edit_giangviens' ); 
    $content_manager->add_cap( 'edit_others_giangviens' ); 
    $content_manager->add_cap( 'publish_giangviens' );
    $content_manager->add_cap( 'edit_published_giangviens' ); 
    $content_manager->add_cap( 'read_giangvien' ); 
    $content_manager->add_cap( 'read_private_giangviens' ); 
    $content_manager->add_cap( 'delete_giangvien' );
    $content_manager->add_cap( 'delete_published_giangviens' );
    $content_manager->add_cap( 'delete_others_giangviens' );

}
?>
