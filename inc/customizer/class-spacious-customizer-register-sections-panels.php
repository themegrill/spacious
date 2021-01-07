<?php
/**
 * Class to register panels and sections for customize options.
 *
 * Class Spacious_Customize_Register_Section_Panels
 *
 * @package    ThemeGrill
 * @subpackage spacious
 * @since      Spacious 1.9.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to register panels and sections for customize options.
 *
 * Class Spacious_Customize_Register_Section_Panels
 */
class Spacious_Customize_Register_Section_Panels extends Spacious_Customize_Base_Option {

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

			// View Pro Version section.
			array(
				'name'             => 'spacious_customize_upsell_section',
				'type'             => 'section',
				'title'            => esc_html__( 'View Pro Version', 'spacious' ),
				'url'              => 'https://themegrill.com/spacious-pricing/?utm_source=spacious-customizer&utm_medium=view-pro-link&utm_campaign=spacious-pricing',
				'priority'         => 1,
				'section_callback' => 'Spacious_Upsell_Section',
			),


			/**
			 * Panels.
			 */
			array(
				'name'     => 'spacious_global_options',
				'type'     => 'panel',
				'title'    => esc_html__( 'Global', 'spacious' ),
				'priority' => 10,
			),

			array(
				'name'     => 'spacious_header_options',
				'type'     => 'panel',
				'title'    => esc_html__( 'Header', 'spacious' ),
				'priority' => 20,
			),

			array(
				'name'     => 'spacious_slider_options',
				'type'     => 'section',
				'title'    => esc_html__( 'Slider', 'spacious' ),
				'priority' => 30,
			),

			array(
				'name'     => 'spacious_content_options',
				'type'     => 'panel',
				'title'    => esc_html__( 'Content', 'spacious' ),
				'priority' => 40,
			),

			array(
				'name'     => 'spacious_footer_options',
				'type'     => 'panel',
				'title'    => esc_html__( 'Footer', 'spacious' ),
				'priority' => 50,
			),

			// Separator.
			array(
				'name'             => 'separator',
				'type'             => 'section',
				'priority'         => 80,
				'section_callback' => 'spacious_WP_Customize_Separator',
			),

			/**
			 * Global.
			 */
			// Colors.
			array(
				'name'     => 'spacious_global_color_setting',
				'type'     => 'section',
				'title'    => esc_html__( 'Colors', 'spacious' ),
				'panel'    => 'spacious_global_options',
				'priority' => 10,
			),

			array(
				'name'     => 'spacious_primary_colors_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Primary Colors', 'spacious' ),
				'panel'    => 'spacious_global_options',
				'section'  => 'spacious_global_color_setting',
				'priority' => 10,
			),

			array(
				'name'     => 'spacious_skin_color_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Color Skin', 'spacious' ),
				'panel'    => 'spacious_global_options',
				'section'  => 'spacious_global_color_setting',
				'priority' => 30,
			),

			// Background.
			array(
				'name'     => 'spacious_global_background_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Background', 'spacious' ),
				'panel'    => 'spacious_global_options',
				'priority' => 20,
			),

			// Layout.
			array(
				'name'     => 'spacious_global_layout_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Layout', 'spacious' ),
				'panel'    => 'spacious_global_options',
				'priority' => 30,
			),

			array(
				'name'     => 'spacious_site_layout_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Site Layout', 'spacious' ),
				'panel'    => 'spacious_global_options',
				'section'  => 'spacious_global_layout_section',
				'priority' => 10,
			),

			array(
				'name'     => 'spacious_sidebar_layout_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Sidebar Layout', 'spacious' ),
				'panel'    => 'spacious_global_options',
				'section'  => 'spacious_global_layout_section',
				'priority' => 20,
			),

			// Typography.
			array(
				'name'     => 'spacious_global_typography_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Typography', 'spacious' ),
				'panel'    => 'spacious_global_options',
				'priority' => 40,
			),

			array(
				'name'     => 'spacious_base_typography_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Base', 'spacious' ),
				'panel'    => 'spacious_global_options',
				'section'  => 'spacious_global_typography_section',
				'priority' => 10,
			),

			array(
				'name'     => 'spacious_headings_typography_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Headings', 'spacious' ),
				'panel'    => 'spacious_global_options',
				'section'  => 'spacious_global_typography_section',
				'priority' => 20,
			),

			/**
			 * Header.
			 */
			array(
				'name'     => 'title_tagline',
				'type'     => 'section',
				'title'    => esc_html__( 'Site Identity', 'spacious' ),
				'panel'    => 'spacious_header_options',
				'priority' => 5,
			),

			array(
				'name'     => 'spacious_header_top_bar',
				'type'     => 'section',
				'title'    => esc_html__( 'Top Bar', 'spacious' ),
				'panel'    => 'spacious_header_options',
				'priority' => 20,
			),

			array(
				'name'     => 'spacious_header_main',
				'type'     => 'section',
				'title'    => esc_html__( 'Primary Header', 'spacious' ),
				'panel'    => 'spacious_header_options',
				'priority' => 30,
			),

			array(
				'name'     => 'spacious_header_primary_menu',
				'type'     => 'section',
				'title'    => esc_html__( 'Primary Menu', 'spacious' ),
				'panel'    => 'spacious_header_options',
				'priority' => 40,
			),

			array(
				'name'     => 'spacious_header_button',
				'type'     => 'section',
				'title'    => esc_html__( 'Header Button', 'spacious' ),
				'panel'    => 'spacious_header_options',
				'priority' => 50,
			),

			array(
				'name'     => 'spacious_header_button_one',
				'type'     => 'section',
				'title'    => esc_html__( 'Header Button One', 'spacious' ),
				'panel'    => 'spacious_header_options',
				'section'  => 'spacious_header_button',
				'priority' => 20,
			),

			/**
			 * Content.
			 */
			array(
				'name'     => 'spacious_post_page_content_options',
				'type'     => 'section',
				'title'    => esc_html__( 'Page Header', 'spacious' ),
				'panel'    => 'spacious_content_options',
				'priority' => 10,
			),

			array(
				'name'     => 'spacious_blog_content_options',
				'type'     => 'section',
				'title'    => esc_html__( 'Blog / Archive', 'spacious' ),
				'panel'    => 'spacious_content_options',
				'priority' => 20,
			),

			array(
				'name'     => 'spacious_single_post_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Single Post', 'spacious' ),
				'panel'    => 'spacious_content_options',
				'priority' => 30,
			),


			array(
				'name'     => 'spacious_page_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Page', 'spacious' ),
				'panel'    => 'spacious_content_options',
				'priority' => 50,
			),

			/**
			 * Footer.
			 */

			array(
				'name'     => 'spacious_footer_widgets_area_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Footer Widgets Area', 'spacious' ),
				'panel'    => 'spacious_footer_options',
				'priority' => 20,
			),


			/**
			 * Additional.
			 */
			array(
				'name'     => 'spacious_social_links_options',
				'type'     => 'section',
				'title'    => esc_html__( 'Social Icons', 'spacious' ),
				'priority' => 10,
			),

			/**
			 * WooCommerce.
			 */
			array(
				'name'     => 'spacious_woocommerce_page_layout_setting',
				'type'     => 'section',
				'title'    => esc_html__( 'Sidebar', 'spacious' ),
				'panel'    => 'woocommerce',
				'priority' => 1,
			),

			array(
				'name'     => 'spacious_woocommerce_button_design',
				'type'     => 'section',
				'title'    => esc_html__( 'Design', 'spacious' ),
				'panel'    => 'woocommerce',
				'priority' => 2,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Register_Section_Panels();
