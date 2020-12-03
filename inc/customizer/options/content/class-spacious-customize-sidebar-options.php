<?php
/**
 * Class to include Blog General customize options.
 *
 * Class Spacious_Customize_Sidebar_Options
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
 * Class to include sidebar customize options.
 *
 * Class Spacious_Customize_Sidebar_Options
 */
class Spacious_Customize_Sidebar_Options extends Spacious_Customize_Base_Option {

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
				'name'     => 'spacious_sticky_sidebar_heading',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Sticky Content And Sidebar', 'spacious' ),
				'section'  => 'spacious_sidebar_section',
				'priority' => 10,
			),

			// Sticky sidebar and content area enable/disable option.
			array(
				'name'     => 'spacious[spacious_sticky_content_sidebar]',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to activate the sticky options for content and sidebar areas.', 'spacious' ),
				'section'  => 'spacious_sidebar_section',
				'priority' => 20,
			),

			/**
			 * Colors
			 */
			array(
				'name'     => 'spacious[sticky_content_sidebar_color_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Colors', 'spacious' ),
				'section'  => 'spacious_sidebar_section',
				'priority' => 30,
			),

			// Sidebar widget title color option.
			array(
				'name'     => 'spacious[spacious_widget_title_color]',
				'default'  => '#222222',
				'type'     => 'control',
				'control'  => 'spacious-color',
				'label'    => esc_html__( 'Widget title color. Default is #222222.', 'spacious' ),
				'section'  => 'spacious_sidebar_section',
				'priority' => 40,
			),

			array(
				'name'     => 'spacious[sticky_content_sidebar_typography_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Typography', 'spacious' ),
				'section'  => 'spacious_sidebar_section',
				'priority' => 105,
			),

			// widget typography group.
			array(
				'name'     => 'spacious_widget_title_font_size_group',
				'label'    => esc_html__( 'Widget title font size. Default is 22px.', 'spacious' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_sidebar_section',
				'priority' => 110,
			),

			array(
				'name'        => 'spacious[spacious_widget_title_font_size_typography]',
				'default'     => array(
					'font-size'   => array(
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
							'max'  => 40,
						),
					),
					'tablet'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 18,
							'max'  => 40,
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
				'parent'      => 'spacious_widget_title_font_size_group',
				'section'     => 'spacious_sidebar_section',
				'priority'    => 120,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Sidebar_Options();
