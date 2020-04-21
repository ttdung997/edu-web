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

$prefix = 'SAMI_SYLLABUSES_';

global $syllabus_meta_boxes;

$syllabus_meta_boxes = array();

// 1st meta box
$syllabus_meta_boxes[] = array(
	'title' => 'Thông tin bài giảng, tài liệu',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	
	'id' => 'syllabus_content',
		
	'pages' => array('syllabus'), //'post', 'page' ),
	
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	
	'fields' => array(
		// syllabus name
		 array(
			'name' => 'Tên đề cương',
			'id' => $prefix . 'title',
			'type' => 'text',
			'std' => '',
			'class' => 'full-width',
			'clone' => false,
			'placeholder' => 'Nhập tên đề cương vào đây',
		),
		// FILE UPLOAD
		array(
			'name' => 'Tải file',
			'id'   => "{$prefix}file",
			'type' => 'file_advanced',
		),	
	),
	'validation' => array(
		'rules' => array(
			"{$prefix}title" => array(
				'required'  => true,
			)
		),
		// optional override of default jquery.validate messages
		'messages' => array(
			"{$prefix}title" => array(
				'required'  => __( 'Chưa nhập tên đề cương', 'rwmb' ),
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
function SAMI_SYLLABUS_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $syllabus_meta_boxes;
	foreach ( $syllabus_meta_boxes as $syllabus_meta_box )
	{
		new RW_Meta_Box( $syllabus_meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'SAMI_SYLLABUS_register_meta_boxes' );
?>
