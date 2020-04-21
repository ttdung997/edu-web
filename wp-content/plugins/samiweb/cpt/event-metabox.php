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


$prefix = 'SAMI_EVENTS_';

global $event_meta_boxes;

$event_meta_boxes = array();

// 1st meta box
$event_meta_boxes[] = array(
	'title' => 'Thông tin sự kiện',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	
	'id' => 'event_info',
		
	'pages' => array('event'), //'post', 'page' ),
	
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	
	'fields' => array(
		array(
			'name' => 'Tên sự kiện',
			'id'   => "{$prefix}name",
			'type' => 'text',
			'desc'  => '',
			'placeholder' => 'Nhập tên sự kiện',
			'class' => 'full-width',
			'clone' => false,
		),
		array(
			'name' => 'Đơn vị tổ chức',
			'id'   => "{$prefix}organizer_name",
			'type' => 'text',
			'desc'  => '',
			'placeholder' => 'Nhập tên đơn vị tổ chức',
			'class' => 'full-width',
			'clone' => false,
		),		
		array(
			'name' => 'Ngày',
			'id'   => "{$prefix}date",
			'type' => 'date',

			// jQuery date picker options. See here http://jqueryui.com/demos/datepicker
			'js_options' => array(
				'appendText'      => __( '(yyyy-mm-dd)', 'rwmb' ),
				'dateFormat'      => __( 'yy-mm-dd', 'rwmb' ),
				'changeMonth'     => true,
				'changeYear'      => true,
				'showButtonPanel' => true,
			),
			'placeholder' => 'Ngày diễn ra sự kiện',
			'clone' => false,
		),
		// TIME
		array(
			'name' => 'Giờ bắt đầu',
			'id'   => $prefix . 'start_time',
			'type' => 'time',

			// jQuery datetime picker options. See here http://trentrichardson.com/examples/timepicker/
			'js_options' => array(
				'stepMinute' => 15,
				'showSecond' => false,
				'stepSecond' => 10,
			),
		),
		// TIME
		array(
			'name' => 'Giờ kết thúc',
			'id'   => $prefix . 'end_time',
			'type' => 'time',

			// jQuery datetime picker options. See here http://trentrichardson.com/examples/timepicker/
			'js_options' => array(
				'stepMinute' => 15,
				'showSecond' => false,
				'stepSecond' => 10,
			),
		),		
		// TEXT
		array(
			// Field name - Will be used as label
			'name'  => 'Địa điểm',
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}location",
			// Field description (optional)
			'desc'  => '',
			'type'  => 'text',
			// Default value (optional)
			//'std'   => '',
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone' => false,
			'placeholder' => 'Nhập địa điểm diễn ra sự kiện',
			'class' => 'full-width',
		),
		//SELECT BOX
		array(
			'name'     => 'Mô tả sự kiện',
			'id'       => "{$prefix}summary",
			'desc'  => 'Mô tả nội dung sự kiện',
			'type'     => 'wysiwyg',
			'placeholder' => 'Viết mô tả nội dung sự kiện vào đây',
			'rows' => 2,
		),		
		// FILE UPLOAD
		array(
			'name' => 'File đính kèm',
			'id'   => "{$prefix}file",
			'desc'  => 'Tài liệu đính kèm',
			'type' => 'file_advanced',
			'clone' => false
		)		
	),
	'validation' => array(
		'rules' => array(
			"{$prefix}name" => array(
				'required'  => true,
			),
			"{$prefix}date" => array(
				'required' => true,
			),
			"{$prefix}start_time" => array(
				'required'  => true,
			),
			"{$prefix}location" => array(
				'required'  => true,
			),
			"{$prefix}organizer_name" => array(
				'required'  => true,
			),
			"{$prefix}summary" => array(
				'required'  => true,
			),			
		),
		// optional override of default jquery.validate messages
		'messages' => array(
			"{$prefix}name" => array(
				'required'  => __( 'Bạn phải nhập tên sự kiện', 'rwmb' ),
			),
			"{$prefix}date" => array(
				'required'  => __( 'Bạn phải nhập ngày diễn ra sự kiện', 'rwmb' ),
			),
			"{$prefix}start_time" => array(
				'required'  => __( 'Bạn phải nhập giờ bắt đầu sự kiện', 'rwmb' ),
			),
			"{$prefix}location" => array(
				'required'  => __( 'Bạn phải nhập địa điểm', 'rwmb' ),
			),
			"{$prefix}organizer_name" => array(
				'required'  => __( 'Bạn phải nhập tên đơn vị tổ chức', 'rwmb' ),
			),
			"{$prefix}summary" => array(
				'required'  => __( 'Bạn phải nhập tóm tắt sự kiện', 'rwmb' ),
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
function SAMI_EVENTS_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $event_meta_boxes;
	foreach ( $event_meta_boxes as $event_meta_box )
	{
		new RW_Meta_Box( $event_meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'SAMI_EVENTS_register_meta_boxes' );
?>
