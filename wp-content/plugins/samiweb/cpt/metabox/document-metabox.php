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

$prefix = 'SAMI_DOCUMENTS_';

global $document_meta_boxes;

$document_meta_boxes = array();

// 1st meta box
$document_meta_boxes[] = array(
	'title' => 'Upload file',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	
	'id' => 'project_content',
		
	'pages' => array('document'), //'post', 'page' ),
	
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	
	'fields' => array(
	
		 array(
			'name' => 'Tên bài giảng-tài liệu',
			'desc' => 'Tên bài giảng, tài liệu',
			'id' => $prefix . 'title',
			'type' => 'text',
			'std' => '',
			'class' => 'regular-text',
			'clone' => false,
		),
		// FILE UPLOAD
		array(
			'name' => 'File Upload',
			'id'   => "{$prefix}file",
			'type' => 'file',
		),	
	)
);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function SAMI_DOCUMENT_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $document_meta_boxes;
	foreach ( $document_meta_boxes as $document_meta_box )
	{
		new RW_Meta_Box( $document_meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'SAMI_DOCUMENT_register_meta_boxes' );
?>
