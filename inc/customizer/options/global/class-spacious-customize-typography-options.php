<?php
/**
 * Class to include Typography General customize options.
 *
 * Class Spacious_Customize_Typography_options
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
 * Class to include Typography General customize options.
 *
 * Class Spacious_Customize_Typography_options
 */
class Spacious_Customize_Typography_options extends Spacious_Customize_Base_Option {

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

			/**
			 * Content.
			 */
			array(
				'name'     => 'spacious_body_font_heading',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Body', 'spacious' ),
				'section'  => 'spacious_base_typography_section',
				'priority' => 5,
			),

			array(
				'name'     => 'spacious_content_font_typography',
				'default'  => array(
					'font-family' => 'Lato',
				),
				'type'     => 'control',
				'control'  => 'spacious-typography',
				'section'  => 'spacious_base_typography_section',
				'priority' => 15,
			),

			/**
			 * Headings.
			 */
			array(
				'name'     => 'spacious_headings_typography_heading',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Headings', 'spacious' ),
				'section'  => 'spacious_headings_typography_section',
				'priority' => 5,
			),

			array(
				'name'     => 'spacious_titles_font_typography',
				'default'  => array(
					'font-family' => 'Lato',
				),
				'type'     => 'control',
				'control'  => 'spacious-typography',
				'section'  => 'spacious_headings_typography_section',
				'priority' => 15,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Typography_options();
