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

$prefix = 'EDUBOX_AFFILIATE_COURSE_';

global $affiliate_course_meta_boxes;

$affiliate_course_meta_boxes = array();

// 1st meta box
$affiliate_course_meta_boxes[] = array(
	'title' => 'Nội dung khóa học',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	
	'id' => 'course_content',
		
	'pages' => array('affiliate_course'), //'post', 'page' ),
	
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	
	'fields' => array(
		// WYSIWYG/RICH TEXT EDITOR
		array(
			'name' => 'Nội dung khóa học',
			'id'   => "{$prefix}course_content",
			'type' => 'wysiwyg',
			'std'  => '',

			// Editor settings, see wp_editor() function: look4wp.com/wp_editor
			'options' => array(
				'textarea_rows' => 4,
				'teeny'         => true,
				'media_buttons' => true,
			),
		),
		// text
		array(
			'name' => 'URL',
			'id'   => "{$prefix}course_url",
			'type' => 'text',
			'size' => 105,
		),		
	)
);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function EDUBOX_AFFILIATE_COURSE_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $affiliate_course_meta_boxes;
	foreach ( $affiliate_course_meta_boxes as $affiliate_course_meta_box )
	{
		new RW_Meta_Box( $affiliate_course_meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'EDUBOX_AFFILIATE_COURSE_register_meta_boxes' );