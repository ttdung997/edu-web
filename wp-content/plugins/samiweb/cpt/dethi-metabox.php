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

$prefix = 'SAMI_DETHI_';

global $dethi_meta_boxes;

$dethi_meta_boxes = array();

// 1st meta box
$dethi_meta_boxes[] = array(
	'title' => 'Thông tin đề thi',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	
	'id' => 'dethi_content',
		
	'pages' => array('dethi'), //'post', 'page' ),
	
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	
	'fields' => array(
		// dethi name
		 array(
			'name' => 'Tên đề thi',
			'id' => $prefix . 'title',
			'type' => 'text',
			'std' => '',
			'class' => 'full-width',
			'clone' => false,
			'placeholder' => 'Nhập tên đề thi vào đây',
		),
		// FILE UPLOAD
		array(
			'name' => 'File Upload',
			'id'   => "{$prefix}file",
			'type' => 'file_advanced',
		),	
	)
);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function SAMI_DETHI_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $dethi_meta_boxes;
	foreach ( $dethi_meta_boxes as $dethi_meta_box )
	{
		new RW_Meta_Box( $dethi_meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'SAMI_DETHI_register_meta_boxes' );
?>
