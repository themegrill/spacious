<?php
/**
 * Class to include Header button customize options.
 *
 * Class Spacious_Customize_Toggable_Header_option
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
 * Class Spacious_Customize_Toggable_Header_option
 */
class Spacious_Customize_Toggable_Header_option extends Spacious_Customize_Base_Option {

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
				'name'     => 'spacious[spacious_togglable_header_sidebar_setting]',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Enable Togglable Header Sidebar', 'spacious' ),
				'section'  => 'spacious_togglable_header_sidebar',
				'priority' => 20,
			),

			// Default layout for pages only option.
			array(
				'name'      => 'spacious[spacious_togglable_header_sidebar_column]',
				'default'   => 'three-style-2',
				'type'      => 'control',
				'control'   => 'spacious-radio-image',
				'label'     => esc_html__( 'Choose the number of column for the header widgetized areas.', 'spacious' ),
				'section'   => 'spacious_togglable_header_sidebar',
				'choices'   => array(
					'one'           => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-full-column.png',
					),
					'two'           => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-two-column.png',
					),
					'three'         => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-three-column.png',
					),
					'four'          => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-fourth-column.png',
					),
					'two-style-1'   => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-two-style1.png',
					),
					'two-style-2'   => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-two-style2.png',
					),
					'three-style-1' => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-three-style1.png',
					),
					'three-style-2' => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-three-style2.png',
					),
					'three-style-3' => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '//sidebar-layout-three-style3.png',
					),
					'four-style-1'  => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-four-style1.png',
					),
					'four-style-2'  => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-four-style2.png',
					),
					'four-style-3'  => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-four-style3.png',
					),
					'four-style-4'  => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-four-style4.png',
					),
				),
				'image_col' => 3,
				'dependency' => array(
					'spacious[spacious_togglable_header_sidebar_setting]',
					'!=',
					0,
				),
				'priority'  => 410,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Toggable_Header_option();
