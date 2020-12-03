<?php
/**
 * Class to include Blog Single Page customize options.
 *
 * Class jSpacious_Customize_Widgets_Options
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
 * Class Spacious_Customize_Widgets_Options
 */
class Spacious_Customize_Widgets_Options extends Spacious_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array $options Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize ) {

		$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

		$configs = array(

			// Heading for widget color.
			array(
				'name'     => 'spacious[call_to_action_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'TG:Call to action widget color options', 'spacious' ),
				'section'  => 'spacious_widget_options',
				'priority' => 10,
			),

			// Tg: Call to Action color.
			array(
				'name'     => 'spacious[spacious_call_to_action_background_color]',
				'default'  => '#F8F8F8',
				'type'     => 'control',
				'control'  => 'spacious-color',
				'label'    => esc_html__( 'Background color. Default is #F8F8F8.', 'spacious' ),
				'section'  => 'spacious_widget_options',
				'priority' => 20,
			),

			array(
				'name'     => 'spacious[spacious_call_to_action_title_color]',
				'default'  => '#222222',
				'type'     => 'control',
				'control'  => 'spacious-color',
				'label'    => esc_html__( 'Title color. Default is #222222.', 'spacious' ),
				'section'  => 'spacious_widget_options',
				'priority' => 30,
			),

			array(
				'name'     => 'spacious[spacious_call_to_action_button_color]',
				'default'  => '#FFFFFF',
				'type'     => 'control',
				'control'  => 'spacious-color',
				'label'    => esc_html__( 'Button text color. Default is #FFFFFF.', 'spacious' ),
				'section'  => 'spacious_widget_options',
				'priority' => 40,
			),

			array(
				'name'     => 'spacious[spacious_call_to_action_button_background_color]',
				'default'  => '#0FBE7C',
				'type'     => 'control',
				'control'  => 'spacious-color',
				'label'    => esc_html__( 'Button background color. Default is #0FBE7C.', 'spacious' ),
				'section'  => 'spacious_widget_options',
				'priority' => 50,
			),

			// Heading for widget color.
			array(
				'name'     => 'spacious[widget_color_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Colors', 'spacious' ),
				'section'  => 'spacious_widget_options',
				'priority' => 60,
			),

			array(
				'name'     => 'spacious[spacious_posts_title_color]',
				'default'  => '#222222',
				'type'     => 'control',
				'control'  => 'spacious-color',
				'label'    => esc_html__( 'Title in posts listing or blog/category view. Also for posts titles in TG:Featured Posts widget. Default is #222222.', 'spacious' ),
				'section'  => 'spacious_widget_options',
				'priority' => 70,
			),

			array(
				'name'     => 'spacious[spacious_tg_widget_read_more_color]',
				'default'  => '#0FBE7C',
				'type'     => 'control',
				'control'  => 'spacious-color',
				'label'    => esc_html__( 'Read more link color for TG: Featured Single Page widget and TG: Services widget. Default is #0FBE7C.', 'spacious' ),
				'section'  => 'spacious_widget_options',
				'priority' => 80,
			),

			array(
				'name'     => 'spacious[spacious_border_lines_color]',
				'default'  => '#EAEAEA',
				'type'     => 'control',
				'control'  => 'spacious-color',
				'label'    => esc_html__( 'Border lines. These lines are used in various parts as seperator and as borders. Default is #EAEAEA.', 'spacious' ),
				'section'  => 'spacious_widget_options',
				'priority' => 90,
			),

			array(
				'name'     => 'spacious[widget_typography_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Typography', 'spacious' ),
				'section'  => 'spacious_widget_options',
				'priority' => 105,
			),

			// Call to action typography group.
			array(
				'name'     => 'spacious_call_to_action_title_font_size_group',
				'label'    => esc_html__( 'Title of TG: Call To Action widget. Default is 24px.', 'spacious' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_widget_options',
				'priority' => 110,
			),

			array(
				'name'        => 'spacious[spacious_call_to_action_title_font_size_typography]',
				'default'     => array(
					'font-size' => array(
						'desktop' => '24',
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
							'min'  => 12,
							'max'  => 20,
						),
					),
				),
				'type'        => 'sub-control',
				'control'     => 'spacious-typography',
				'parent'      => 'spacious_call_to_action_title_font_size_group',
				'section'     => 'spacious_widget_options',
				'priority'    => 120,
			),


			// Call to action button typography group.
			array(
				'name'     => 'spacious_call_to_action_button_font_size_group',
				'label'    => esc_html__( 'Button text of TG: Call To Action widget. Default is 22px.', 'spacious' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_widget_options',
				'priority' => 110,
			),

			array(
				'name'        => 'spacious[spacious_call_to_action_button_font_size_typography]',
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
				'parent'      => 'spacious_call_to_action_button_font_size_group',
				'section'     => 'spacious_widget_options',
				'priority'    => 120,
			),

			// Archive title typography group.
			array(
				'name'     => 'spacious_archive_title_font_size_group',
				'label'    => esc_html__( 'Title in posts listing or blog/category view. Also for posts titles in TG:Featured Posts widget. Default is 26px.', 'spacious' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_widget_options',
				'priority' => 110,
			),

			array(
				'name'        => 'spacious[spacious_archive_title_font_size_typography]',
				'default'     => array(
					'font-size' => array(
						'desktop' => '30',
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
				'parent'      => 'spacious_archive_title_font_size_group',
				'section'     => 'spacious_widget_options',
				'priority'    => 120,
			),


			// Client widget typography group.
			array(
				'name'     => 'spacious_client_widget_title_font_size_group',
				'label'    => esc_html__( 'Main title of TG: Featured Posts widget and TG: Our Clients widget. Default is 30px.', 'spacious' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_widget_options',
				'priority' => 110,
			),

			array(
				'name'        => 'spacious[spacious_client_widget_title_font_size_typography]',
				'default'     => array(
					'font-size' => array(
						'desktop' => '30',
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
				'parent'      => 'spacious_client_widget_title_font_size_group',
				'section'     => 'spacious_widget_options',
				'priority'    => 120,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Widgets_Options();
