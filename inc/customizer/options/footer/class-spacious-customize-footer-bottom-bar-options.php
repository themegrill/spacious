<?php
/**
 * Class to include Footer Bottom Bar customize options.
 *
 * Class Spacious_Customize_Footer_Bottom_Bar_Options
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
 * Class to include Footer Bottom Bar customize options.
 *
 * Class Spacious_Customize_Footer_Bottom_Bar_Options
 */
class Spacious_Customize_Footer_Bottom_Bar_Options extends Spacious_Customize_Base_Option {

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

		// Footer copyright default value.
		$default_footer_value = esc_html__( 'Copyright &copy; ', 'spacious' ) . '[the-year] [site-link] ' . esc_html__( 'Theme by: ', 'spacious' ) . '[tg-link] ' . esc_html__( 'Powered by: ', 'spacious' ) . '[wp-link]';

		$configs = array(

			/**
			 * Alignment.
			 */
			array(
				'name'    => 'spacious[footer_buttom_copyright_heading]',
				'type'    => 'control',
				'control' => 'spacious-title',
				'label'   => esc_html__( 'Footer Copyright Editor', 'spacious' ),
				'section' => 'spacious_footer_bottom_area_section',
			),

			array(
				'name'      => 'spacious[spacious_footer_editor]',
				'default'   => $default_footer_value,
				'type'      => 'control',
				'control'   => 'spacious-editor',
				'label'     => esc_html__( 'Edit the Copyright information in your footer. You can also use shortcodes [the-year], [site-link], [wp-link], [tg-link] for current year, your site link, WordPress site link and ThemeGrill site link respectively.', 'spacious' ),
				'section'   => 'spacious_footer_bottom_area_section',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector'        => '.copyright',
					'render_callback' => array(
						'Spacious_Customizer_Partials',
						'spacious_footer_copyright',
					),
				),
			),

			/**
			 * Alignment.
			 */
			array(
				'name'    => 'spacious[footer_buttom_copyright_alignment_heading]',
				'type'    => 'control',
				'control' => 'spacious-title',
				'label'   => esc_html__( 'Copyright Alignment', 'spacious' ),
				'section' => 'spacious_footer_bottom_area_section',
			),

			// Footer copyright alignment option.
			array(
				'name'      => 'spacious[spacious_copyright_layout]',
				'default'   => 'left',
				'type'      => 'control',
				'control'   => 'radio',
				'label'     => esc_html__( 'Display Copyright and Footer Menu either on left/right or on center Position.', 'spacious' ),
				'section'   => 'spacious_footer_bottom_area_section',
				'choices'   => array(
					'left'   => esc_html__( 'Left/Right', 'spacious' ),
					'right'  => esc_html__( 'Right/Left', 'spacious' ),
					'center' => esc_html__( 'Center', 'spacious' ),
				),
			),

			array(
				'name'    => 'spacious[footer_buttom_menu_heading]',
				'type'    => 'control',
				'control' => 'spacious-title',
				'label'   => esc_html__( 'Footer Menu', 'spacious' ),
				'section' => 'spacious_footer_bottom_area_section',
			),

			array(
				'name'      => 'spacious[spacious_footer_social]',
				'default'   => 'footer_menu',
				'type'      => 'control',
				'control'   => 'select',
				'label'     => esc_html__( 'Display Footer Menu or Social Menu.', 'spacious' ),
				'section'   => 'spacious_footer_bottom_area_section',
				'choices'   => array(
					'footer_menu' => esc_html__( 'Footer Menu', 'spacious' ),
					'social_menu' => esc_html__( 'Social Menu', 'spacious' ),
				),
			),

			/**
			 * Colors.
			 */
			array(
				'name'    => 'spacious[footer_bottom_bar_color_heading]',
				'type'    => 'control',
				'control' => 'spacious-title',
				'label'   => esc_html__( 'Colors', 'spacious' ),
				'section' => 'spacious_footer_bottom_area_section',
			),

			array(
				'name'    => 'spacious[spacious_footer_copyright_text_color]',
				'default' => '#666666',
				'label'   => esc_html__( 'Footer copyright text color. Default is #666666.', 'spacious' ),
				'type'    => 'control',
				'control' => 'spacious-color',
				'section' => 'spacious_footer_bottom_area_section',
			),

			array(
				'name'    => 'spacious[spacious_footer_small_menu_color]',
				'default' => '#666666',
				'label'   => esc_html__( 'Footer small menu text color. Default is #666666.', 'spacious' ),
				'type'    => 'control',
				'control' => 'spacious-color',
				'section' => 'spacious_footer_bottom_area_section',
			),

			array(
				'name'    => 'spacious[spacious_footer_copyright_part_background_color]',
				'default' => '#F8F8F8',
				'label'   => esc_html__( 'Footer copyright part background color. Default is #F8F8F8.', 'spacious' ),
				'type'    => 'control',
				'control' => 'spacious-color',
				'section' => 'spacious_footer_bottom_area_section',
			),

			array(
				'name'     => 'spacious[footer_bottom_bar_typography_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Typography', 'spacious' ),
				'section'  => 'spacious_footer_bottom_area_section',
				'priority' => 105,
			),

			// Footer bottom bar typography group.
			array(
				'name'     => 'spacious_footer_copyright_text_font_size_group',
				'label'    => esc_html__( 'Footer copyright text font size. Default is 12px.', 'spacious' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_footer_bottom_area_section',
				'priority' => 110,
			),

			array(
				'name'        => 'spacious[spacious_footer_copyright_text_font_size_typography]',
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
				'parent'      => 'spacious_footer_copyright_text_font_size_group',
				'section'     => 'spacious_footer_bottom_area_section',
				'priority'    => 120,
			),

			array(
				'name'     => 'spacious_small_footer_menu_font_size_group',
				'label'    => esc_html__( 'Footer small menu. Default is 12px.', 'spacious' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_footer_bottom_area_section',
				'priority' => 110,
			),

			array(
				'name'        => 'spacious[spacious_small_footer_menu_font_size_typography]',
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
				'parent'      => 'spacious_small_footer_menu_font_size_group',
				'section'     => 'spacious_footer_bottom_area_section',
				'priority'    => 120,
			),

		);


		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Footer_Bottom_Bar_Options();
