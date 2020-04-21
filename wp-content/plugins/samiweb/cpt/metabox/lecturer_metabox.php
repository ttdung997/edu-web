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
$prefix = 'EDUBOX_LECTURER_';

global $instructor_instructor_meta_boxes;

$lecturer_meta_boxes = array();

$lecturer_meta_boxes[] = array(
	'title' => 'Bộ môn',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('lecturer'), //'post', 'page' ),
	'context' => 'side',
	'priority' => 'low',
	'fields' => array(
		// TAXONOMY
		array(
			'name'    => '',
			'id'      => "{$prefix}department",
			'type'    => 'taxonomy',
			'options' => array(
				// Taxonomy name
				'taxonomy' => 'bomon',
				// How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree' or 'select'. Optional
				'type' => 'select_tree',
				// Additional arguments for get_terms() function. Optional
				'args' => array()
			),
		),	
	)
);

// 1st meta box
$lecturer_meta_boxes[] = array(
	'title' => 'Thông tin cá nhân',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('lecturer'), //'post', 'page' ),
	'fields' => array(
		// PLUPLOAD IMAGE UPLOAD (WP 3.3+)
		array(
			'name'             => 'Ảnh đại diện',
			'id'               => "{$prefix}profile_image",
			'type'             => 'plupload_image',
			'max_file_uploads' => 1,
		),
		// WYSIWYG/RICH TEXT EDITOR
		array(
			'name' => 'Ngày tháng năm sinh',
			'id'   => "{$prefix}instructor_birthday",
			'type' => 'date',

			// jQuery date picker options. See here http://jqueryui.com/demos/datepicker
			'js_options' => array(
				'appendText'      => '(yyyy-mm-dd)',
				'dateFormat'      => 'yy-mm-dd',
				'changeMonth'     => true,
				'changeYear'      => true,
				'showButtonPanel' => true,
			),
		),
		// text
		array(
			'name' => 'Điện thoại di động',
			'id'   => "{$prefix}mobile_phone",
			'type' => 'text',
			'size' => 60,
		),
		// text
		array(
			'name' => 'Văn phòng',
			'id'   => "{$prefix}office_address",
			'type' => 'text',
			'size' => 60,
		),
		// text
		array(
			'name' => 'Điện thoại cơ quan',
			'id'   => "{$prefix}office_phone",
			'type' => 'text',
			'size' => 60,
			'sdt' => '043 869 2137',
		),
		// text
		array(
			'name' => 'Email',
			'id'   => "{$prefix}lecturer_email",
			'type' => 'text',
			'size' => 60,
		),
		// text
		array(
			'name' => 'Homepage',
			'id'   => "{$prefix}lecturer_homepage",
			'type' => 'text',
			'size' => 60,
		),
		// text
		array(
			'name' => 'Địa chỉ nhà',
			'id'   => "{$prefix}home_address",
			'type' => 'text',
			'size' => 60,
		),
		// text
		array(
			'name' => 'Điện thoại bàn',
			'id'   => "{$prefix}home_phone",
			'type' => 'text',
			'size' => 60,
		),
		/*		
		// IMAGE UPLOAD
		array(
			'name' => '?nh gi?ng vien',
			'id'   => "{$prefix}instructor_image",
			'type' => 'image',
		),
*/		
	)
);

// 2nd meta box
$lecturer_meta_boxes[] = array(
	'title' => 'Học hàm, học vị, chức vụ',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('lecturer'), //'post', 'page' ),
	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',
	// Order of meta box: high (default), low. Optional.
	'priority' => 'low',
	'fields' => array(
		// IMAGE UPLOAD
		array(
			'name' => 'Chức vụ',
			'id'   => "{$prefix}chuc_vu",
			'type' => 'text',
			'std'  => ''
		),
		// IMAGE UPLOAD
		array(
			'name' => 'Chức vụ (hiển thị ở danh sách)',
			'id'   => "{$prefix}chuc_vu_list",
			'type' => 'text',
			'std'  => ''
		),
		// IMAGE UPLOAD
		array(
			'name' => 'Học hàm (GS, PGS)',
			'id'   => "{$prefix}hoc_ham",
			'type' => 'text',
			'std'  => ''
		),
		// IMAGE UPLOAD
		array(
			'name' => 'Học vị (TS, ThS, KS, CN)',
			'id'   => "{$prefix}hoc_vi",
			'type' => 'text',
			'std'  => ''
		),
		// IMAGE UPLOAD
		array(
			'name' => 'Danh hiệu (GVCC, GVC, NGUT, NGND, ...)',
			'id'   => "{$prefix}danh_hieu",
			'type' => 'text',
			'std'  => ''
		),
	)
);

// 2nd meta box
$lecturer_meta_boxes[] = array(
	'title' => 'Tiểu sử',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('lecturer'), //'post', 'page' ),
	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',
	// Order of meta box: high (default), low. Optional.
	'priority' => 'low',
	'fields' => array(
		// IMAGE UPLOAD
		array(
			'name' => 'Quá trình học tập',
			'id'   => "{$prefix}study_history",
			'type' => 'wysiwyg',
			'std'  => '',

			// Editor settings, see wp_editor() function: look4wp.com/wp_editor
			'options' => array(
				'textarea_rows' => 4,
				'teeny'         => false,
				'media_buttons' => false,
			),
		),
		// IMAGE UPLOAD
		array(
			'name' => 'Quá trình công tác',
			'id'   => "{$prefix}work_history",
			'type' => 'wysiwyg',
			'std'  => '',

			// Editor settings, see wp_editor() function: look4wp.com/wp_editor
			'options' => array(
				'textarea_rows' => 4,
				'teeny'         => true,
				'media_buttons' => true,
			),
		),
	)
);

// 2nd meta box
$lecturer_meta_boxes[] = array(
	'title' => 'Thành tích',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('lecturer'), //'post', 'page' ),
	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',
	// Order of meta box: high (default), low. Optional.
	'priority' => 'low',
	'fields' => array(
		// IMAGE UPLOAD
		array(
			'name' => 'Các môn học đã và đang giảng dạy',
			'id'   => "{$prefix}subject",
			'type' => 'wysiwyg',
			'std'  => '',

			// Editor settings, see wp_editor() function: look4wp.com/wp_editor
			'options' => array(
				'textarea_rows' => 4,
				'teeny'         => false,
				'media_buttons' => false,
			),
		),
		// IMAGE UPLOAD
		array(
			'name' => 'Hướng nghiên cứu',
			'id'   => "{$prefix}research_interest",
			'type' => 'wysiwyg',
			'std'  => '',

			// Editor settings, see wp_editor() function: look4wp.com/wp_editor
			'options' => array(
				'textarea_rows' => 4,
				'teeny'         => false,
				'media_buttons' => false,
			),
		),
		// IMAGE UPLOAD
		array(
			'name' => 'Các bài báo',
			'id'   => "{$prefix}publication",
			'type' => 'wysiwyg',
			'std'  => '',

			// Editor settings, see wp_editor() function: look4wp.com/wp_editor
			'options' => array(
				'textarea_rows' => 4,
				'teeny'         => false,
				'media_buttons' => false,
			),
		),
		// IMAGE UPLOAD
		array(
			'name' => 'Các đề tài khoa học',
			'id'   => "{$prefix}projects",
			'type' => 'wysiwyg',
			'std'  => '',

			// Editor settings, see wp_editor() function: look4wp.com/wp_editor
			'options' => array(
				'textarea_rows' => 4,
				'teeny'         => false,
				'media_buttons' => false,
			),
		),
		// IMAGE UPLOAD
		array(
			'name' => 'Sách và giáo trình đã xuất bản',
			'id'   => "{$prefix}published_books",
			'type' => 'wysiwyg',
			'std'  => '',

			// Editor settings, see wp_editor() function: look4wp.com/wp_editor
			'options' => array(
				'textarea_rows' => 4,
				'teeny'         => true,
				'media_buttons' => true,
			),
		),
		// IMAGE UPLOAD
		array(
			'name' => 'Hướng dẫn nghiên cứu sinh, cao học',
			'id'   => "{$prefix}phd_guide",
			'type' => 'wysiwyg',
			'std'  => '',

			// Editor settings, see wp_editor() function: look4wp.com/wp_editor
			'options' => array(
				'textarea_rows' => 4,
				'teeny'         => true,
				'media_buttons' => true,
			),
		),
	)
);

$lecturer_meta_boxes[] = array(
	'title' => 'Bài giảng, tài liệu',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	
	'id' => 'lecturer_document',
		
	'pages' => array('lecturer'), //'post', 'page' ),
	
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	
	'fields' => array(
		// FILE UPLOAD
		array(
			'name' => 'Upload tài liệu, bài giảng',
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
function EDUBOX_INSTRUCTOR_register_lecturer_meta_boxes()
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
add_action( 'admin_init', 'EDUBOX_INSTRUCTOR_register_lecturer_meta_boxes' );