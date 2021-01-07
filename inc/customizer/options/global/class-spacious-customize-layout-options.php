<?php
/**
 * Class to include Layout customize options.
 *
 * Class Spacious_Customize_Layout_Options
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
 * Class to include Layout customize options.
 *
 * Class Spacious_Customize_Layout_Options
 */
class Spacious_Customize_Layout_Options extends Spacious_Customize_Base_Option {

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

			// Site layout option.
			array(
				'name'     => 'spacious_site_layout',
				'default'  => 'box_1218px',
				'type'     => 'control',
				'control'  => 'radio',
				'label'    => esc_html__( 'Choose your site layout. The change is reflected in whole site.', 'spacious' ),
				'section'  => 'spacious_site_layout_section',
				'choices'  => array(
					'box_1218px'  => esc_html__( 'Boxed layout with content width of 1218px', 'spacious' ),
					'box_978px'   => esc_html__( 'Boxed layout with content width of 978px', 'spacious' ),
					'wide_1218px' => esc_html__( 'Wide layout with content width of 1218px', 'spacious' ),
					'wide_978px'  => esc_html__( 'Wide layout with content width of 978px', 'spacious' ),
				),
				'priority' => 10,
			),

			// Default layout option.
			array(
				'name'      => 'spacious_default_layout',
				'default'   => 'right_sidebar',
				'type'      => 'control',
				'control'   => 'spacious-radio-image',
				'label'     => esc_html__( 'Default layout', 'spacious' ),
				'section'   => 'spacious_sidebar_layout_section',
				'choices'   => array(
					'right_sidebar'                => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
					),
					'left_sidebar'                 => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
					),
					'no_sidebar_full_width'        => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
					),
					'no_sidebar_content_centered'  => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
					),
					'no_sidebar_content_stretched' => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-stretched-layout.png',
					),
				),
				'image_col' => 3,
				'priority'  => 5,
			),

			// Default layout for pages only option.
			array(
				'name'      => 'spacious_pages_default_layout',
				'default'   => 'right_sidebar',
				'type'      => 'control',
				'control'   => 'spacious-radio-image',
				'label'     => esc_html__( 'Default layout for pages only', 'spacious' ),
				'section'   => 'spacious_sidebar_layout_section',
				'choices'   => array(
					'right_sidebar'                => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
					),
					'left_sidebar'                 => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
					),
					'no_sidebar_full_width'        => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
					),
					'no_sidebar_content_centered'  => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
					),
					'no_sidebar_content_stretched' => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-stretched-layout.png',
					),
				),
				'image_col' => 3,
				'priority'  => 10,
			),

			// Default layout for single posts page only option.
			array(
				'name'      => 'spacious_single_posts_default_layout',
				'default'   => 'right_sidebar',
				'type'      => 'control',
				'control'   => 'spacious-radio-image',
				'label'     => esc_html__( 'Default layout for single posts only', 'spacious' ),
				'section'   => 'spacious_sidebar_layout_section',
				'choices'   => array(
					'right_sidebar'                => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
					),
					'left_sidebar'                 => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
					),
					'no_sidebar_full_width'        => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
					),
					'no_sidebar_content_centered'  => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
					),
					'no_sidebar_content_stretched' => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-stretched-layout.png',
					),
				),
				'image_col' => 3,
				'priority'  => 15,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Layout_Options();
