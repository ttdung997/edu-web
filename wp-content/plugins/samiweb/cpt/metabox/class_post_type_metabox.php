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

global $instructor_list;
$instructor_list = array();
$instructor_list['0'] = '';
global $current_user;
get_currentuserinfo();
$author_query = array('posts_per_page' => '-1','author' => $current_user->ID, 'post_type' => 'instructor');
$author_posts = new WP_Query($author_query);
while($author_posts->have_posts()) : $author_posts->the_post();
	$instructor_list[$post->ID] = get_the_title();
endwhile;

global $contact_info_list;
$contact_info_list = array();
$contact_info_list['0'] = '';
$author_query = array('posts_per_page' => '-1','author' => $current_user->ID, 'post_type' => 'contact_info');
$author_posts = new WP_Query($author_query);
while($author_posts->have_posts()) : $author_posts->the_post();
?>
	<?php
		$contact_info_list[$post->ID] = get_the_title();
	?>
<?php           
endwhile;


$prefix = 'EDUBOX_CLASS_';

global $class_meta_boxes;

$class_meta_boxes = array();

// 1st meta box
$class_meta_boxes[] = array(
	'title' => 'Nội dung khóa học',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	
	'id' => 'class_content',
		
	'pages' => array('class'), //'post', 'page' ),
	
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	
	'fields' => array(
		// WYSIWYG/RICH TEXT EDITOR
		array(
			'name' => 'Nội dung khóa học',
			'id'   => "{$prefix}class_content",
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

// 1st meta box
$time_place = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'time_place',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => 'Thời gian, địa điểm',

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('class'), //'post', 'page' ),

	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',

	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		// DATE
		array(
			'name' => 'Ngày bắt đầu',
			'id'   => "{$prefix}start_date",
			'type' => 'date',

			// jQuery date picker options. See here http://jqueryui.com/demos/datepicker
			'js_options' => array(
				'appendText'      => '(dd/mm/yyyy)',
				'dateFormat'      => 'dd/mm/yy',
				'changeMonth'     => true,
				'changeYear'      => true,
				'showButtonPanel' => true,
			),
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
		// TEXT
		array(
			// Field name - Will be used as label
			'name'  => 'Lịch khai giảng (detail)',
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}lich_khai_giang_detail",
			// Field description (optional)
			'desc'  => 'Lịch khai giảng',
			'type'  => 'text',
			// Default value (optional)
			//'std'   => '',
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone' => false,
			'size' => 100,
		),		
		// DATE
		array(
			'name' => 'Ngày kết thúc',
			'id'   => "{$prefix}end_date",
			'type' => 'date',

			// jQuery date picker options. See here http://jqueryui.com/demos/datepicker
			'js_options' => array(
				'appendText'      => '(dd/mm/yyyy)',
				'dateFormat'      => 'dd/mm/yy',
				'changeMonth'     => true,
				'changeYear'      => true,
				'showButtonPanel' => true,
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
		//SELECT BOX
		array(
			'name'     => 'Tỉnh/thành phố',
			'id'       => "{$prefix}class_province",
			'type'     => 'select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'hn' => 'Hà Nội',
				'hcm' => 'TP Hồ Chí Minh',
			),
			// Select multiple values, optional. Default is false.
			'multiple' => false,
			'clone' => false,
		),
		// TEXT
		array(
			// Field name - Will be used as label
			'name'  => 'Địa chỉ',
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}dia_diem",
			// Field description (optional)
			'desc'  => 'Địa chỉ tổ chức khóa học',
			'type'  => 'text',
			// Default value (optional)
			//'std'   => '',
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone' => true,
			'size' => 100,
		),
		// TEXTAREA
		/*
		array(
			'name' => 'Textarea',
			'desc' => 'Textarea description',
			'id'   => "{$prefix}textarea",
			'type' => 'textarea',
			'cols' => '20',
			'rows' => '3',
		),*/
	)
);
$class_meta_boxes[] = $time_place;
$class_meta_boxes[] = $time_place;

// 2nd meta box
$class_meta_boxes[] = array(
	'title' => 'Học phí',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'id' => 'class_price',
	'pages' => array('class'), //'post', 'page' ),
	'fields' => array(
		// text
		array(
			'name' => 'Học phí',
			'id'   => "{$prefix}fee",
			'type' => 'text'
		),
		// text
		array(
			'name' => 'Giá ưu đãi',
			'id'   => "{$prefix}fee_discount",
			'type' => 'text'
		),
		// TEXTAREA
		
		array(
			'name' => 'Thông tin khuyến mại',
			'desc' => 'Nhập chi tiết thông tin khuyến mại',
			'id'   => "{$prefix}discount_detail",
			'type' => 'wysiwyg',
			// Editor settings, see wp_editor() function: look4wp.com/wp_editor
			'options' => array(
				'textarea_rows' => 4,
				'teeny'         => true,
				'media_buttons' => true,
			),
		),
		/*
		// TAXONOMY
		array(
			'name'    => 'Taxonomy',
			'id'      => "{$prefix}taxonomy",
			'type'    => 'taxonomy',
			'options' => array(
				// Taxonomy name
				'taxonomy' => 'class_category',
				// How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree' or 'select'. Optional
				'type' => 'select_advanced',
				// Additional arguments for get_terms() function. Optional
				'args' => array()
			),
		),
		
		// WYSIWYG/RICH TEXT EDITOR
		array(
			'name' => 'WYSIWYG / Rich Text Editor',
			'id'   => "{$prefix}wysiwyg",
			'type' => 'wysiwyg',
			'std'  => 'WYSIWYG default value',

			// Editor settings, see wp_editor() function: look4wp.com/wp_editor
			'options' => array(
				'textarea_rows' => 4,
				'teeny'         => true,
				'media_buttons' => false,
			),
		),
		// FILE UPLOAD
		array(
			'name' => 'File Upload',
			'id'   => "{$prefix}file",
			'type' => 'file',
		),
		// IMAGE UPLOAD
		array(
			'name' => 'Image Upload',
			'id'   => "{$prefix}image",
			'type' => 'image',
		),
		// THICKBOX IMAGE UPLOAD (WP 3.3+)
		array(
			'name' => 'Thichbox Image Upload',
			'id'   => "{$prefix}thickbox",
			'type' => 'thickbox_image',
		),
		// PLUPLOAD IMAGE UPLOAD (WP 3.3+)
		array(
			'name'             => 'Plupload Image Upload',
			'id'               => "{$prefix}plupload",
			'type'             => 'plupload_image',
			'max_file_uploads' => 4,
		),
		*/
	)
);

// 2nd meta box
$class_meta_boxes[] = array(
	'title' => 'Giảng viên',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('class'), //'post', 'page' ),
	'fields' => array(
		// SELECT BOX
		array(
			'name'     => 'Chọn giảng viên',
			'id'       => "{$prefix}instructor_name",
			'type'     => 'select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => $instructor_list,
			// Select multiple values, optional. Default is false.
			'multiple' => false,
			'clone' => false,
		),
/*
		// text
		array(
			'name' => 'Họ và tên',
			'id'   => "{$prefix}instructor_name",
			'type' => 'text'
		),
		// text
		array(
			'name' => 'Công việc hiện tại',
			'id'   => "{$prefix}instructor_job",
			'type' => 'text'
		),
		// IMAGE UPLOAD
		array(
			'name' => 'Ảnh giảng viên',
			'id'   => "{$prefix}instructor_image",
			'type' => 'image',
		),
		// TEXTAREA
		array(
			'name' => 'Thông tin giảng viên',
			'desc' => 'Thông tin giảng viên',
			'id'   => "{$prefix}instructor_info",
			'type' => 'textarea',
			'cols' => '20',
			'rows' => '3',
		)
*/		
	)
);

//anh slide show

$class_meta_boxes[] = array(
	'title' => 'Ảnh slide show',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('class'), //'post', 'page' ),
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',	
	'fields' => array(
		// IMAGE UPLOAD
		array(
			'name' => 'Ảnh slide show',
			'id'   => "{$prefix}class_slide_image",
			'type' => 'image',
		),
	)
);
// 2nd meta box
$class_meta_boxes[] = array(
	'title' => 'Liên hệ',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('class'), //'post', 'page' ),
	'fields' => array(
		// SELECT BOX
		array(
			'name'     => 'Select',
			'id'       => "{$prefix}contact_info_id",
			'type'     => 'select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => $contact_info_list/*array(
				//foreach($instructor_list as $key => $value){
				//	"$key" => "$value",
				//}
				'value1' => 'Label1',
				'value2' => 'Label2',
			)*/,
			// Select multiple values, optional. Default is false.
			'multiple' => false,
			'clone' => false,
		),
/*		
		// text
		array(
			'name' => 'Họ và tên người liên hệ',
			'id'   => "{$prefix}contact_name",
			'type' => 'text'
		),
		// text
		array(
			'name' => 'Số điện thoại',
			'id'   => "{$prefix}contact_phone",
			'type' => 'text'
		),
		// text
		array(
			'name' => 'Số fax',
			'id'   => "{$prefix}contact_fax",
			'type' => 'text'
		),
		// text
		array(
			'name' => 'Di động',
			'id'   => "{$prefix}contact_mobile",
			'type' => 'text'
		),
		// text
		array(
			'name' => 'Email',
			'id'   => "{$prefix}contact_email",
			'type' => 'text'
		),
		// text
		array(
			'name' => 'Địa chỉ',
			'id'   => "{$prefix}contact_address",
			'type' => 'text',
			'size' => 60,
		),
*/		
	)
);
/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function EDUBOX_CLASS_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $class_meta_boxes;
	foreach ( $class_meta_boxes as $class_meta_box )
	{
		new RW_Meta_Box( $class_meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'EDUBOX_CLASS_register_meta_boxes' );