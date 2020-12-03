<?php
/**
 * Class to include Header General customize options.
 *
 * Class Spacious_Customize_Primary_Header_Options
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
 * Class to include Header General customize options.
 *
 * Class Spacious_Customize_Primary_Header_Options
 */
class Spacious_Customize_Primary_Header_Options extends Spacious_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options      Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize ) {

		$configs = array(

			array(
				'name'     => 'spacious[header_primary_menu_display_type]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Header Display Type', 'spacious' ),
				'section'  => 'spacious_header_main',
				'priority' => 5,
			),

			// Main total header area display type option.
			array(
				'name'     => 'spacious[spacious_header_display_type]',
				'default'  => 'one',
				'type'     => 'control',
				'control'  => 'spacious-radio-image',
				'label'    => esc_html__( 'Choose the header display type that you want.', 'spacious' ),
				'section'  => 'spacious_header_main',
				'choices'  => array(
					'one'   => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/header-left.png',
					),
					'two'   => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/header-right.png',
					),
					'three' => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/header-center.png',
					),
					'four'  => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/menu-bottom.png',
					),
				),
				'image_col' => 2,
				'priority' => 10,
			),

			array(
				'name'     => 'spacious[header_border_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Header Border', 'spacious' ),
				'section'  => 'spacious_header_main',
				'priority' => 15,
			),

			/**
			 * Colors.
			 */
			array(
				'name'     => 'spacious[spacious_header_border_color_setting]',
				'default'  => '#eaeaea',
				'type'     => 'control',
				'control'  => 'spacious-color',
				'label'    => esc_html__( 'Border Color', 'spacious' ),
				'section'  => 'spacious_header_main',
				'priority' => 20,
			),

			// Border Width.
			array(
				'name'     => 'spacious[spacious_header_border_width_setting]',
				'default'  => '1',
				'type'     => 'control',
				'control'  => 'select',
				'label'    => esc_html__( 'Border Width', 'colormag' ),
				'section'  => 'spacious_header_main',
				'choices'  => array(
					'1' => esc_html__( '1px', 'spacious' ),
					'2' => esc_html__( '2px', 'spacious' ),
					'3' => esc_html__( '3px', 'spacious' ),
					'4' => esc_html__( '4px', 'spacious' ),
					'5' => esc_html__( '5px', 'spacious' ),
				),
				'priority' => 25,
			),

			array(
				'name'     => 'spacious[header_background_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Colors', 'spacious' ),
				'section'  => 'spacious_header_main',
				'priority' => 30,
			),

			array(
				'name'     => 'spacious[spacious_header_background_color]',
				'default'  => '#FFFFFF',
				'type'     => 'control',
				'control'  => 'spacious-color',
				'label'    => esc_html__( 'Header background color. Default is #FFFFFF.', 'spacious' ),
				'section'  => 'spacious_header_main',
				'priority' => 40,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Primary_Header_Options();
