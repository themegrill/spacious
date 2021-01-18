<?php
/**
 * Class to include Header Top Bar customize options.
 *
 * Class Spacious_Customize_Header_Top_Bar_Options
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
				'name'     => 'header_top_bar_active_heading',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Activate Header Top Bar', 'spacious' ),
				'section'  => 'spacious_header_top_bar',
				'priority' => 10,
			),

			array(
				'name'     => 'spacious_activate_top_header_bar',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to show top header bar. The top header bar includes social icons area, small text area and menu area.', 'spacious' ),
				'section'  => 'spacious_header_top_bar',
				'priority' => 15,
			),

			// Header Info text option.
			array(
				'name'       => 'header_info_text_heading',
				'type'       => 'control',
				'control'    => 'spacious-title',
				'label'      => esc_html__( 'Header Info Text', 'spacious' ),
				'section'    => 'spacious_header_top_bar',
				'priority'   => 20,
				'dependency' => array(
					'spacious_activate_top_header_bar',
					'!=',
					0,
				),
			),

			array(
				'name'       => 'spacious_header_info_text',
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
					'spacious_activate_top_header_bar',
					'!=',
					0,
				),
				'priority'   => 25,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Header_Top_Bar_Options();
