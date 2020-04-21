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
$prefix = 'EDUBOX_INSTRUCTOR_';

global $instructor_instructor_meta_boxes;

$instructor_meta_boxes = array();

// 1st meta box
$instructor_meta_boxes[] = array(
	'title' => 'Thông tin chi tiết',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('instructor'), //'post', 'page' ),
	'fields' => array(
		// WYSIWYG/RICH TEXT EDITOR
		array(
			'name' => 'Giới thiệu giảng viên',
			'id'   => "{$prefix}instructor_intro",
			'type' => 'wysiwyg',
			'std'  => '',

			// Editor settings, see wp_editor() function: look4wp.com/wp_editor
			'options' => array(
				'textarea_rows' => 4,
				'teeny'         => true,
				'media_buttons' => false,
			),
		),
		// text
		array(
			'name' => 'Công việc hiện tại',
			'id'   => "{$prefix}instructor_job",
			'type' => 'text',
			'size' => 60,
		),
		// text
		array(
			'name' => 'Facebook',
			'id'   => "{$prefix}instructor_facebook",
			'type' => 'text',
			'size' => 60,
		),
		// text
		array(
			'name' => 'Email',
			'id'   => "{$prefix}instructor_email",
			'type' => 'text',
			'size' => 60,
		),
/*		
		// IMAGE UPLOAD
		array(
			'name' => 'Ảnh giảng viên',
			'id'   => "{$prefix}instructor_image",
			'type' => 'image',
		),
*/		
	)
);

// 2nd meta box
$instructor_meta_boxes[] = array(
	'title' => 'Ảnh giảng viên',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('instructor'), //'post', 'page' ),
	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'side',
	// Order of meta box: high (default), low. Optional.
	'priority' => 'low',
	'fields' => array(
		// IMAGE UPLOAD
		array(
			'name' => 'Ảnh giảng viên',
			'id'   => "{$prefix}instructor_image",
			'type' => 'thickbox_image',
			'clone' => false,
		),
	)
);
/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function EDUBOX_INSTRUCTOR_register_instructor_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $instructor_meta_boxes;
	foreach ( $instructor_meta_boxes as $instructor_meta_box )
	{
		new RW_Meta_Box( $instructor_meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'EDUBOX_INSTRUCTOR_register_instructor_meta_boxes' );