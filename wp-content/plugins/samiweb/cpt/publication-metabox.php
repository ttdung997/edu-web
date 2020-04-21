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
$prefix = 'SAMI_PUBLICATION_';

global $year_array;
$current_year = Date("Y");
for ($i=$current_year; $i >= 1956; $i--){
	$year_array["$i"] = $i;
}

global $instructor_instructor_meta_boxes;
global $publication_meta_boxes;

$publication_meta_boxes = array();

$publication_meta_boxes[] = array(
	'title' => 'Thông tin bài báo',
	'id' => 'publication_content',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('publication'), //'post', 'page' ),
	'context' =>'normal',
	'priority' => 'low',
	'fields' => array(
		// text
		array(
			'name' => 'Tên bài báo',
			'id'   => "{$prefix}publication_title",
			'desc'  => 'Điền tên bài báo. Không để dấu chấm (.) cuối câu',
			'placeholder' => 'Nhập tên bài báo vào đây',
			'type' => 'text',
			'class' => 'full-width',
		),	
		// text
		array(
			'name' => 'Tên tạp chí',
			'id'   => "{$prefix}journal_title",
			'desc'  => 'Điền tên tạp chí xuất bản bài báo. Không để dấu chấm (.) cuối câu',
			'placeholder' => 'Nhập tên tạp chí vào đây',
			'type' => 'text',
			'class' => 'full-width',
		),	
		//SELECT BOX
		array(
			'name'     => 'Năm xuất bản',
			'id'       => "{$prefix}published_year",
			'desc'  => 'Chọn năm xuất bản',
			'type'     => 'select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => $year_array,
			// Select multiple values, optional. Default is false.
			'multiple' => false,
			'clone' => false,
		),	
		// text
		array(
			'name' => 'Số, tập, trang',
			'desc'  => 'Ví dụ: No 4, Vol 3, pagé 33-45; hoặc Số 10, tập 5, trang 4-12',
			'placeholder' => 'Nhập Số, tập, trang vào đây',
			'id'   => "{$prefix}no_vol_page",
			'type' => 'text',
			'class' => 'full-width',
		),	
		// text
		array(
			'name' => 'Danh sách tác giả',
			'id'   => "{$prefix}authors",
			'desc'  => 'Danh sách tác giả, theo đúng trình tự bài báo',
			'placeholder' => 'Nhập danh sách tác giả',
			'type' => 'text',
			'class' => 'full-width',
		),
		// text
		array(
			'name' => 'URL',
			'id'   => "{$prefix}url",
			'desc'  => 'Nhập vào URL tham khảo của bài báo nếu có.',
			'placeholder' => 'URL tham chiếu',
			'type' => 'text',
			'class' => 'full-width',
		),
		// FILE UPLOAD
		array(
			'name' => 'File Upload',
			'desc'  => 'Upload file tóm tắt hoặc toàn văn bài báo (nếu có)',
			'id'   => "{$prefix}file",
			'type' => 'file_advanced',
		)
	),
	'validation' => array(
		'rules' => array(
			"{$prefix}publication_title" => array(
				'required'  => true,
			),
			"{$prefix}journal_title" => array(
				'required' => true,
			),
			"{$prefix}authors" => array(
				'required' => true,
			),
			"{$prefix}no_vol_page" => array(
				'required' => true,
			)
		),
		// optional override of default jquery.validate messages
		'messages' => array(
			"{$prefix}publication_title" => array(
				'required'  => __( 'Bạn phải nhập tên bài báo', 'rwmb' ),
			),
			"{$prefix}journal_title" => array(
				'required'  => __( 'Bạn phải nhập tên tạp chí', 'rwmb' ),
			),			
			"{$prefix}authors" => array(
				'required'  => __( 'Bạn phải nhập danh sách tác giả', 'rwmb' ),
			),
			"{$prefix}no_vol_page" => array(
				'required'  => __( 'Bạn phải nhập thông tin số, tập, trang', 'rwmb' ),
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
function EDUBOX_PUBLICATION_register_publication_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $publication_meta_boxes;
	foreach ( $publication_meta_boxes as $publication_meta_box )
	{
		new RW_Meta_Box( $publication_meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'EDUBOX_PUBLICATION_register_publication_meta_boxes' );
