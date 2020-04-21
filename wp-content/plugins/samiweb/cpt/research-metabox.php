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

$prefix = 'SAMI_RESEARCH_';

global $research_meta_boxes;

$research_meta_boxes = array();

$research_meta_boxes[] = array(
	'title' => 'Thông tin nhóm nghiên cứu',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('research'), //'post', 'page' ),
	'context' =>'normal',
	'priority' => 'high',
	'fields' => array(
		// text
		array(
			'name' => 'Tên nhóm nghiên cứu',
			'id'   => "{$prefix}group_title",
			'desc'  => 'Nhập tên nhóm nghiên cứu. Ví dụ: nhóm nghiên cứu Toán tin, nhóm nghiên cứu Phương trình đạo hàm riêng.',
			'type' => 'text',
			'size' => 70,
		),	
		// text
		array(
			'name' => 'Tên trưởng nhóm nghiên cứu',
			'id'   => "{$prefix}group_leader",
			'desc'  => 'Nhập tên trưởng nhóm nghiên cứu.',
			'type' => 'text',
			'size' => 70,
		),	
		//SELECT BOX
		array(
			'name'     => 'Các thành viên chính của nhóm',
			'id'       => "{$prefix}key_members",
			'desc'  => 'Nhập tên các thành viên chính của nhóm.',
			'type'     => 'wysiwyg',
		),
	),
	'validation' => array(
		'rules' => array(
			"{$prefix}group_title" => array(
				'required'  => true,
			),
			"{$prefix}group_leader" => array(
				'required' => true,
			),
			"{$prefix}key_members" => array(
				'required' => true,
			),
		),
		// optional override of default jquery.validate messages
		'messages' => array(
			"{$prefix}group_title" => array(
				'required'  => __( 'Bạn phải nhập tên nhóm nghiên cứu', 'rwmb' ),
			),
			"{$prefix}group_leader" => array(
				'required'  => __( 'Bạn phải nhập tên trưởng nhóm nghiên cứu', 'rwmb' ),
			),
			"{$prefix}key_members" => array(
				'required'  => __( 'Bạn phải nhập tên các thành viên chính của nhóm', 'rwmb' ),
			)			
		)
	)	
);

$research_meta_boxes[] = array(
	'title' => 'Liên hệ',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('research'), //'post', 'page' ),
	'context' =>'normal',
	'priority' => 'high',
	'fields' => array(
		// text
		array(
			'name' => 'Tên người liên hệ',
			'id'   => "{$prefix}contact_person",
			'desc'  => 'Nhập tên người liên hệ',
			'type' => 'text',
			'size' => 50,
		),	
		// text
		array(
			'name' => 'Email',
			'id'   => "{$prefix}contact_email",
			'desc'  => 'Nhập địa chỉ email.',
			'type' => 'text',
			'size' => 50,
		),	
		//text BOX
		array(
			'name'     => 'Số điện thoại',
			'id'       => "{$prefix}contact_phone",
			'desc'  => 'Nhập số điện thoại. Ví dụ: 034 896 2137 hoặc 043 896 2137 / 0918 000 000',
			'type'     => 'text',
			'size' => 50,
		),
		//text BOX
		array(
			'name'     => 'Nhập địa chỉ',
			'id'       => "{$prefix}contact_address",
			'desc'  => 'Nhập địa chỉ làm việc.',
			'type'     => 'text',
			'size' => 50,
		),
	),
	'validation' => array(
		'rules' => array(
			"{$prefix}contact_person" => array(
				'required'  => true,
			),
			"{$prefix}contact_email" => array(
				'required' => true,
			),
			"{$prefix}contact_phone" => array(
				'required' => true,
			)
		),
		// optional override of default jquery.validate messages
		'messages' => array(
			"{$prefix}contact_person" => array(
				'required'  => __( 'Bạn phải nhập tên người liên hệ.', 'rwmb' ),
			),
			"{$prefix}contact_email" => array(
				'required'  => __( 'Bạn phải nhập email liên hệ', 'rwmb' ),
			),
			"{$prefix}contact_phone" => array(
				'required'  => __( 'Bạn phải nhập số điện thoại liên hệ', 'rwmb' ),
			),			
		)
	)	
);

$research_meta_boxes[] = array(
	'title' => 'Các cộng sự nghiên cứu khác',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('research'), //'post', 'page' ),
	'context' =>'normal',
	'priority' => 'high',
	'fields' => array(
		// text
		array(
			'name' => 'Thông tin người công sự',
			'id'   => "{$prefix}corporate_person",
			'desc'  => 'Nhập thông tin người cộng sự. Ví dụ: GS. TS Nguyễn Văn A, Viện nghiên cứu Toán cao cấp',
			'type' => 'wysiwyg'
		),
	),
);

$research_meta_boxes[] = array(
	'title' => 'Giới thiệu chung',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('research'), //'post', 'page' ),
	'context' =>'normal',
	'priority' => 'default',
	'fields' => array(
		// text
		array(
			'name' => 'Giới thiệu chung',
			'id'   => "{$prefix}introduction",
			'desc'  => 'Nhập thông tin giới thiệu về lĩnh vực nghiên cứu của nhóm.',
			'type' => 'wysiwyg',
		),
	),
	'validation' => array(
		'rules' => array(
			"{$prefix}introduction" => array(
				'required'  => true,
			),
		),
		// optional override of default jquery.validate messages
		'messages' => array(
			"{$prefix}introduction" => array(
				'required'  => __( 'Bạn phải nhập giới thiệu chung về nhóm.', 'rwmb' ),
			),	
		)
	)	
);

$research_meta_boxes[] = array(
	'title' => 'Các hướng nghiên cứu mũi nhọn',
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('research'), //'post', 'page' ),
	'context' =>'normal',
	'priority' => 'default',
	'fields' => array(
		// text
		array(
			'name' => 'Hướng nghiên cứu mũi nhọn',
			'id'   => "{$prefix}direction",
			'desc'  => 'Nhập thông tin giới thiệu về lĩnh vực nghiên cứu của nhóm.',
			'type' => 'wysiwyg',
		),
	),
	'validation' => array(
		'rules' => array(
			"{$prefix}direction" => array(
				'required'  => true,
			),
		),
		// optional override of default jquery.validate messages
		'messages' => array(
			"{$prefix}direction" => array(
				'required'  => __( 'Bạn phải nhập các hướng nghiên cứu mũi nhọn', 'rwmb' ),
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
function EDUBOX_RESEARCH_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $research_meta_boxes;
	foreach ( $research_meta_boxes as $research_meta_box )
	{
		new RW_Meta_Box( $research_meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'EDUBOX_RESEARCH_register_meta_boxes' );