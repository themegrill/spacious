<?php
/**
 * Class to include Blog Single Page customize options.
 *
 * Class jSpacious_Customize_Comments_Options
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
 * Class to include Page customize options.
 *
 * Class Spacious_Customize_Comments_Options
 */
class Spacious_Customize_Comments_Options extends Spacious_Customize_Base_Option {

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
				'name'     => 'spacious[comment_color_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Colors', 'spacious' ),
				'section'  => 'spacious_comment_section',
				'priority' => 10,
			),

			array(
				'name'     => 'spacious[spacious_comment_part_background_color]',
				'default'  => '#FFFFFF',
				'type'     => 'control',
				'control'  => 'spacious-color',
				'label'    => esc_html__( 'Comment part background color. Default is #FFFFFF.', 'spacious' ),
				'section'  => 'spacious_comment_section',
				'priority' => 20,
			),

			array(
				'name'     => 'spacious[spacious_comment_title_color]',
				'default'  => '#222222',
				'type'     => 'control',
				'control'  => 'spacious-color',
				'label'    => esc_html__( 'Comment title color. Default is #222222.', 'spacious' ),
				'section'  => 'spacious_comment_section',
				'priority' => 20,
			),

			array(
				'name'     => 'spacious[spacious_comment_meta_color]',
				'default'  => '#999999',
				'type'     => 'control',
				'control'  => 'spacious-color',
				'label'    => esc_html__( 'Comment meta color. Like name, date etc. Default is #999999.', 'spacious' ),
				'section'  => 'spacious_comment_section',
				'priority' => 20,
			),

			array(
				'name'     => 'spacious[spacious_single_comment_background_color]',
				'default'  => '#F8F8F8',
				'type'     => 'control',
				'control'  => 'spacious-color',
				'label'    => esc_html__( 'Single comment background color. Like name, date etc. Default is #F8F8F8.', 'spacious' ),
				'section'  => 'spacious_comment_section',
				'priority' => 20,
			),

			array(
				'name'     => 'spacious[spacious_commenting_field_background_color]',
				'default'  => '#F8F8F8',
				'type'     => 'control',
				'control'  => 'spacious-color',
				'label'    => esc_html__( 'Commenting field background color. Like name, date etc. Default is #F8F8F8.', 'spacious' ),
				'section'  => 'spacious_comment_section',
				'priority' => 20,
			),

			array(
				'name'     => 'spacious[comment_typography_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Typography', 'spacious' ),
				'section'  => 'spacious_comment_section',
				'priority' => 105,
			),

			// Comments title typography group.
			array(
				'name'     => 'spacious_comment_title_font_size_group',
				'label'    => esc_html__( 'Comment Title. Default is 26px.', 'spacious' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_comment_section',
				'priority' => 110,
			),

			array(
				'name'        => 'spacious[spacious_comment_title_font_size_typography]',
				'default'     => array(
					'font-size' => array(
						'desktop' => '26',
						'tablet'  => '',
						'mobile'  => '',
					),
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 20,
							'max'  => 34,
						),
					),
					'tablet'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 20,
							'max'  => 34,
						),
					),
					'mobile'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 20,
							'max'  => 34,
						),
					),
				),
				'type'        => 'sub-control',
				'control'     => 'spacious-typography',
				'parent'      => 'spacious_comment_title_font_size_group',
				'section'     => 'spacious_comment_section',
				'priority'    => 120,
			),

			// Comments content typography group.
			array(
				'name'     => 'spacious_content_font_size_group',
				'label'    => esc_html__( 'Content font size, also applies to other text like in search fields, post comment button etc. Default is 16px.', 'spacious' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_comment_section',
				'priority' => 110,
			),

			array(
				'name'        => 'spacious[spacious_content_font_size_typography]',
				'default'     => array(
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
				'parent'      => 'spacious_content_font_size_group',
				'section'     => 'spacious_comment_section',
				'priority'    => 120,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Comments_Options();
