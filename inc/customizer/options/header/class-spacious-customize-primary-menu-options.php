<?php
/**
 * Class to include Header Primary Menu customize options.
 *
 * Class Spacious_Customize_Primary_Menu_Options
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
				'name'     => 'spacious[header_primary_menu_search]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Search Icon', 'spacious' ),
				'section'  => 'spacious_header_primary_menu',
				'priority' => 10,
			),

			// Search Icon option.
			array(
				'name'      => 'spacious[spacious_header_search_icon]',
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

			array(
				'name'       => 'spacious[spacious_header_search_layout]',
				'default'    => 'default',
				'type'       => 'control',
				'control'    => 'spacious-radio-image',
				'label'      => esc_html__( 'Select the search layout', 'spacious' ),
				'section'    => 'spacious_header_primary_menu',
				'choices'    => array(
					'default'   => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/search-icon-style-1.png',
					),
					'style_one' => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/search-icon-style-2.png',
					),
				),
				'image_col'  => 2,
				'priority'   => 30,
				'dependency' => array(
					'spacious[spacious_header_search_icon]',
					'!=',
					0,
				),
			),

			// Menu Display option.
			array(
				'name'     => 'spacious[header_primary_menu_display]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Menu Display', 'spacious' ),
				'section'  => 'spacious_header_primary_menu',
				'priority' => 40,
			),

			array(
				'name'     => 'spacious[spacious_one_line_menu_setting]',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Display menu in one line', 'spacious' ),
				'section'  => 'spacious_header_primary_menu',
				'priority' => 50,
			),

			// Responsive menu style heading.
			array(
				'name'     => 'spacious[header_primary_menu_responsive_style]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Responsive Menu Style', 'spacious' ),
				'section'  => 'spacious_header_primary_menu',
				'priority' => 60,
			),

			array(
				'name'     => 'spacious[spacious_new_menu]',
				'default'  => 1,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Switch to new responsive menu.', 'spacious' ),
				'section'  => 'spacious_header_primary_menu',
				'priority' => 70,
			),

			// Menu Color heading.
			array(
				'name'     => 'spacious[header_primary_menu_color]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Colors', 'spacious' ),
				'section'  => 'spacious_header_primary_menu',
				'priority' => 80,
			),

			// Primary menu text color.
			array(
				'name'     => 'spacious[spacious_primary_menu_text_color]',
				'default'  => '#444444',
				'type'     => 'control',
				'control'  => 'spacious-color',
				'label'    => esc_html__( 'Primary menu text color. Default is #444444.', 'spacious' ),
				'section'  => 'spacious_header_primary_menu',
				'priority' => 90,
			),

			// Primary sub menu text color.
			array(
				'name'     => 'spacious[spacious_primary_sub_menu_text_color]',
				'default'  => '#666666',
				'type'     => 'control',
				'control'  => 'spacious-color',
				'label'    => esc_html__( 'Primary sub menu text color. Default is #666666.', 'spacious' ),
				'section'  => 'spacious_header_primary_menu',
				'priority' => 100,
			),

			array(
				'name'     => 'spacious[header_primary_menu_typography]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Typography', 'spacious' ),
				'section'  => 'spacious_header_primary_menu',
				'priority' => 105,
			),

			// Primary menu typography group.
			array(
				'name'     => 'spacious_menu_typography_group',
				'label'    => esc_html__( 'Primary menu', 'spacious' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_header_primary_menu',
				'priority' => 110,
			),

			array(
				'name'        => 'spacious[spacious_primary_menu_font_typography]',
				'default'     => array(
					'font-family' => 'Lato',
					'font-size'   => array(
						'desktop' => '16',
						'tablet'  => '',
						'mobile'  => '',
					),
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 20,
						),
					),
					'tablet'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 20,
						),
					),
					'mobile'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 20,
						),
					),
				),
				'type'        => 'sub-control',
				'control'     => 'spacious-typography',
				'parent'      => 'spacious_menu_typography_group',
				'section'     => 'spacious_header_primary_menu',
				'priority'    => 120,
			),

			// spacious submenu font size.
			array(
				'name'     => 'spacious[spacious_submenu_size_heading]',
				'label'    => esc_html__( 'Primary sub menu. Default is 13px.', 'spacious' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_header_primary_menu',
				'priority' => 125,
			),

			array(
				'name'        => 'spacious[spacious_primary_sub_menu_font_size_typography]',
				'default'     => array(
					'font-size' => array(
						'desktop' => '13',
						'tablet'  => '',
						'mobile'  => '',
					),
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 18,
						),
					),
					'tablet'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 18,
						),
					),
					'mobile'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 18,
						),
					),
				),
				'type'        => 'sub-control',
				'control'     => 'spacious-typography',
				'parent'      => 'spacious[spacious_submenu_size_heading]',
				'section'     => 'spacious_header_primary_menu',
				'priority'    => 130,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Primary_Menu_Options();
