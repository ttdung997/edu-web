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
$prefix = 'SAMI_BOOK_';

global $year_array;
$current_year = Date("Y");
for ($i=$current_year; $i >= 1956; $i--){
	$year_array["$i"] = $i;
}

$book_meta_boxes = array();

$book_meta_boxes[] = array(
	'title' => 'Thông tin sách/giáo trình',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('book'), //'post', 'page' ),
	'context' =>'normal',
	'priority' => 'low',
	'fields' => array(
		// text
		array(
			'name' => 'Tên sách',
			'id'   => "{$prefix}title",
			'type' => 'text',
			'size' => 107,
		),	
		// text
		array(
			'name' => 'Danh sách tác giả',
			'id'   => "{$prefix}authors",
			'type' => 'text',
			'size' => 107,
		),	
		// text
		array(
			'name' => 'Tên nhà xuất bản',
			'id'   => "{$prefix}publisher_name",
			'type' => 'text',
			'size' => 33,
		),	
		//SELECT BOX
		array(
			'name'     => 'Năm xuất bản',
			'id'       => "{$prefix}published_year",
			'type'     => 'select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => $year_array,
			// Select multiple values, optional. Default is false.
			'multiple' => false,
			'clone' => false,
		),	
		// text
		array(
			'name' => 'Tập',
			'id'   => "{$prefix}vol",
			'type' => 'text',
			'size' => 33,
		),
	)
);
/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function EDUBOX_BOOK_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $book_meta_boxes;
	foreach ( $book_meta_boxes as $book_meta_box )
	{
		new RW_Meta_Box( $book_meta_box);
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'EDUBOX_BOOK_register_meta_boxes' );