<?php

vc_map( array(
	'name'        => esc_html__( 'Thim: Courses Collection', 'eduma' ),
	'base'        => 'thim-courses-collection',
	'category'    => esc_html__( 'Thim Shortcodes', 'eduma' ),
	'description' => esc_html__( 'Display list courses collection', 'eduma' ),
	'params'      => array(

		array(
			'type'        => 'textfield',
			'admin_label' => true,
			'heading'     => esc_html__( 'Title', 'eduma' ),
			'param_name'  => 'title',
		),

		array(
			'type'        => 'number',
			'admin_label' => true,
			'heading'     => esc_html__( 'Limit collections', 'eduma' ),
			'param_name'  => 'limit',
			'std'         => '8',
		),


		array(
			'type'        => 'dropdown',
			'admin_label' => true,
			'heading'     => esc_html__( 'Columns', 'eduma' ),
			'param_name'  => 'columns',
			'value'       => array(
				esc_html__( 'Select', 'eduma' ) => '',
				esc_html__( '1', 'eduma' )      => '1',
				esc_html__( '2', 'eduma' )      => '2',
				esc_html__( '3', 'eduma' )      => '3',
				esc_html__( '4', 'eduma' )      => '4',
			),
		),

		array(
			'type'        => 'dropdown',
			'admin_label' => true,
			'heading'     => esc_html__( 'Feature Items', 'eduma' ),
			'param_name'  => 'feature_items',
			'value'       => array(
				esc_html__( 'Select', 'eduma' ) => '',
				esc_html__( '1', 'eduma' )      => '1',
				esc_html__( '2', 'eduma' )      => '2',
				esc_html__( '3', 'eduma' )      => '3',
				esc_html__( '4', 'eduma' )      => '4',
			),
		),

	)
) );
