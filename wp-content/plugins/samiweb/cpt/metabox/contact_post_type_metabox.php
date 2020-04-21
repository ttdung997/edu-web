<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'EDUBOX_CONTACT_INFO_';

global $contact_info_meta_boxes;

$contact_info_meta_boxes = array();

// 1st meta box
$contact_info_meta_boxes[] = array(
	'title' => 'Liên hệ',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('contact_info'), //'post', 'page' ),
	'fields' => array(
	
		// text
		array(
			'name' => 'Họ và tên người liên hệ',
			'id'   => "{$prefix}contact_name",
			'type' => 'text'
		),
		// text
		array(
			'name' => 'Số điện thoại',
			'id'   => "{$prefix}contact_phone",
			'type' => 'text'
		),
		// text
		array(
			'name' => 'Số fax',
			'id'   => "{$prefix}contact_fax",
			'type' => 'text'
		),
		// text
		array(
			'name' => 'Di động',
			'id'   => "{$prefix}contact_mobile",
			'type' => 'text'
		),
		// text
		array(
			'name' => 'Email',
			'id'   => "{$prefix}contact_email",
			'type' => 'text'
		),
		// text
		array(
			'name' => 'Địa chỉ',
			'id'   => "{$prefix}contact_address",
			'type' => 'text',
			'size' => 60,
		),		
	)
);
/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function EDUBOX_CONTACT_INFO_register_instructor_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $contact_info_meta_boxes;
	foreach ( $contact_info_meta_boxes as $contact_info_meta_box )
	{
		new RW_Meta_Box( $contact_info_meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'EDUBOX_CONTACT_INFO_register_instructor_meta_boxes' );
function custom_post_type_title ( $post_id ) {
    global $wpdb;
    if ( get_post_type( $post_id ) == 'contact_info' ) {
        $title = get_post_meta($post_id, 'EDUBOX_CONTACT_INFO_contact_name', true);
		echo "title=$title";
        $where = array( 'ID' => $post_id );
        $wpdb->update( $wpdb->posts, array( 'post_title' => $title ), $where );
    }
}

add_action('save_post', 'custom_post_type_title', 100);
add_action('publish_post', 'custom_post_type_title', 100);
