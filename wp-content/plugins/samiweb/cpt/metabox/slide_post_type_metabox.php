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

global $class_list;
$class_list = array();
$class_query = array('posts_per_page' => '-1', 'post_type' => 'class');
$class_posts = new WP_Query($class_query);
while($class_posts->have_posts()) : $class_posts->the_post();
?>
	<?php
		$class_list[$post->ID] = get_the_title();
	?>
<?php           
endwhile;

$prefix = 'EDUBOX_SLIDE_';

global $slideshow_meta_boxes;

$slideshow_meta_boxes = array();

// 1st meta box
$slideshow_meta_boxes[] = array(
	'title' => 'Lớp học',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('slider'), //'post', 'page' ),
	'fields' => array(
		// SELECT BOX
		array(
			'name'     => 'Chọn lớp học',
			'id'       => "{$prefix}class_id",
			'type'     => 'select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => $class_list,
			// Select multiple values, optional. Default is false.
			'multiple' => false,
			'clone' => false,
		),
		// TEXT
		array(
			// Field name - Will be used as label
			'name'  => 'Tên lớp',
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}class_name",
			// Field description (optional)
			'desc'  => 'Tên lớp',
			'type'  => 'text',
			// Default value (optional)
			//'std'   => '',
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone' => false,
			'size' => 100,
		),

		//TEXT
		array(
			// Field name - Will be used as label
			'name'  => 'Ngày bắt đầu',
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}start_date",
			// Field description (optional)
			'desc'  => 'Ngày bắt đầu',
			'type'  => 'text',
			// Default value (optional)
			//'std'   => '',
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone' => false,
			'size' => 100,
		),		

		//TEXT
		array(
			// Field name - Will be used as label
			'name'  => 'Địa điểm',
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}place",
			// Field description (optional)
			'desc'  => 'Địa điểm',
			'type'  => 'text',
			// Default value (optional)
			//'std'   => '',
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone' => false,
			'size' => 100,
		),		

		//TEXT
		array(
			// Field name - Will be used as label
			'name'  => 'Class url',
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}class_url",
			// Field description (optional)
			'desc'  => 'Địa điểm',
			'type'  => 'text',
			// Default value (optional)
			//'std'   => '',
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone' => false,
			'size' => 100,
		),
		
		// THICKBOX IMAGE UPLOAD (WP 3.3+)
		array(
			'name' => 'Ảnh slide (950 x 375)',
			'id'   => "{$prefix}thickbox",
			'type' => 'thickbox_image',
		),
	)
);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function EDUBOX_SLIDE_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $slideshow_meta_boxes;
	foreach ( $slideshow_meta_boxes as $slideshow_meta_box )
	{
		new RW_Meta_Box( $slideshow_meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'EDUBOX_SLIDE_register_meta_boxes' );

