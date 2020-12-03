<?php
/**
 * Class to include Header Top Bar customize options.
 *
 * Class Spacious_Customize_Header_Top_Bar_Options
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
 * Class to include Header Top Bar customize options.
 *
 * Class Spacious_Customize_Header_Top_Bar_Options
 */
class Spacious_Customize_Header_Top_Bar_Options extends Spacious_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array $options Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize ) {

		// Customize transport postMessage variable to set `postMessage` or `refresh` as required.
		$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

		$configs = array(

			/**
			 * Tob bar Activation.
			 */
			array(
				'name'     => 'spacious[header_top_bar_active_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Activate Header Top Bar', 'spacious' ),
				'section'  => 'spacious_header_top_bar',
				'priority' => 10,
			),

			array(
				'name'     => 'spacious[spacious_activate_top_header_bar]',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to show top header bar. The top header bar includes social icons area, small text area and menu area.', 'spacious' ),
				'section'  => 'spacious_header_top_bar',
				'priority' => 15,
			),

			// Header Info text option.
			array(
				'name'       => 'spacious[header_info_text_heading]',
				'type'       => 'control',
				'control'    => 'spacious-title',
				'label'      => esc_html__( 'Header Info Text', 'spacious' ),
				'section'    => 'spacious_header_top_bar',
				'priority'   => 20,
				'dependency' => array(
					'spacious[spacious_activate_top_header_bar]',
					'!=',
					0,
				),
			),

			array(
				'name'       => 'spacious[spacious_header_info_text]',
				'default'    => '',
				'type'       => 'control',
				'control'    => 'textarea',
				'label'      => esc_html__( 'You can add phone numbers, other contact info here as you like. This box also accepts shortcodes.', 'spacious' ),
				'section'    => 'spacious_header_top_bar',
				'transport'  => $customizer_selective_refresh,
				'partial'    => array(
					'selector'        => '.small-info-text p',
					'render_callback' => array(
						'Spacious_Customizer_Partials',
						'spacious_header_info_text',
					),
				),
				'dependency' => array(
					'spacious[spacious_activate_top_header_bar]',
					'!=',
					0,
				),
				'priority'   => 25,
			),

			// Header display type option.
			array(
				'name'       => 'spacious[header_top_bar_display_type]',
				'type'       => 'control',
				'control'    => 'spacious-title',
				'label'      => esc_html__( 'Header Top Bar Display Type', 'spacious' ),
				'section'    => 'spacious_header_top_bar',
				'priority'   => 30,
				'dependency' => array(
					'spacious[spacious_activate_top_header_bar]',
					'!=',
					0,
				),
			),

			array(
				'name'       => 'spacious[spacious_top_bar_display_type]',
				'default'    => 'one',
				'type'       => 'control',
				'control'    => 'radio',
				'label'      => esc_html__( 'Choose top bar display type.', 'spacious' ),
				'section'    => 'spacious_header_top_bar',
				'choices'    => array(
					'one' => esc_html__( 'Type 1 (Default): Social icons & small text area on left, menu area on right', 'spacious' ),
					'two' => esc_html__( 'Type 2: Social icons & small text area on right, menu area on left', 'spacious' ),
				),
				'priority'   => 35,
				'dependency' => array(
					'spacious[spacious_activate_top_header_bar]',
					'!=',
					0,
				),
			),

			// Color Option.
			array(
				'name'       => 'spacious[header_top_color_heading]',
				'type'       => 'control',
				'control'    => 'spacious-title',
				'label'      => esc_html__( 'Colors', 'spacious' ),
				'section'    => 'spacious_header_top_bar',
				'priority'   => 40,
				'dependency' => array(
					'spacious[spacious_activate_top_header_bar]',
					'!=',
					0,
				),
			),

			// Header top background color.
			array(
				'name'       => 'spacious[spacious_header_top_bar_background_color]',
				'default'    => '#F8F8F8',
				'type'       => 'control',
				'control'    => 'spacious-color',
				'label'      => esc_html__( 'Header top bar background color. Default is #F8F8F8.', 'spacious' ),
				'section'    => 'spacious_header_top_bar',
				'dependency' => array(
					'spacious[spacious_activate_top_header_bar]',
					'!=',
					0,
				),
				'priority'   => 50,
			),

			// Header info text color.
			array(
				'name'       => 'spacious[spacious_header_info_text_color]',
				'default'    => '#555555',
				'type'       => 'control',
				'control'    => 'spacious-color',
				'label'      => esc_html__( 'Header top bar info text color. Default is #555555.', 'spacious' ),
				'section'    => 'spacious_header_top_bar',
				'dependency' => array(
					'spacious[spacious_activate_top_header_bar]',
					'!=',
					0,
				),
				'priority'   => 60,
			),

			// Header small menu text color.
			array(
				'name'       => 'spacious[spacious_header_small_menu_text_color]',
				'default'    => '#666666',
				'type'       => 'control',
				'control'    => 'spacious-color',
				'label'      => esc_html__( 'Header small menu text color. Default is #666666.', 'spacious' ),
				'section'    => 'spacious_header_top_bar',
				'dependency' => array(
					'spacious[spacious_activate_top_header_bar]',
					'!=',
					0,
				),
				'priority'   => 70,
			),

			// Header typography heading.
			array(
				'name'       => 'spacious[header_top_typography_heading]',
				'type'       => 'control',
				'control'    => 'spacious-title',
				'label'      => esc_html__( 'Typography', 'spacious' ),
				'section'    => 'spacious_header_top_bar',
				'priority'   => 80,
				'dependency' => array(
					'spacious[spacious_activate_top_header_bar]',
					'!=',
					0,
				),
			),

			// spacious small header info text font size.
			array(
				'name'     => 'spacious[spacious_small_info_text_size_heading]',
				'label'    => esc_html__( 'Header top bar small info text. Default is 12px.', 'spacious' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_header_top_bar',
				'dependency' => array(
					'spacious[spacious_activate_top_header_bar]',
					'!=',
					0,
				),
				'priority' => 515,
			),

			array(
				'name'        => 'spacious[spacious_small_info_text_size_typography]',
				'default'     => array(
					'font-size' => array(
						'desktop' => '12',
						'tablet'  => '',
						'mobile'  => '',
					),
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 16,
						),
					),
					'tablet'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 30,
						),
					),
					'mobile'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 30,
						),
					),
				),
				'type'        => 'sub-control',
				'control'     => 'spacious-typography',
				'parent'      => 'spacious[spacious_small_info_text_size_heading]',
				'section'     => 'spacious_header_top_bar',
				'dependency' => array(
					'spacious[spacious_activate_top_header_bar]',
					'!=',
					0,
				),
				'priority'    => 515,
			),

			// spacious small header menu font size.
			array(
				'name'     => 'spacious[spacious_small_menu_size_heading]',
				'label'    => esc_html__( 'Header small menu. Default is 12px.', 'spacious' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_header_top_bar',
				'dependency' => array(
					'spacious[spacious_activate_top_header_bar]',
					'!=',
					0,
				),
				'priority' => 515,
			),

			array(
				'name'        => 'spacious[spacious_small_header_menu_font_size_typography]',
				'default'     => array(
					'font-size' => array(
						'desktop' => '12',
						'tablet'  => '',
						'mobile'  => '',
					),
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 16,
						),
					),
					'tablet'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 16,
						),
					),
					'mobile'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 16,
						),
					),
				),
				'type'        => 'sub-control',
				'control'     => 'spacious-typography',
				'parent'      => 'spacious[spacious_small_menu_size_heading]',
				'section'     => 'spacious_header_top_bar',
				'dependency' => array(
					'spacious[spacious_activate_top_header_bar]',
					'!=',
					0,
				),
				'priority'    => 515,
			),


		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Header_Top_Bar_Options();
