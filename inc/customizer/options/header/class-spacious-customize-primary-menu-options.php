<?php
/**
 * Class to include Header Primary Menu customize options.
 *
 * Class Spacious_Customize_Primary_Menu_Options
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
 * Class to include Header Primary Menu customize options.
 *
 * Class Spacious_Customize_Primary_Menu_Options
 */
class Spacious_Customize_Primary_Menu_Options extends Spacious_Customize_Base_Option {

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
			 * Search icon options.
			 */
			array(
				'name'     => 'header_primary_menu_search',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Search Icon', 'spacious' ),
				'section'  => 'spacious_header_primary_menu',
				'priority' => 10,
			),

			// Search Icon option.
			array(
				'name'      => 'spacious_header_search_icon',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'     => esc_html__( 'Show search icon in header.', 'spacious' ),
				'section'   => 'spacious_header_primary_menu',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector' => '.home-icon',
				),
				'priority'  => 20,
			),

			// Menu Display option.
			array(
				'name'     => 'header_primary_menu_display',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Menu Display', 'spacious' ),
				'section'  => 'spacious_header_primary_menu',
				'priority' => 40,
			),

			array(
				'name'     => 'spacious_one_line_menu_setting',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Display menu in one line', 'spacious' ),
				'section'  => 'spacious_header_primary_menu',
				'priority' => 50,
			),

			// Responsive menu style heading.
			array(
				'name'     => 'header_primary_menu_responsive_style',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Responsive Menu Style', 'spacious' ),
				'section'  => 'spacious_header_primary_menu',
				'priority' => 60,
			),

			array(
				'name'     => 'spacious_new_menu',
				'default'  => 1,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Switch to new responsive menu.', 'spacious' ),
				'section'  => 'spacious_header_primary_menu',
				'priority' => 70,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Primary_Menu_Options();
