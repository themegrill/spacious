<?php
/**
 * Class to include Header button customize options.
 *
 * Class Spacious_Customize_Page_Header_options
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
				'name'    => 'spacious[header_title_heading]',
				'type'    => 'control',
				'control' => 'spacious-title',
				'label'   => esc_html__( 'Header Title', 'spacious' ),
				'section' => 'spacious_post_page_content_options',
			),

			array(
				'name'    => 'spacious[spacious_header_title_hide]',
				'default' => 0,
				'type'    => 'control',
				'control' => 'checkbox',
				'label'   => esc_html__( 'Hide page/post header title', 'spacious' ),
				'section' => 'spacious_post_page_content_options',
			),

			// Background option.
			array(
				'name'       => 'spacious[spacious_header_title_background_option]',
				'default'    => array(
					'background-color'      => '#ffffff',
					'background-image'      => '',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-repeat'     => 'repeat',
				),
				'type'       => 'control',
				'control'    => 'spacious-background',
				'section'    => 'spacious_post_page_content_options',
				'dependency' => array(
					'spacious_header_title_hide',
					'!=',
					'0',
				),
			),

			// Breadcrumb custom text option.
			array(
				'name'    => 'spacious[breadcrumb_custom_text_heading]',
				'type'    => 'control',
				'control' => 'spacious-title',
				'label'   => esc_html__( 'Breadcrumb Custom Text', 'spacious' ),
				'section' => 'spacious_post_page_content_options',
			),

			array(
				'name'    => 'spacious[spacious_custom_breadcrumb_text]',
				'default' => 'You are here:',
				'type'    => 'control',
				'control' => 'text',
				'label'   => esc_html__( 'Change the BreadCrumb text as your requirement.', 'spacious' ),
				'section' => 'spacious_post_page_content_options',
				'partial' => array(
					'selector'        => '.breadcrumb',
					'render_callback' => array(
						'Spacious_Customizer_Partials',
						'spacious_breadcrumb',
					),
				),
			),

			array(
				'name'    => 'spacious[page_post_content_color_heading]',
				'type'    => 'control',
				'control' => 'spacious-title',
				'label'   => esc_html__( 'Colors', 'spacious' ),
				'section' => 'spacious_post_page_content_options',
			),

//			// Background color option.
//			array(
//				'name'    => 'spacious[spacious_header_bar_background_color]',
//				'default' => '#FFFFFF',
//				'type'    => 'control',
//				'control' => 'spacious-color',
//				'label'   => esc_html__( 'Header bar background color. Default is #FFFFFF.', 'spacious' ),
//				'section' => 'spacious_post_page_content_options',
//			),

			// title color option.
			array(
				'name'    => 'spacious[spacious_page_post_title_color]',
				'default' => '#666666',
				'type'    => 'control',
				'control' => 'spacious-color',
				'label'   => esc_html__( 'Page title and post title in single view. Default is #222222', 'spacious' ),
				'section' => 'spacious_post_page_content_options',
			),

			// breadcrumb color option.
			array(
				'name'    => 'spacious[spacious_breadcrumb_text_color]',
				'default' => '#666666',
				'type'    => 'control',
				'control' => 'spacious-color',
				'label'   => esc_html__( 'Breadcrumb text color. Default is #666666.', 'spacious' ),
				'section' => 'spacious_post_page_content_options',
			),

			array(
				'name'     => 'spacious[page_post_content_typography_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Typography', 'spacious' ),
				'section'  => 'spacious_post_page_content_options',
				'priority' => 105,
			),


			// title typography group.
			array(
				'name'     => 'spacious_title_font_size_group',
				'label'    => esc_html__( 'Page title and post title in single view. Default is 22px. Appears in header bar just before content.', 'spacious' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_post_page_content_options',
				'priority' => 110,
			),

			array(
				'name'        => 'spacious[spacious_title_font_size_typography]',
				'default'     => array(
					'font-size' => array(
						'desktop' => '22',
						'tablet'  => '',
						'mobile'  => '',
					),
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 18,
							'max'  => 30,
						),
					),
					'tablet'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 18,
							'max'  => 30,
						),
					),
					'mobile'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 18,
							'max'  => 30,
						),
					),
				),
				'type'        => 'sub-control',
				'control'     => 'spacious-typography',
				'parent'      => 'spacious_title_font_size_group',
				'section'     => 'spacious_post_page_content_options',
				'priority'    => 120,
			),

			// breadcrumb typography group.
			array(
				'name'     => 'spacious_breadcrumb_text_font_size_group',
				'label'    => esc_html__( 'Breadcrumb Text. Default is 12px. Breadcrumb appears in header bar right side after installing Breadcrumb NavXT', 'spacious' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_post_page_content_options',
				'priority' => 110,
			),

			array(
				'name'        => 'spacious[spacious_breadcrumb_text_font_size_typography]',
				'default'     => array(
					'font-size' => array(
						'desktop' => '12',
						'tablet'  => '',
						'mobile'  => '',
					),
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 16,
						),
					),
					'tablet'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 16,
						),
					),
					'mobile'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 16,
						),
					),
				),
				'type'        => 'sub-control',
				'control'     => 'spacious-typography',
				'parent'      => 'spacious_breadcrumb_text_font_size_group',
				'section'     => 'spacious_post_page_content_options',
				'priority'    => 120,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Page_Header_options();
