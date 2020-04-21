<?php
function contact_form_post_type() {
	$labels = array(
		'name'               => _x( 'Form liên hệ', 'post type general name' ),
		'singular_name'      => _x( 'Form liên hệ', 'post type singular name' ),
		'add_new'            => _x( 'Thêm form liên hệ', 'book' ),
		'add_new_item'       => __( 'Thêm form liên hệ' ),
		'edit_item'          => __( 'Sửa form liên hệ' ),
		'new_item'           => __( 'Đăng form liên hệ' ),
		'all_items'          => __( 'Tất cả form liên hệ' ),
		'view_item'          => __( 'Xem form liên hệ' ),
		'search_items'       => __( 'Tìm kiếm form liên hệ' ),
		'not_found'          => __( 'Không tìm thấy form liên hệ nào' ),
		'not_found_in_trash' => __( 'Không có form liên hệ nào trong thùng rác' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Form liên hệ'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our products and product specific data',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-book',
		'supports'      => array( ''),
		'rewrite'       => array( 'slug' => 'form-lien-he' ),
		'has_archive'   => true,
		'capabilities' => array(
			'edit_post' => 'edit_contact_form',
			'read_post' => 'read_contact_form',
			'delete_post' => 'delete_contact_form',
			'read_others_posts' => 'read_others_contact_forms',
			
			'edit_posts' => 'edit_contact_forms',
			'edit_others_posts' => 'edit_others_contact_forms',
			'edit_private_posts' => 'edit_private_contact_forms',
			'edit_published_posts' => 'edit_published_contact_forms',
							
			'publish_posts' => 'publish_contact_forms',
			'read_private_posts' => 'read_private_contact_forms',
			'delete_posts' => 'delete_contact_forms',
			'delete_private_posts' => 'delete_private_contact_forms',
			'delete_published_posts' => 'delete_published_contact_forms',
			'delete_others_posts' => 'delete_others_contact_forms',
		),
	);
	register_post_type( 'contact-form', $args );
	
	add_contact_form_caps();
}

add_action( 'init', 'contact_form_post_type' );

add_contact_form_caps();

function add_contact_form_caps() {
    // gets the administrator role
    $admins = get_role( 'administrator' );

	$admins->add_cap( 'manage_contact-form' );
    $admins->add_cap( 'edit_contact_form' ); 
    $admins->add_cap( 'edit_contact_forms' ); 
    $admins->add_cap( 'edit_others_contact_forms' ); 
    $admins->add_cap( 'publish_contact_forms' );
    $admins->add_cap( 'edit_published_contact_forms' ); 
    $admins->add_cap( 'read_contact_form' ); 
    $admins->add_cap( 'read_private_contact_forms' ); 
    $admins->add_cap( 'delete_contact_form' );
    $admins->add_cap( 'delete_published_contact_forms' );
    $admins->add_cap( 'delete_others_contact_forms' );
    
    $admins->add_cap( 'manage_contact_form_tags' );
    $admins->add_cap( 'edit_contact_form_tags' );
    $admins->add_cap( 'delete_contact_form_tags' );
    $admins->add_cap( 'assign_contact_form_tags' ); 
	
    $content_manager = get_role( 'content-manager' );

	$content_manager->add_cap( 'manage_contact-form' );
    $content_manager->add_cap( 'edit_contact_form' ); 
    $content_manager->add_cap( 'edit_contact_forms' ); 
    $content_manager->add_cap( 'edit_others_contact_forms' ); 
    $content_manager->add_cap( 'publish_contact_forms' );
    $content_manager->add_cap( 'edit_published_contact_forms' ); 
    $content_manager->add_cap( 'read_contact_form' ); 
    $content_manager->add_cap( 'read_private_contact_forms' ); 
    $content_manager->add_cap( 'delete_contact_form' );
    $content_manager->add_cap( 'delete_published_contact_forms' );
    $content_manager->add_cap( 'delete_others_contact_forms' );
    
    $content_manager->add_cap( 'manage_contact_form_tags' );
    $content_manager->add_cap( 'edit_contact_form_tags' );
    $content_manager->add_cap( 'delete_contact_form_tags' );
    $content_manager->add_cap( 'assign_contact_form_tags' );  	
}
?>
