<?php
function job_post_type() {
	$labels = array(
		'name'               => _x( 'Tin tuyển dụng', 'post type general name' ),
		'singular_name'      => _x( 'Tin tuyển dụng', 'post type singular name' ),
		'add_new'            => _x( 'Viết tin tuyển dụng mới', 'book' ),
		'add_new_item'       => __( 'Viết tin tuyển dụng mới' ),
		'edit_item'          => __( 'Sửa tin' ),
		'new_item'           => __( 'Viết tin tuyển dụng mới' ),
		'all_items'          => __( 'Tất cả Tin tuyển dụng' ),
		'view_item'          => __( 'Xem tin' ),
		'search_items'       => __( 'Tìm kiếm Tin tuyển dụng' ),
		'not_found'          => __( 'Không tìm thấy tin nào' ),
		'not_found_in_trash' => __( 'Không có tin nào nào trong thùng rác' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Tin tuyển dụng'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Đăng các Tin tuyển dụng của viện',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-edit',
		'rewrite' => array('slug' => 'tin-tuyen-dung'),
		'supports'      => array('title', 'editor'),
		'has_archive'   => true,
		'capabilities' => array(
			'edit_post' => 'edit_job',
			'read_post' => 'read_job',
			'delete_post' => 'delete_job',
			'read_others_posts' => 'read_others_jobs',
			
			'edit_posts' => 'edit_jobs',
			'edit_others_posts' => 'edit_others_jobs',
			'edit_private_posts' => 'edit_private_jobs',
			'edit_published_posts' => 'edit_published_jobs',
							
			'publish_posts' => 'publish_jobs',
			'read_private_posts' => 'read_private_jobs',
			'delete_posts' => 'delete_jobs',
			'delete_private_posts' => 'delete_private_jobs',
			'delete_published_posts' => 'delete_published_jobs',
			'delete_others_posts' => 'delete_others_jobs',
		),
	);
	register_post_type( 'tin-tuyen-dung', $args );
	

}

add_action( 'init', 'job_post_type' );

	add_job_caps();

function add_job_caps() {
    // gets the administrator role
    $admins = get_role( 'administrator' );
	
	$admins->add_cap( 'manage_tin-tuyen-dung' );
    $admins->add_cap( 'edit_job' ); 
    $admins->add_cap( 'edit_jobs' ); 
    $admins->add_cap( 'edit_others_jobs' ); 
    $admins->add_cap( 'publish_jobs' );
    $admins->add_cap( 'edit_published_jobs' ); 
    $admins->add_cap( 'read_job' ); 
    $admins->add_cap( 'read_private_jobs' ); 
    $admins->add_cap( 'delete_job' );
    $admins->add_cap( 'delete_published_jobs' );
    $admins->add_cap( 'delete_others_jobs' );
	
    $content_manager = get_role( 'content-manager' );
	
	$content_manager->add_cap( 'manage_tin-tuyen-dung' );
    $content_manager->add_cap( 'edit_job' ); 
    $content_manager->add_cap( 'edit_jobs' ); 
    $content_manager->add_cap( 'edit_others_jobs' ); 
    $content_manager->add_cap( 'publish_jobs' );
    $content_manager->add_cap( 'edit_published_jobs' ); 
    $content_manager->add_cap( 'read_job' ); 
    $content_manager->add_cap( 'read_private_jobs' ); 
    $content_manager->add_cap( 'delete_job' );
    $content_manager->add_cap( 'delete_published_jobs' );
    $content_manager->add_cap( 'delete_others_jobs' );	
	
    $news_manager = get_role( 'news-manager' );
	
	$news_manager->add_cap( 'manage_tin-tuyen-dung' );
    $news_manager->add_cap( 'edit_job' ); 
    $news_manager->add_cap( 'edit_jobs' ); 
    $news_manager->add_cap( 'edit_others_jobs' ); 
    $news_manager->add_cap( 'publish_jobs' );
    $news_manager->add_cap( 'edit_published_jobs' ); 
    $news_manager->add_cap( 'read_job' ); 
    $news_manager->add_cap( 'read_private_jobs' ); 
    $news_manager->add_cap( 'delete_job' );
    $news_manager->add_cap( 'delete_published_jobs' );
    $news_manager->add_cap( 'delete_others_jobs' );
}
?>
