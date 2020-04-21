<?php

function research_post_type() {
	$labels = array(
		'name'               => _x( 'Nhóm nghiên cứu', 'post type general name' ),
		'singular_name'      => _x( 'Nhóm nghiên cứu', 'post type singular name' ),
		'add_new'            => _x( 'Thêm nhóm nghiên cứu', 'book' ),
		'add_new_item'       => __( 'Thêm nhóm nghiên cứu' ),
		'edit_item'          => __( 'Sửa' ),
		'new_item'           => __( 'Thêm nhóm nghiên cứu' ),
		'all_items'          => __( 'Tất cả nhóm nghiên cứu' ),
		'view_item'          => __( 'Xem nhóm nghiên cứu' ),
		'search_items'       => __( 'Tìm kiếm nhóm nghiên cứu' ),
		'not_found'          => __( 'Không tìm thấy nhóm nghiên cứu' ),
		'not_found_in_trash' => __( 'Không tìm thấy nhóm nghiên cứu' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Nhóm nghiên cứu'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Các nhóm nghiên cứu trong Viện',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array(''),
		'has_archive'   => true,
		'rewrite' => array('slug' => 'nhom-nghien-cuu'),
		'capability_type' => 'post',
		'capabilities' => array(
			'edit_post' => 'edit_research',
			'read_post' => 'read_research',
			'delete_post' => 'delete_research',
			'read_others_posts' => 'read_others_researches',
			
			'edit_posts' => 'edit_researches',
			'edit_others_posts' => 'edit_others_researches',
			'edit_private_posts' => 'edit_private_researches',
			'edit_published_posts' => 'edit_published_researches',
							
			'publish_posts' => 'publish_researches',
			'read_private_posts' => 'read_private_researches',
			'delete_posts' => 'delete_researches',
			'delete_private_posts' => 'delete_private_researches',
			'delete_published_posts' => 'delete_published_researches',
			'delete_others_posts' => 'delete_others_researches',
		),
		'show_ui'            => true,
		'show_in_menu'       => true,
		);
	register_post_type( 'research', $args );	
}
add_action( 'init', 'research_post_type' );

function my_taxonomies_research() {
	$labels = array(
		'name'              => _x( 'Danh mục research', 'taxonomy general name' ),
		'singular_name'     => _x( 'Danh mục research', 'taxonomy singular name' ),
		'search_items'      => __( 'Tìm kiếm' ),
		'all_items'         => __( 'Các loại research' ),
		'parent_item'       => __( 'Danh mục cha' ),
		'parent_item_colon' => __( 'Danh mục cha:' ),
		'edit_item'         => __( 'Sửa đổi danh mục' ), 
		'update_item'       => __( 'Cập nhật danh mục' ),
		'add_new_item'      => __( 'Thêm mới danh mục' ),
		'new_item_name'     => __( 'Thêm danh mục mới' ),
		'menu_name'         => __( 'Danh mục research' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'show_ui' => true,
	);
	register_taxonomy( 'researches', 'research', $args );
}
add_research_caps();

function add_research_caps() {
    // gets the administrator role
    $admins = get_role( 'administrator' );

	$admins->remove_cap( 'manage-research' );
	$admins->add_cap( 'manage_research' );
    $admins->add_cap( 'edit_research' ); 
    $admins->add_cap( 'edit_researches' ); 
    $admins->add_cap( 'edit_others_researches' ); 
    $admins->add_cap( 'publish_researches' );
    $admins->add_cap( 'edit_published_researches' ); 
    $admins->add_cap( 'read_research' ); 
    $admins->add_cap( 'read_private_researches' ); 
    $admins->add_cap( 'delete_research' );
    $admins->add_cap( 'delete_published_researches' );
    $admins->add_cap( 'delete_others_researches' );
    
    $admins->add_cap( 'manage_research_tags' );
    $admins->add_cap( 'edit_research_tags' );
    $admins->add_cap( 'delete_research_tags' );
    $admins->add_cap( 'assign_research_tags' );
	
    $content_manager = get_role( 'content-manager' );

	$content_manager->remove_cap( 'manage-research' );
	$content_manager->add_cap( 'manage_research' );
    $content_manager->add_cap( 'edit_research' ); 
    $content_manager->add_cap( 'edit_researches' ); 
    $content_manager->add_cap( 'edit_others_researches' ); 
    $content_manager->add_cap( 'publish_researches' );
    $content_manager->add_cap( 'edit_published_researches' ); 
    $content_manager->add_cap( 'read_research' ); 
    $content_manager->add_cap( 'read_private_researches' ); 
    $content_manager->add_cap( 'delete_research' );
    $content_manager->add_cap( 'delete_published_researches' );
    $content_manager->add_cap( 'delete_others_researches' );
    
    $content_manager->add_cap( 'manage_research_tags' );
    $content_manager->add_cap( 'edit_research_tags' );
    $content_manager->add_cap( 'delete_research_tags' );
    $content_manager->add_cap( 'assign_research_tags' );	
	
    $notice_manager = get_role( 'news-manager' );

	$notice_manager->remove_cap( 'manage-research' );
	$notice_manager->add_cap( 'manage_research' );
    $notice_manager->add_cap( 'edit_research' ); 
    $notice_manager->add_cap( 'edit_researches' ); 
    $notice_manager->add_cap( 'edit_others_researches' ); 
    $notice_manager->add_cap( 'publish_researches' );
    $notice_manager->add_cap( 'edit_published_researches' ); 
    $notice_manager->add_cap( 'read_research' ); 
    $notice_manager->add_cap( 'read_private_researches' ); 
    $notice_manager->add_cap( 'delete_research' );
    $notice_manager->add_cap( 'delete_published_researches' );
    $notice_manager->add_cap( 'delete_others_researches' );
	
    $notice_manager->add_cap( 'assign_research_tags' );  	
}
?>