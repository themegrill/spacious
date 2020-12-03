<?php

/**
 * Class to include Color Footer customize options.
 *
 * Class Spacious_Customize_Color_Footer_Options
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to include Color Footer customize options.
 *
 * Class Spacious_Customize_Color_Footer_Options
 */
class Spacious_Customize_Footer_widgets_Area_Options extends Spacious_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array $options Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize ) {

		$configs = array(

			array(
				'name'     => 'spacious[footer_widget_column_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Footer Widgets Column', 'spacious' ),
				'section'  => 'spacious_footer_widgets_area_section',
				'priority' => 10,
			),

			array(
				'name'      => 'spacious[spacious_footer_widget_column_select_type]',
				'default'   => 'four',
				'type'      => 'control',
				'control'   => 'spacious-radio-image',
				'label'     => esc_html__( 'Choose the number of column for the footer widgetized areas.', 'spacious' ),
				'section'   => 'spacious_footer_widgets_area_section',
				'choices'   => array(
					'one'           => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-full-column.png',
					),
					'two'           => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-two-column.png',
					),
					'three'         => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-third-column.png',
					),
					'four'          => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-fourth-column.png',
					),
					'two-style-1'   => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-two-style1.png',
					),
					'two-style-2'   => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-two-style2.png',
					),
					'three-style-1' => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-three-style1.png',
					),
					'three-style-2' => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-three-style2.png',
					),
					'three-style-3' => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-three-style3.png',
					),
					'four-style-1'  => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-four-style1.png',
					),
					'four-style-2'  => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-four-style2.png',
					),
				),
				'image_col' => 3,
				'priority'  => 15,
			),

			/**
			 * Colors.
			 */
			array(
				'name'     => 'spacious[footer_widget_color_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Colors', 'spacious' ),
				'section'  => 'spacious_footer_widgets_area_section',
				'priority' => 20,
			),

			// Widget title color option.
			array(
				'name'     => 'spacious[spacious_footer_widget_title_color]',
				'default'  => '#D5D5D5',
				'type'     => 'control',
				'control'  => 'spacious-color',
				'label'    => esc_html__( 'Widget title color. Default is #D5D5D5.', 'spacious' ),
				'section'  => 'spacious_footer_widgets_area_section',
				'priority' => 25,
			),

			// Widget content color option.
			array(
				'name'     => 'spacious[spacious_footer_widget_content_color]',
				'default'  => '#999999',
				'type'     => 'control',
				'control'  => 'spacious-color',
				'label'    => esc_html__( 'Widget content color. Default is #999999.', 'spacious' ),
				'section'  => 'spacious_footer_widgets_area_section',
				'priority' => 30,
			),

//			array(
//				'name'     => 'spacious[spacious_footer_widget_background_color]',
//				'default'  => '#333333',
//				'type'     => 'control',
//				'control'  => 'spacious-color',
//				'label'    => esc_html__( 'Widget background color. Default is #333333.', 'spacious' ),
//				'section'  => 'spacious_footer_widgets_area_section',
//				'priority' => 40,
//			),

			array(
				'name'     => 'spacious[footer_widget_typography_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Typography', 'spacious' ),
				'section'  => 'spacious_footer_widgets_area_section',
				'priority' => 105,
			),

			// Footer widget typography group.
			array(
				'name'     => 'spacious_footer_widget_title_font_size_group',
				'label'    => esc_html__( 'Footer widget title font size. Default is 22px.', 'spacious' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_footer_widgets_area_section',
				'priority' => 110,
			),

			array(
				'name'        => 'spacious[spacious_footer_widget_title_font_size_typography]',
				'default'     => array(
					'font-size' => array(
						'desktop' => '22',
						'tablet'  => '',
						'mobile'  => '',
					),
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 18,
							'max'  => 30,
						),
					),
					'tablet'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 20,
						),
					),
					'mobile'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 20,
						),
					),
				),
				'type'        => 'sub-control',
				'control'     => 'spacious-typography',
				'parent'      => 'spacious_footer_widget_title_font_size_group',
				'section'     => 'spacious_footer_widgets_area_section',
				'priority'    => 120,
			),

			// Footer content typography group.
			array(
				'name'     => 'spacious_footer_widget_content_font_size_group',
				'label'    => esc_html__( 'Footer widget content font size. Default is 14px.', 'spacious' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_footer_widgets_area_section',
				'priority' => 110,
			),

			array(
				'name'        => 'spacious[spacious_footer_widget_content_font_size_typography]',
				'default'     => array(
					'font-size' => array(
						'desktop' => '14',
						'tablet'  => '',
						'mobile'  => '',
					),
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 18,
						),
					),
					'tablet'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 18,
						),
					),
					'mobile'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 18,
						),
					),
				),
				'type'        => 'sub-control',
				'control'     => 'spacious-typography',
				'parent'      => 'spacious_footer_widget_content_font_size_group',
				'section'     => 'spacious_footer_widgets_area_section',
				'priority'    => 120,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Footer_widgets_Area_Options();

