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

global $year_array;
$current_year = Date("Y");
for ($i=$current_year; $i >= 1956; $i--){
	$year_array["$i"] = $i;
}

global $project_types;

$taxonomy = 'de-tai';
//$project_types = get_taxonomy($taxonomy);//get_terms($taxonomy);
//var_dump($project_types);

$project_types['de_tai_cap_nha_nuoc'] = 'Đề tài cấp nhà nước';
$project_types['de_tai_cap_bo'] = 'Đề tài cấp bộ';
$project_types['de_tai_cap_truong'] = 'Đề tài cấp trường';

$prefix = 'SAMI_PROJECT_';

global $project_meta_boxes;

$project_meta_boxes = array();

// 1st meta box
$project_meta_boxes[] = array(
	'title' => 'Thông tin đề tài',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	
	'id' => 'project_content',
		
	'pages' => array('project'), //'post', 'page' ),
	
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	
	'fields' => array(
		// TEXT
		array(
			// Field name - Will be used as label
			'name'  => 'Tên đề tài',
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}name",
			// Field description (optional)
			'desc'  => 'Tên đề tài',
			'type'  => 'text',
			// Default value (optional)
			//'std'   => '',
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone' => false,
			'size' => 50,
		),
		// TEXT
		array(
			// Field name - Will be used as label
			'name'  => 'Mã đề tài',
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}code",
			// Field description (optional)
			'desc'  => 'Mã đề tài',
			'type'  => 'text',
			// Default value (optional)
			//'std'   => '',
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone' => false,
			'size' => 30,
		),		
		// WYSIWYG/RICH TEXT EDITOR
		array(
			'name' => 'Tóm tắt đề tài',
			'id'   => "{$prefix}project_summary",
			'type' => 'textarea',
			'cols' => 20,
			'rows' => 3,
		),
		// TEXT
		array(
			// Field name - Will be used as label
			'name'  => 'Chủ trì',
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}chutri",
			// Field description (optional)
			'desc'  => 'Tên người chủ trì đề tài',
			'type'  => 'text',
			// Default value (optional)
			//'std'   => '',
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone' => false,
			'size' => 50,
		),		
		// TEXT
		array(
			// Field name - Will be used as label
			'name'  => 'Nhóm thực hiện',
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}group",
			// Field description (optional)
			'desc'  => 'Danh sách những người tham gia đề tài',
			'type'  => 'text',
			// Default value (optional)
			//'std'   => '',
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone' => false,
			'size' => 107,
		),
		//SELECT BOX
		array(
			'name'     => 'Năm bắt đầu thực hiện',
			'id'       => "{$prefix}start_year",
			'type'     => 'select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => $year_array,
			// Select multiple values, optional. Default is false.
			'multiple' => false,
			'clone' => false,
		),		
		//SELECT BOX
		array(
			'name'     => 'Cấp độ đề tài',
			'id'       => "{$prefix}project_type",
			'type'    => 'taxonomy',
			'options' => array(
				// Taxonomy name
				'taxonomy' => 'de-tai',
				// How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree', select_advanced or 'select'. Optional
				'type' => 'select',
				// Additional arguments for get_terms() function. Optional
				'args' => array()
			),
		),
	)
);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function SAMI_PROJECT_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $project_meta_boxes;
	foreach ( $project_meta_boxes as $project_meta_box )
	{
		new RW_Meta_Box( $project_meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'SAMI_PROJECT_register_meta_boxes' );