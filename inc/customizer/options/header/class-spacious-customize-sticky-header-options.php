<?php
/**
 * Class to include Header Primary Menu customize options.
 *
 * Class Spacious_Customize_Sticky_Header_Options
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
 * Class to include Header Primary Menu customize options.
 *
 * Class Spacious_Customize_Sticky_Header_Options
 */
class Spacious_Customize_Sticky_Header_Options extends Spacious_Customize_Base_Option {

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
			 * Sticky Menu.
			 */
			// Primary sticky menu enable/disable option.
			array(
				'name'     => 'spacious[spacious_sticky_menu]',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to enable the sticky behavior of the primary menu', 'spacious' ),
				'section'  => 'spacious_sticky_menu_setting',
				'priority' => 10,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Sticky_Header_Options();
