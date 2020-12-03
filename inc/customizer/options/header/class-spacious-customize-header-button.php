<?php
/**
 * Class to include Header button customize options.
 *
 * Class Spacious_Customize_Header_Button_Options
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
 * Class to include Header button customize options.
 *
 * Class Spacious_Customize_Header_Button_Options
 */
class Spacious_Customize_Header_Button_Options extends Spacious_Customize_Base_Option {

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

			// Header button one option.
			array(
				'name'     => 'spacious[spacious_header_button_one_setting]',
				'default'  => '',
				'type'     => 'control',
				'control'  => 'text',
				'label'    => esc_html__( 'Button Text', 'spacious' ),
				'section'  => 'spacious_header_button_one',
				'priority' => 15,
			),

			// Header button one option.
			array(
				'name'     => 'spacious[spacious_header_button_one_link]',
				'default'  => '',
				'type'     => 'control',
				'control'  => 'url',
				'label'    => esc_html__( 'Button Link', 'spacious' ),
				'section'  => 'spacious_header_button_one',
				'priority' => 15,
			),

			array(
				'name'     => 'spacious[spacious_header_button_one_tab]',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to show in new tab', 'spacious' ),
				'section'  => 'spacious_header_button_one',
				'priority' => 20,
			),

			array(
				'name'     => 'spacious_header_button_group',
				'label'    => esc_html__( 'Text Color', 'spacious' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_header_button_one',
				'priority' => 410,
			),

			array(
				'name'     => 'spacious[spacious_header_button_one_text_color]',
				'label'    => esc_html__( 'Color', 'spacious' ),
				'default'  => '#ffffff',
				'type'     => 'sub-control',
				'control'  => 'spacious-color',
				'parent'   => 'spacious_header_button_group',
				'tab'      => esc_html__( 'Normal', 'spacious' ),
				'section'  => 'spacious_header_button_one',
				'priority' => 410,
			),

			array(
				'name'     => 'spacious[spacious_header_button_one_text_hover_color]',
				'label'    => esc_html__( 'Color', 'spacious' ),
				'default'  => '#ffffff',
				'type'     => 'sub-control',
				'control'  => 'spacious-color',
				'parent'   => 'spacious_header_button_group',
				'tab'      => esc_html__( 'Hover', 'spacious' ),
				'section'  => 'spacious_header_button_one',
				'priority' => 410,
			),

			// Background Color Option.
			array(
				'name'     => 'spacious_header_button_background_group',
				'label'    => esc_html__( 'Background Color', 'spacious' ),
				'default'  => '0fbe7c',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_header_button_one',
				'priority' => 410,
			),

			array(
				'name'     => 'spacious[spacious_header_button_one_background_color]',
				'label'    => esc_html__( 'Color', 'spacious' ),
				'default'  => '#0fbe7c',
				'type'     => 'sub-control',
				'control'  => 'spacious-color',
				'parent'   => 'spacious_header_button_background_group',
				'tab'      => esc_html__( 'Normal', 'spacious' ),
				'section'  => 'spacious_header_button_one',
				'priority' => 410,
			),

			array(
				'name'     => 'spacious[spacious_header_button_one_background_hover_color]',
				'label'    => esc_html__( 'Color', 'spacious' ),
				'default'  => '#0fbe7c',
				'type'     => 'sub-control',
				'control'  => 'spacious-color',
				'parent'   => 'spacious_header_button_background_group',
				'tab'      => esc_html__( 'Hover', 'spacious' ),
				'section'  => 'spacious_header_button_one',
				'priority' => 410,
			),

			// Border Color Option.
			array(
				'name'     => 'spacious_header_button_border_group',
				'label'    => esc_html__( 'Border Color', 'spacious' ),
				'default'  => '0fbe7c',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_header_button_one',
				'priority' => 410,
			),

			array(
				'name'     => 'spacious[spacious_header_button_one_border_color]',
				'label'    => esc_html__( 'Color', 'spacious' ),
				'default'  => '#0fbe7c',
				'type'     => 'sub-control',
				'control'  => 'spacious-color',
				'parent'   => 'spacious_header_button_border_group',
				'tab'      => esc_html__( 'Normal', 'spacious' ),
				'section'  => 'spacious_header_button_one',
				'priority' => 410,
			),

			array(
				'name'     => 'spacious[spacious_header_button_one_border_hover_color]',
				'label'    => esc_html__( 'Color', 'spacious' ),
				'default'  => '#0fbe7c',
				'type'     => 'sub-control',
				'control'  => 'spacious-color',
				'parent'   => 'spacious_header_button_border_group',
				'tab'      => esc_html__( 'Hover', 'spacious' ),
				'section'  => 'spacious_header_button_one',
				'priority' => 410,
			),

			// Border width option.
			array(
				'name'     => 'spacious[spacious_header_button_one_border_width]',
				'default'  => '2',
				'type'     => 'control',
				'control'  => 'select',
				'label'    => esc_html__( 'Border Width', 'spacious' ),
				'section'  => 'spacious_header_button_one',
				'choices'  => array(
					'1' => esc_html__( '1px', 'spacious' ),
					'2' => esc_html__( '2px', 'spacious' ),
					'3' => esc_html__( '3px', 'spacious' ),
					'4' => esc_html__( '4px', 'spacious' ),
					'5' => esc_html__( '5px', 'spacious' ),
				),
				'priority' => 410,
			),

			array(
				'name'     => 'spacious[spacious_header_button_one_border_radius]',
				'default'  => '5px',
				'type'     => 'control',
				'control'  => 'text',
				'label'    => esc_html__( 'Border Radius', 'spacious' ),
				'section'  => 'spacious_header_button_one',
				'priority' => 420,
			),

			// Header button two option.
			array(
				'name'     => 'spacious[spacious_header_button_two_setting]',
				'default'  => '',
				'type'     => 'control',
				'control'  => 'text',
				'label'    => esc_html__( 'Button Text', 'spacious' ),
				'section'  => 'spacious_header_button_two',
				'priority' => 15,
			),

			array(
				'name'     => 'spacious[spacious_header_button_two_link]',
				'default'  => '',
				'type'     => 'control',
				'control'  => 'url',
				'label'    => esc_html__( 'Button Link', 'spacious' ),
				'section'  => 'spacious_header_button_two',
				'priority' => 15,
			),

			array(
				'name'     => 'spacious[spacious_header_button_two_tab]',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to show in new tab', 'spacious' ),
				'section'  => 'spacious_header_button_two',
				'priority' => 20,
			),

			array(
				'name'     => 'spacious_header_button_two_group',
				'label'    => esc_html__( 'Text Color', 'spacious' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_header_button_two',
				'priority' => 410,
			),

			array(
				'name'     => 'spacious[spacious_header_button_two_text_color]',
				'label'    => esc_html__( 'Color', 'spacious' ),
				'default'  => '#444444',
				'type'     => 'sub-control',
				'control'  => 'spacious-color',
				'parent'   => 'spacious_header_button_two_group',
				'tab'      => esc_html__( 'Normal', 'spacious' ),
				'section'  => 'spacious_header_button_two',
				'priority' => 410,
			),

			array(
				'name'     => 'spacious[spacious_header_button_two_text_hover_color]',
				'label'    => esc_html__( 'Color', 'spacious' ),
				'default'  => '#444444',
				'type'     => 'sub-control',
				'control'  => 'spacious-color',
				'parent'   => 'spacious_header_button_two_group',
				'tab'      => esc_html__( 'Hover', 'spacious' ),
				'section'  => 'spacious_header_button_two',
				'priority' => 410,
			),

			// Background Color Option.
			array(
				'name'     => 'spacious_header_button_two_background_group',
				'label'    => esc_html__( 'Background Color', 'spacious' ),
				'default'  => '0fbe7c',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_header_button_two',
				'priority' => 410,
			),

			array(
				'name'     => 'spacious[spacious_header_button_two_background_color]',
				'label'    => esc_html__( 'Color', 'spacious' ),
				'default'  => '#0fbe7c',
				'type'     => 'sub-control',
				'control'  => 'spacious-color',
				'parent'   => 'spacious_header_button_two_background_group',
				'tab'      => esc_html__( 'Normal', 'spacious' ),
				'section'  => 'spacious_header_button_two',
				'priority' => 410,
			),

			array(
				'name'     => 'spacious[spacious_header_button_two_background_hover_color]',
				'label'    => esc_html__( 'Color', 'spacious' ),
				'default'  => '#0fbe7c',
				'type'     => 'sub-control',
				'control'  => 'spacious-color',
				'parent'   => 'spacious_header_button_two_background_group',
				'tab'      => esc_html__( 'Hover', 'spacious' ),
				'section'  => 'spacious_header_button_two',
				'priority' => 410,
			),

			// Border Color Option.
			array(
				'name'     => 'spacious_header_button_two_border_group',
				'label'    => esc_html__( 'Border Color', 'spacious' ),
				'default'  => '0fbe7c',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_header_button_two',
				'priority' => 410,
			),

			array(
				'name'     => 'spacious[spacious_header_button_two_border_color]',
				'label'    => esc_html__( 'Color', 'spacious' ),
				'default'  => '#0fbe7c',
				'type'     => 'sub-control',
				'control'  => 'spacious-color',
				'parent'   => 'spacious_header_button_two_border_group',
				'tab'      => esc_html__( 'Normal', 'spacious' ),
				'section'  => 'spacious_header_button_two',
				'priority' => 410,
			),

			array(
				'name'     => 'spacious[spacious_header_button_two_border_hover_color]',
				'label'    => esc_html__( 'Color', 'spacious' ),
				'default'  => '#0fbe7c',
				'type'     => 'sub-control',
				'control'  => 'spacious-color',
				'parent'   => 'spacious_header_button_two_border_group',
				'tab'      => esc_html__( 'Hover', 'spacious' ),
				'section'  => 'spacious_header_button_two',
				'priority' => 410,
			),

			// Border width option.
			array(
				'name'     => 'spacious[spacious_header_button_two_border_width]',
				'default'  => '2',
				'type'     => 'control',
				'control'  => 'select',
				'label'    => esc_html__( 'Border Width', 'spacious' ),
				'section'  => 'spacious_header_button_two',
				'choices'  => array(
					'1' => esc_html__( '1px', 'spacious' ),
					'2' => esc_html__( '2px', 'spacious' ),
					'3' => esc_html__( '3px', 'spacious' ),
					'4' => esc_html__( '4px', 'spacious' ),
					'5' => esc_html__( '5px', 'spacious' ),
				),
				'priority' => 410,
			),

			array(
				'name'     => 'spacious[spacious_header_button_two_border_radius]',
				'default'  => '5px',
				'type'     => 'control',
				'control'  => 'text',
				'label'    => esc_html__( 'Border Radius', 'spacious' ),
				'section'  => 'spacious_header_button_two',
				'priority' => 420,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Header_Button_Options();
