<?php
/**
 * Class to include Blog Single Page customize options.
 *
 * Class jSpacious_Customize_Footer_General_Options
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
 * Class Spacious_Customize_Footer_General_Options
 */
class Spacious_Customize_Footer_General_Options extends Spacious_Customize_Base_Option {

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

			array(
				'name'     => 'spacious[general_footer_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Footer Border Option', 'spacious' ),
				'section'  => 'spacious_general_section',
				'priority' => 10,
			),

			array(
				'name'     => 'spacious[spacious_footer_border_color_setting]',
				'default'  => '#EAEAEA',
				'type'     => 'control',
				'control'  => 'spacious-color',
				'label'    => esc_html__( 'Border Color', 'spacious' ),
				'section'  => 'spacious_general_section',
				'priority' => 20,
			),

			array(
				'name'     => 'spacious[spacious_footer_border_width_setting]',
				'default'  => '1',
				'type'     => 'control',
				'control'  => 'select',
				'label'    => esc_html__( 'Border Width', 'spacious' ),
				'section'  => 'spacious_general_section',
				'choices'  => array(
					'1' => esc_html__( '1px', 'spacious' ),
					'2' => esc_html__( '2px', 'spacious' ),
					'3' => esc_html__( '3px', 'spacious' ),
					'4' => esc_html__( '4px', 'spacious' ),
					'5' => esc_html__( '5px', 'spacious' ),
				),
				'priority' => 30,
			),

			array(
				'name'     => 'spacious[background_image_footer_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Background Image', 'spacious' ),
				'section'  => 'spacious_general_section',
				'priority' => 40,
			),

			array(
				'name'     => 'spacious[spacious_footer_background_options]',
				'default'  => array(
					'background'            => '#333333',
					'background-image'      => '',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-repeat'     => 'repeat',
				),
				'type'     => 'control',
				'control'  => 'spacious-background',
				'section'  => 'spacious_general_section',
				'priority' => 50,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Footer_General_Options();
