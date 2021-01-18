<?php

/**
 * Class to include Color Footer customize options.
 *
 * Class Spacious_Customize_Color_Footer_Options
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 1.9.0
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
				'name'     => 'footer_widget_column_heading',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Footer Widgets Column', 'spacious' ),
				'section'  => 'spacious_footer_widgets_area_section',
				'priority' => 10,
			),

			array(
				'name'      => 'spacious_footer_widget_column_select_type',
				'default'   => 'four',
				'type'      => 'control',
				'control'   => 'spacious-radio-image',
				'label'     => esc_html__( 'Choose the number of column for the footer widgetized areas.', 'spacious' ),
				'section'   => 'spacious_footer_widgets_area_section',
				'choices'   => array(
					'one'   => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-full-column.png',
					),
					'two'   => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-two-column.png',
					),
					'three' => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-third-column.png',
					),
					'four'  => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-fourth-column.png',
					),
				),
				'image_col' => 3,
				'priority'  => 15,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Footer_widgets_Area_Options();

