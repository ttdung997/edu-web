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

$prefix = 'SAMI_CONTACT_FORM_';

global $contact_form_boxes;

$contact_form_boxes = array();

// 1st meta box
$contact_form_boxes[] = array(
	'title' => 'Form liên hệ',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	
	'id' => 'contact_form_content',
		
	'pages' => array('contact-form'), //'post', 'page' ),
	
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	
	'fields' => array(
		// Document name
		 array(
			'name' => 'Tên form liên hệ',
			'desc' => 'Ví dụ: form liên hệ Cố vấn học tập, Form liên hệ về Tuyển sinh',
			'id' => $prefix . 'title',
			'type' => 'text',
			'std' => '',
			'class' => 'full-width',
			'clone' => false,
			'placeholder' => 'Tên form liên hệ',
		),
		// Document name
		 array(
			'name' => 'Email nhận tin',
			'desc' => 'Email của những người nhận câu hỏi',
			'id' => $prefix . 'email',
			'type' => 'text',
			'std' => '',
			'class' => 'full-width',
			'clone' => true,
			'placeholder' => 'Địa chỉ email',
		),
	)
);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function SAMI_CONTACT_FORM_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $contact_form_boxes;
	foreach ( $contact_form_boxes as $contact_form_box )
	{
		new RW_Meta_Box( $contact_form_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'SAMI_CONTACT_FORM_register_meta_boxes' );
?>
