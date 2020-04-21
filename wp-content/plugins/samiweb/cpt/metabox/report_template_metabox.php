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

$taxonomy = 'tailieu';

$prefix = 'SAMI_TEMPLATES_';

global $template_meta_boxes;

$template_meta_boxes = array();

// 1st meta box
$template_meta_boxes[] = array(
	'title' => 'Upload file',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	
	'id' => 'templates',
		
	'pages' => array('bieu-mau'), //'post', 'page' ),
	
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	
	'fields' => array(
		// text
		array(
			'name' => 'Tên biểu mẫu',
			'desc' => 'Ví dụ: Mẫu báo cáo tiến độ Đồ án 2',
			'id'   => "{$prefix}title",
			'type' => 'text',
			'size' => 107,
		),
		// FILE UPLOAD
		array(
			'name' => 'Upload file',
			'id'   => "{$prefix}file",
			'type' => 'file',
		),	
	),
	'validation' => array(
		'rules' => array(
			"{$prefix}title" => array(
				'required'  => true,
			),
			"{$prefix}file" => array(
				'required' => true,
			)
		),
		// optional override of default jquery.validate messages
		'messages' => array(
			"{$prefix}title" => array(
				'required'  => __( 'Bạn phải nhập tên biểu mẫu', 'rwmb' ),
			),
			"{$prefix}file" => array(
				'required'  => __( 'Bạn phải upload file biểu mẫu', 'rwmb' ),
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
function SAMI_TEMPLATE_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $template_meta_boxes;
	foreach ( $template_meta_boxes as $template_meta_box )
	{
		new RW_Meta_Box( $template_meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'SAMI_TEMPLATE_register_meta_boxes' );