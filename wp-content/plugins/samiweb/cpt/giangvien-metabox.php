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


//$project_types = get_taxonomy($taxonomy);//get_terms($taxonomy);
//var_dump($project_types);

$prefix = 'SAMI_LECTURER_';

global $lecturer_meta_boxes;

$lecturer_meta_boxes = array();

// 1st meta box
$lecturer_meta_boxes[] = array(
	'title' => 'Tên bộ môn',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	
	'id' => 'project_content',
		
	'pages' => array('danh-sach-giang-vien'), //'post', 'page' ),
	
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	
	'fields' => array(
		// TEXT
		array(
			// Field name - Will be used as label
			'name'  => 'Tên bộ môn',
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}department_name",
			// Field description (optional)
			'desc'  => 'Nhập tên bộ môn',
			'type'  => 'text',
			// Default value (optional)
			//'std'   => '',
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone' => false,
			'class' => 'full-width',
			'style' => 'max-width:100%',
			'placeholder' => 'Nhập tên bộ môn vào đây'
		),
		// text
		array(
			'name' => 'Tên tài khoản/ Tên cán bộ',
			'id'   => "{$prefix}account_name",
			'desc'  => 'Tên tài khoản',
			'placeholder' => 'Chọn tên tài khoản',
			'type' => 'user',
			'options' => array(
				'type' => 'select',
				'args' => array()
			),
			'clone' => true
		),
	),
);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function SAMI_LECTURER_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $lecturer_meta_boxes;
	foreach ( $lecturer_meta_boxes as $lecturer_meta_box )
	{
		new RW_Meta_Box( $lecturer_meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'SAMI_LECTURER_register_meta_boxes' );
