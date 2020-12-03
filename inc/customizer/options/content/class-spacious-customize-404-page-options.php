<?php
/**
 * Class to include Blog Single Page customize options.
 *
 * Class jSpacious_Customize_404_Page_Options
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
 * Class to include Page customize options.
 *
 * Class Spacious_Customize_404_Page_Options
 */
class Spacious_Customize_404_Page_Options extends Spacious_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array $options Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize ) {

		$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

		$configs = array(

			// Menu Color heading.
			array(
				'name'     => 'spacious[404_page_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( '404 Page Text', 'spacious' ),
				'section'  => 'spacious_404page_options_section',
				'priority' => 10,
			),

			array(
				'name'      => 'spacious[spacious_404page_options_setting]',
				'default'   => '',
				'type'      => 'control',
				'control'   => 'textarea',
				'label'     => esc_html__( 'Add the text you want to display in 404 Page.', 'spacious' ),
				'section'   => 'spacious_404page_options_section',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector'        => '.page-content p',
					'render_callback' => array(
						'Spacious_Customizer_Partials',
						'spacious_404page_options_setting',
					),
				),
				'priority'  => 25,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_404_Page_Options();
