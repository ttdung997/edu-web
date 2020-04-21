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
$prefix = 'SAMI_SEMINAR_';

global $year_array;
$current_year = Date("Y");
for ($i=$current_year; $i >= 1956; $i--){
	$year_array["$i"] = $i;
}

$seminar_meta_boxes = array();

$seminar_meta_boxes[] = array(
	'title' => 'Thông tin seminar',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('seminar'), //'post', 'page' ),
	'context' =>'normal',
	'priority' => 'low',
	'fields' => array(
		// text
		array(
			'name' => 'Tên báo cáo',
			'id'   => "{$prefix}report_title",
			'desc'  => 'Nhập tên báo cáo. Không để dấu chấm (.) cuối câu',
			'type' => 'text',
			'size' => 70,
		),	
		// text
		array(
			'name' => 'Tên seminar',
			'id'   => "{$prefix}seminar_name",
			'desc'  => 'Chọn tên seminar',
			'type' => 'taxonomy',
			'options' => array(
				// Taxonomy name
				'taxonomy' => 'seminars',
				// How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree', select_advanced or 'select'. Optional
				'type' => 'select',
				// Additional arguments for get_terms() function. Optional
				'args' => array()
			),
		),	
		//SELECT BOX
		array(
			'name'     => 'Người báo cáo',
			'id'       => "{$prefix}reporter",
			'desc'  => 'Nhập vào tên người báo cáo.',
			'type'     => 'text',
			'size' => 70,
		),
		//SELECT BOX
		array(
			'name'     => 'Đơn vị',
			'id'       => "{$prefix}institute",
			'desc'  => 'Cơ quan người báo cáo.',
			'type'     => 'text',
			'size' => 70,
		),
		array(
			'name' => 'Ngày',
			'id'   => "SAMI_EVENTS_date",
			'type' => 'date',

			// jQuery date picker options. See here http://jqueryui.com/demos/datepicker
			'js_options' => array(
				'appendText'      => __( '(yyyy-mm-dd)', 'rwmb' ),
				'dateFormat'      => __( 'yy-mm-dd', 'rwmb' ),
				'changeMonth'     => true,
				'changeYear'      => true,
				'showButtonPanel' => true,
			),
			'clone' => false,
		),
		// TIME
		array(
			'name' => 'Giờ bắt đầu',
			'id'   => 'SAMI_EVENTS_start_time',
			'type' => 'time',

			// jQuery datetime picker options. See here http://trentrichardson.com/examples/timepicker/
			'js_options' => array(
				'stepMinute' => 15,
			),
		),
		//SELECT BOX
		array(
			'name'     => 'Địa điểm',
			'id'       => "SAMI_EVENTS_location",
			'desc'  => 'Địa điểm báo cáo.',
			'type'     => 'text',
			'size' => 70,
		),
		// text
		array(
			'name' => 'URL',
			'id'   => "{$prefix}url",
			'desc'  => 'Nhập vào URL tham khảo của bài báo nếu có.',
			'type' => 'text',
			'size' => 70,
		),
		//SELECT BOX
		array(
			'name'     => 'Tóm tắt nội dung báo cáo',
			'id'       => "{$prefix}report_summary",
			'desc'  => 'Tóm tắt nội dung báo cáo.',
			'type'     => 'wysiwyg',
		),		
		// FILE UPLOAD
		array(
			'name' => 'File đính kèm',
			'desc'  => 'Upload file tóm tắt hoặc toàn văn báo cáo',
			'id'   => "{$prefix}file",
			'type' => 'file_advanced',
		)
	),
	'validation' => array(
		'rules' => array(
			"{$prefix}report_title" => array(
				'required'  => true,
			),
			"{$prefix}reporter" => array(
				'required' => true,
			),
			"SAMI_EVENTS_date" => array(
				'required' => true,
			),
			"SAMI_EVENTS_start_time" => array(
				'required' => true,
			),
			"SAMI_EVENTS_location" => array(
				'required' => true,
			),
			"{$prefix}seminar_name" => array(
				'required'  => true,
			),
		),
		// optional override of default jquery.validate messages
		'messages' => array(
			"{$prefix}report_title" => array(
				'required'  => __( 'Bạn phải nhập tên báo cáo', 'rwmb' ),
			),
			"{$prefix}reporter" => array(
				'required'  => __( 'Cần nhập tên người báo cáo', 'rwmb' ),
			),"SAMI_EVENTS_date" => array(
				'required'  => __( 'Bạn phải nhập ngày báo cáo', 'rwmb' ),
			),"SAMI_EVENTS_start_time" => array(
				'required'  => __( 'Bạn phải nhập giờ bắt đầu báo cáo', 'rwmb' ),
			),
			"SAMI_EVENTS_location" => array(
				'required'  => __( 'Bạn phải nhập địa điểm báo cáo.', 'rwmb' ),
			),
			"{$prefix}seminar_name" => array(
				'required'  => __( 'Bạn phải chọn tên seminar.', 'rwmb' ),
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
function EDUBOX_SEMINAR_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $seminar_meta_boxes;
	foreach ( $seminar_meta_boxes as $seminar_meta_box )
	{
		new RW_Meta_Box( $seminar_meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'EDUBOX_SEMINAR_register_meta_boxes' );