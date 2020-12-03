<?php
/**
 * Class to include Header Main Area customize options.
 *
 * Class Spacious_Customize_Site_Identity_Options
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
 * Class to include Header Main Area customize options.
 *
 * Class Spacious_Customize_Site_Identity_Options
 */
class Spacious_Customize_Site_Identity_Options extends Spacious_Customize_Base_Option {

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
				'name'     => 'spacious[logo_text_visibility_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Visibility', 'spacious' ),
				'section'  => 'title_tagline',
				'priority' => 0,
			),

			// Header logo placement option.
			array(
				'name'     => 'spacious[spacious_show_header_logo_text]',
				'default'  => 'text_only',
				'type'     => 'control',
				'control'  => 'radio',
				'label'    => esc_html__( 'Choose the option that you want.', 'spacious' ),
				'section'  => 'title_tagline',
				'choices'  => array(
					'logo_only' => esc_html__( 'Header Logo Only', 'spacious' ),
					'text_only' => esc_html__( 'Header Text Only', 'spacious' ),
					'both'      => esc_html__( 'Show Both', 'spacious' ),
					'none'      => esc_html__( 'Disable', 'spacious' ),
				),
				'priority' => 1,
			),

			array(
				'name'     => 'site_logo_heading',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Site Logo', 'spacious' ),
				'section'  => 'title_tagline',
				'priority' => 5,
			),

			array(
				'name'     => 'spacious[spacious_different_retina_logo]',
				'type'     => 'control',
				'control'  => 'checkbox',
				'default'  => 0,
				'label'    => esc_html__( 'Different Logo for Retina Devices?', 'spacious' ),
				'section'  => 'title_tagline',
				'priority' => 6,
			),

			array(
				'name'       => 'spacious[spacious_retina_logo_upload]',
				'type'       => 'control',
				'control'    => 'image',
				'label'      => esc_html__( 'Retina Logo', 'spacious' ),
				'section'    => 'title_tagline',
				'priority'   => 7,
				'dependency' => array(
					'spacious[spacious_different_retina_logo]',
					'!=',
					0,
				),
			),

			array(
				'name'     => 'spacious[site_icon_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Site Icon', 'spacious' ),
				'section'  => 'title_tagline',
				'priority' => 8,
			),

			array(
				'name'     => 'spacious[site_title_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Site Title', 'spacious' ),
				'section'  => 'title_tagline',
				'priority' => 9,
			),

			array(
				'name'     => 'spacious[site_tagline_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Site Tagline', 'spacious' ),
				'section'  => 'title_tagline',
				'priority' => 10,
			),

			/**
			 * Colors.
			 */
			array(
				'name'     => 'spacious[header_text_color_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Colors', 'spacious' ),
				'section'  => 'title_tagline',
				'priority' => 15,
			),

			/**
			 * Typography.
			 */
			array(
				'name'     => 'spacious[header_text_typography_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Typography', 'spacious' ),
				'section'  => 'title_tagline',
				'priority' => 20,
			),

			// Site title typography group.
			array(
				'name'     => 'spacious_site_title_typography_group',
				'label'    => esc_html__( 'Site Title', 'spacious' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'title_tagline',
				'priority' => 25,
			),

			array(
				'name'        => 'spacious[spacious_site_title_font_typography]',
				'default'     => array(
					'font-family' => 'Lato',
					'font-size'   => array(
						'desktop' => '36',
						'tablet'  => '',
						'mobile'  => '',
					),
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 26,
							'max'  => 46,
						),
					),
					'tablet' => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 26,
							'max'  => 46,
						),
					),
					'mobile' => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 26,
							'max'  => 46,
						),
					),
				),
				'type'        => 'sub-control',
				'control'     => 'spacious-typography',
				'parent'      => 'spacious_site_title_typography_group',
				'section'     => 'title_tagline',
				'priority'    => 30,
			),

			// Site title typography group.
			array(
				'name'     => 'spacious_site_tagline_typography_group',
				'label'    => esc_html__( 'Site Tagline', 'spacious' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'title_tagline',
				'priority' => 25,
			),

			array(
				'name'        => 'spacious[spacious_site_tagline_font_typography]',
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
					'tablet' => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 20,
						),
					),
					'mobile' => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 20,
						),
					),
				),
				'type'        => 'sub-control',
				'control'     => 'spacious-typography',
				'parent'      => 'spacious_site_tagline_typography_group',
				'section'     => 'title_tagline',
				'priority'    => 30,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Site_Identity_Options();
