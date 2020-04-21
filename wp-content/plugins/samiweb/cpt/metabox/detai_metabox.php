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

$project_types['de_tai_cap_nha_nuoc'] = 'Đề tài cấp nhà nước';
$project_types['de_tai_cap_bo'] = 'Đề tài cấp bộ';
$project_types['de_tai_cap_truong'] = 'Đề tài cấp trường';

$prefix = 'SAMI_DETAI_';

//global $detai_year_array;
$current_year = Date("Y");
$end_year_array["0"] = "";
for ($i=$current_year + 10; $i >= 1956; $i--){
	$end_year_array["$i"] = $i;
}
for ($i=$current_year; $i >= 1956; $i--){
	$start_year_array["$i"] = $i;
}

global $detai_meta_boxes;

$detai_meta_boxes = array();

// 1st meta box
$detai_meta_boxes[] = array(
	'title' => 'Thông tin đề tài',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	
	'id' => 'project_content',
		
	'pages' => array('de-tai'), //'post', 'page' ),
	
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
			'size' => 107,
			'class' => 'detai_title',
			'style' => 'max-width:100%'
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
			'size' => 34,
		),
		// text
		array(
			'name' => 'Loại đề tài',
			'id'   => "{$prefix}type",
			'desc'  => 'Loại đề tài. VD: Đề tài nghiên cứu cơ bản, đề tài Nafosted, đề tài cấp Nhà nước, v.v.',
			'type' => 'taxonomy',
			'options' => array(
				// Taxonomy name
				'taxonomy' => 'loai-de-tai',
				// How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree', select_advanced or 'select'. Optional
				'type' => 'select',
				// Additional arguments for get_terms() function. Optional
				'args' => array()
			),
		),				
		// WYSIWYG/RICH TEXT EDITOR
		array(
			'name' => 'Tóm tắt đề tài',
			'id'   => "{$prefix}project_summary",
			'type' => 'textarea',
			'cols' => 20,
			'rows' => 3,
		),
		// text
		array(
			'name' => 'Vai trò',
			'id'   => "{$prefix}key",
			'desc'  => 'Vai trò trong thực hiện đề tài',
			'type' => 'taxonomy',
			'options' => array(
				// Taxonomy name
				'taxonomy' => 'vai-tro',
				// How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree', select_advanced or 'select'. Optional
				'type' => 'select_advanced',
				// Additional arguments for get_terms() function. Optional
				'args' => array()
			),
		),
		//SELECT BOX
		array(
			'name'     => 'Năm bắt đầu',
			'id'       => "{$prefix}start_year",
			'desc'  => 'Chọn năm bắt đầu',
			'type'     => 'select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => $start_year_array,
			// Select multiple values, optional. Default is false.
			'multiple' => false,
			'std' => $current_year,
			'clone' => false,
		),
		//SELECT BOX
		array(
			'name'     => 'Năm kết thúc',
			'id'       => "{$prefix}end_year",
			'desc'  => 'Chọn năm kết thúc',
			'type'     => 'select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => $end_year_array,
			// Select multiple values, optional. Default is false.
			'multiple' => false,
			'clone' => false,
		),	
	),
	'validation' => array(
		'rules' => array(
			"{$prefix}name" => array(
				'required'  => true,
			),
			"{$prefix}type" => array(
				'required'  => true,
			),
			"{$prefix}key" => array(
				'required'  => true,
			),
			"{$prefix}code" => array(
				'required' => true,
			),
			"{$prefix}vaitro" => array(
				'required' => true,
			),
			"{$prefix}start_year" => array(
				'required' => true,
			),
		),
		// optional override of default jquery.validate messages
		'messages' => array(
			"{$prefix}name" => array(
				'required'  => __( 'Bạn phải nhập tên đề tài.', 'rwmb' ),
			),
			"{$prefix}type" => array(
				'required'  => __( 'Bạn phải nhập loại đề tài.', 'rwmb' ),
			),
			"{$prefix}key" => array(
				'required'  => __( 'Bạn phải nhập vai trò.', 'rwmb' ),
			),
			"{$prefix}code" => array(
				'required'  => __( 'Bạn phải nhập mã đề tài', 'rwmb' ),
			),			
			"{$prefix}vaitro" => array(
				'required'  => __( 'Bạn phải nhập vai trò thực hiện đề tài.', 'rwmb' ),
			),			
			"{$prefix}start_year" => array(
				'required'  => __( 'Bạn phải nhập năm bắt đầu thực hiện.', 'rwmb' ),
			),
		)
	)	
);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function SAMI_DETAI_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $detai_meta_boxes;
	foreach ( $detai_meta_boxes as $detai_meta_box )
	{
		new RW_Meta_Box( $detai_meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'SAMI_DETAI_register_meta_boxes' );