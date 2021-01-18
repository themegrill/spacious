<?php
/**
 * Class to include Header button customize options.
 *
 * Class Spacious_Customize_Page_Header_options
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
 * Class to include Header button customize options.
 *
 * Class Spacious_Customize_Page_Header_options
 */
class Spacious_Customize_Page_Header_options extends Spacious_Customize_Base_Option {

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

			array(
				'name'    => 'header_title_heading',
				'type'    => 'control',
				'control' => 'spacious-title',
				'label'   => esc_html__( 'Header Title', 'spacious' ),
				'section' => 'spacious_post_page_content_options',
			),

			array(
				'name'    => 'spacious_header_title_hide',
				'default' => 0,
				'type'    => 'control',
				'control' => 'checkbox',
				'label'   => esc_html__( 'Hide page/post header title', 'spacious' ),
				'section' => 'spacious_post_page_content_options',
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Page_Header_options();
