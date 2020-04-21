<?php

$defaults = array(
	'layout'            => 'default',
	'limit'             => '7',
	'item_visible'      => '5',
	'autoplay'          => false,
	'mousewheel'        => false,
	'show_pagination'   => false,
	'show_navigation'   => true,
	'carousel_autoplay' => '0',
	'link_to_single'    => false,
);

vc_map( array(
	'name'        => esc_html__( 'Thim: Testimonial', 'eduma' ),
	'base'        => 'thim-testimonials',
	'category'    => esc_html__( 'Thim Shortcodes', 'eduma' ),
	'description' => esc_html__( 'Display testimonials.', 'eduma' ),
	'params'      => array(
		array(
			'type'        => 'textfield',
			'admin_label' => true,
			'heading'     => esc_html__( 'Title', 'eduma' ),
			'param_name'  => 'title',
			'value'       => '',
		),

		array(
			'type'        => 'dropdown',
			'admin_label' => true,
			'heading'     => esc_html__( 'Layout', 'eduma' ),
			'param_name'  => 'layout',
			'value'       => array(
				esc_html__( 'Select', 'eduma' )   => '',
				esc_html__( 'Default', 'eduma' )  => 'default',
				esc_html__( 'Carousel', 'eduma' ) => 'carousel',
			),
			'std'         => $defaults['layout'],
		),

		array(
			'type'        => 'number',
			'admin_label' => true,
			'heading'     => esc_html__( 'Limit Posts', 'eduma' ),
			'param_name'  => 'limit',
			'std'         => $defaults['limit'],
		),

		array(
			'type'        => 'number',
			'admin_label' => true,
			'heading'     => esc_html__( 'Items visible', 'eduma' ),
			'param_name'  => 'item_visible',
			'std'         => $defaults['item_visible'],
		),

		array(
			'type'        => 'checkbox',
			'admin_label' => true,
			'heading'     => esc_html__( 'Auto play', 'eduma' ),
			'param_name'  => 'autoplay',
			'std'         => $defaults['autoplay'],
			'dependency'  => array(
				'element' => 'layout',
				'value'   => 'default',
			),
		),

		array(
			'type'        => 'checkbox',
			'admin_label' => true,
			'heading'     => esc_html__( 'Mousewheel Scroll', 'eduma' ),
			'param_name'  => 'mousewheel',
			'std'         => $defaults['mousewheel'],
			'dependency'  => array(
				'element' => 'layout',
				'value'   => 'default',
			),
		),

		array(
			'type'        => 'checkbox',
			'admin_label' => true,
			'heading'     => esc_html__( 'Show Pagination', 'eduma' ),
			'param_name'  => 'show_pagination',
			'std'         => $defaults['show_pagination'],
			'dependency'  => array(
				'element' => 'layout',
				'value'   => 'carousel',
			),
		),

		array(
			'type'        => 'checkbox',
			'admin_label' => true,
			'heading'     => esc_html__( 'Show Navigation', 'eduma' ),
			'param_name'  => 'show_navigation',
			'std'         => $defaults['show_navigation'],
			'dependency'  => array(
				'element' => 'layout',
				'value'   => 'carousel',
			),
		),

		array(
			'type'        => 'textfield',
			'admin_label' => true,
			'heading'     => esc_html__( 'Auto Play Speed (in ms)', 'eduma' ),
			'param_name'  => 'carousel_autoplay',
			'description' => esc_html__( 'Set 0 to disable auto play.', 'eduma' ),
			'std'         => $defaults['carousel_autoplay'],
			'dependency'  => array(
				'element' => 'layout',
				'value'   => 'carousel',
			),
		),

		array(
			'type'        => 'checkbox',
			'admin_label' => true,
			'heading'     => esc_html__( 'Link To Single', 'eduma' ),
			'param_name'  => 'link_to_single',
			'std'         => $defaults['link_to_single'],
		),
	)
) );