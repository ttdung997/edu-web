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

$prefix = 'SAMI_BIEUMAU_';

global $bieumau_meta_boxes;

$bieumau_meta_boxes = array();

// 1st meta box
$bieumau_meta_boxes[] = array(
	'title' => 'Biểu mẫu, quy định',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	
	'id' => 'bieumau_content',
		
	'pages' => array('bieu-mau'), //'post', 'page' ),
	
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	
	'fields' => array(
		// Document name
		 array(
			'name' => 'Tên biểu mẫu',
			'id' => $prefix . 'title',
			'type' => 'text',
			'std' => '',
			'class' => 'full-width',
			'clone' => false,
			'placeholder' => 'Nhập tên biểu mẫu vào đây',
		),
		// FILE UPLOAD
		array(
			'name' => 'File Upload',
			'id'   => "{$prefix}file",
			'type' => 'file_advanced',
		),	
	),
	'validation' => array(
		'rules' => array(
			"{$prefix}title" => array(
				'required'  => true,
			),
			"{$prefix}file" => array(
				'required' => true,
			),
		),
		// optional override of default jquery.validate messages
		'messages' => array(
			"{$prefix}title" => array(
				'required'  => __( 'Bạn phải nhập tên biểu mẫu', 'rwmb' ),
			),
			"{$prefix}file" => array(
				'required'  => __( 'Bạn phải upload file', 'rwmb' ),
			)
		)
	)	
);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function SAMI_BIEUMAU_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $bieumau_meta_boxes;
	foreach ( $bieumau_meta_boxes as $bieumau_meta_box )
	{
		new RW_Meta_Box( $bieumau_meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'SAMI_BIEUMAU_register_meta_boxes' );
?>
