<?php
if ( class_exists( 'THIM_Testimonials' ) ) {
	class Thim_Testimonials_Widget extends Thim_Widget {
		function __construct() {
			parent::__construct(
				'testimonials',
				esc_html__( 'Thim: Testimonials', 'eduma' ),
				array(
					'description'   => esc_html__( '', 'eduma' ),
					'help'          => '',
					'panels_groups' => array( 'thim_widget_group' ),
					'panels_icon'   => 'dashicons dashicons-welcome-learn-more'
				),
				array(),
				array(
					'title'            => array(
						'type'                  => 'text',
						'label'                 => esc_html__( 'Heading Text', 'eduma' ),
						'default'               => esc_html__( 'Testimonials', 'eduma' ),
						'allow_html_formatting' => true
					),
					'layout'           => array(
						'type'          => 'select',
						'label'         => esc_html__( 'Widget Layout', 'eduma' ),
						'options'       => array(
							'default'  => esc_html__( 'Default', 'eduma' ),
							'carousel' => esc_html__( 'Carousel Slider', 'eduma' ),
						),
						'default'       => 'default',
						'state_emitter' => array(
							'callback' => 'select',
							'args'     => array( 'layout_type' )
						),
					),
					'limit'            => array(
						'type'    => 'number',
						'label'   => esc_html__( 'Limit Posts', 'eduma' ),
						'default' => '7'
					),
					'item_visible'     => array(
						'type'    => 'number',
						'label'   => esc_html__( 'Item visible', 'eduma' ),
						'desc'    => esc_html__( 'Enter odd number', 'eduma' ),
						'default' => '5'
					),
					'autoplay'         => array(
						'type'          => 'checkbox',
						'label'         => esc_html__( 'Auto play', 'eduma' ),
						'default'       => false,
						'state_handler' => array(
							'layout_type[default]'  => array( 'show' ),
							'layout_type[carousel]' => array( 'hide' ),
						),
					),
					'mousewheel'       => array(
						'type'          => 'checkbox',
						'label'         => esc_html__( 'Mousewheel Scroll', 'eduma' ),
						'default'       => false,
						'state_handler' => array(
							'layout_type[default]'  => array( 'show' ),
							'layout_type[carousel]' => array( 'hide' ),
						),
					),
					'carousel-options' => array(
						'type'          => 'section',
						'label'         => esc_html__( 'Carousel Options', 'eduma' ),
						'hide'          => true,
						"class"         => "clear-both",
						'state_handler' => array(
							'layout_type[carousel]' => array( 'show' ),
							'layout_type[default]'  => array( 'hide' ),
						),
						'fields'        => array(
							'show_pagination' => array(
								'type'    => 'checkbox',
								'label'   => esc_html__( 'Show Pagination', 'eduma' ),
								'default' => false
							),
							'show_navigation' => array(
								'type'    => 'checkbox',
								'label'   => esc_html__( 'Show Navigation', 'eduma' ),
								'default' => true
							),
							'autoplay'       => array(
								'type'        => 'number',
								'label'       => esc_html__( 'Auto Play Speed (in ms)', 'eduma' ),
								'description' => esc_html__( 'Set 0 to disable auto play.', 'eduma' ),
								'default'     => '0'
							),
						),

					),

					'link_to_single'         => array(
						'type'          => 'checkbox',
						'label'         => esc_html__( 'Link To Single', 'eduma' ),
						'default'       => false,
						'description'   => esc_html__( 'Enable link to single testimonial', 'eduma' ),
					),

				),
				THIM_DIR . 'inc/widgets/testimonials/'
			);
		}

		/**
		 * Initialize the CTA widget
		 */


		function get_template_name( $instance ) {
			if ( isset( $instance['layout'] ) && $instance['layout'] == 'carousel' ) {
				return 'carousel';
			} else {
				return 'base';
			}
		}

		function get_style_name( $instance ) {
			return false;
		}

	}

	function thim_testimonials_register_widget() {
		register_widget( 'Thim_Testimonials_Widget' );
	}

	add_action( 'widgets_init', 'thim_testimonials_register_widget' );
}