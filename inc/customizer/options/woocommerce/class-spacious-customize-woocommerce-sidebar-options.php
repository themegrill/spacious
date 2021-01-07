<?php
/**
 * Class to include Design WooCommerce customize options.
 *
 * Class Spacious_Customize_WooCommerce_Sidebar_Options
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
 * Bail out if `WooCommerce` plugin is not installed and activated.
 */
if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

/**
 * Class to include Design WooCommerce customize options.
 *
 * Class Spacious_Customize_WooCommerce_Sidebar_Options
 */
class Spacious_Customize_WooCommerce_Sidebar_Options extends Spacious_Customize_Base_Option {

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

			array(
				'name'     => 'woocommerce_sidebar_layout_heading',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Archive Page Layout', 'spacious' ),
				'section'  => 'spacious_woocommerce_page_layout_setting',
				'priority' => 10,
			),


			// WooCommerce shop page layout option.
			array(
				'name'      => 'spacious_woo_archive_layout',
				'default'   => 'no_sidebar_full_width',
				'type'      => 'control',
				'control'   => 'spacious-radio-image',
				'label'     => esc_html__( 'This layout will be reflected in woocommerce archive page only.', 'spacious' ),
				'section'   => 'spacious_woocommerce_page_layout_setting',
				'choices'   => array(
					'right_sidebar'               => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
					),
					'left_sidebar'                => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
					),
					'no_sidebar_full_width'       => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
					),
					'no_sidebar_content_centered' => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
					),
				),
				'image_col' => 3,
				'priority'  => 30,
			),

			array(
				'name'     => 'woocommerce_product_sidebar_layout_heading',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Product Page Layout', 'spacious' ),
				'section'  => 'spacious_woocommerce_page_layout_setting',
				'priority' => 40,
			),

			// WooCommerce archive page layout option.
			array(
				'name'      => 'spacious_woo_product_layout',
				'default'   => 'right_sidebar',
				'type'      => 'control',
				'control'   => 'spacious-radio-image',
				'label'     => esc_html__( 'This layout will be reflected in woocommerce Product page.', 'spacious' ),
				'section'   => 'spacious_woocommerce_page_layout_setting',
				'choices'   => array(
					'right_sidebar'               => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
					),
					'left_sidebar'                => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
					),
					'no_sidebar_full_width'       => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
					),
					'no_sidebar_content_centered' => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
					),
				),
				'image_col' => 3,
				'priority'  => 50,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}
}

return new Spacious_Customize_WooCommerce_Sidebar_Options();
