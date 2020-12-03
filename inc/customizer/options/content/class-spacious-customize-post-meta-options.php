<?php
/**
 * Class to include Blog Post Meta customize options.
 *
 * Class Spacious_Customize_Post_Meta_Options
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
 * Class to include Post Meta customize options.
 *
 * Class Spacious_Customize_Post_Meta_Options
 */
class Spacious_Customize_Post_Meta_Options extends Spacious_Customize_Base_Option {

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

			/**
			 * Post meta display options.
			 */
			// Post meta display heading separator.
			array(
				'name'     => 'spacious[post_meta_display_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Post Meta Display', 'spacious' ),
				'section'  => 'spacious_post_meta_section',
				'priority' => 20,
			),

			// Total post meta display enable/disable option.
			array(
				'name'      => 'spacious[spacious_post_meta_full]',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'     => esc_html__( 'Disable the post meta for the post totally, ie, remove all of the meta data.', 'spacious' ),
				'section'   => 'spacious_post_meta_section',
				'priority'  => 30,
			),

			// Author post meta display enable/disable option.
			array(
				'name'      => 'spacious[spacious_post_meta_author]',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'     => esc_html__( 'Disable the author only in post meta section.', 'spacious' ),
				'section'   => 'spacious_post_meta_section',
				'priority'  => 40,
			),

			// Date post meta display enable/disable option.
			array(
				'name'      => 'spacious[spacious_post_meta_date]',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'     => esc_html__( 'Disable the date only in post meta section.', 'spacious' ),
				'section'   => 'spacious_post_meta_section',
				'priority'  => 50,
			),

			// Category post meta display enable/disable option.
			array(
				'name'      => 'spacious[spacious_post_meta_category]',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'     => esc_html__( 'Disable the category only in post meta section.', 'spacious' ),
				'section'   => 'spacious_post_meta_section',
				'priority'  => 60,
			),

			// Comments post meta display enable/disable option.
			array(
				'name'      => 'spacious[spacious_post_meta_comments]',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'     => esc_html__( 'Disable the comments only in post meta section.', 'spacious' ),
				'section'   => 'spacious_post_meta_section',
				'priority'  => 70,
			),

			// Tags post meta display enable/disable option.
			array(
				'name'      => 'spacious[spacious_post_meta_tags]',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'     => esc_html__( 'Disable the tags only in post meta section.', 'spacious' ),
				'section'   => 'spacious_post_meta_section',
				'priority'  => 80,
			),

			// edit button enable/disable option.
			array(
				'name'     => 'spacious[spacious_post_meta_edit_button]',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Disable the edit button only in the post meta section.', 'spacious' ),
				'section'  => 'spacious_post_meta_section',
				'priority' => 90,
			),

			/**
			 * Colors.
			 */

			// Color options heading separator.
			array(
				'name'     => 'spacious[post_meta_color_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Colors', 'spacious' ),
				'section'  => 'spacious_post_meta_section',
				'priority' => 100,
			),

			// Post meta icon group.
			array(
				'name'     => 'spacious[spacious_post_meta_icon_color]',
				'default'  => '#999999',
				'label'    => esc_html__( 'Post meta icon color. Post meta includes date, author, category etc. information of post. Default is #999999.', 'spacious' ),
				'type'     => 'control',
				'control'  => 'spacious-color',
				'section'  => 'spacious_post_meta_section',
				'priority' => 110,
			),

			// Post meta text color option.
			array(
				'name'     => 'spacious[spacious_post_meta_color]',
				'default'  => '#999999',
				'label'    => esc_html__( 'Post meta text color. Post meta includes date, author, category etc. information of post. Default is #999999.', 'spacious' ),
				'type'     => 'control',
				'control'  => 'spacious-color',
				'section'  => 'spacious_post_meta_section',
				'priority' => 120,
			),

			// Post meta readmore color option.
			array(
				'name'     => 'spacious[spacious_post_meta_read_more_color]',
				'default'  => '#FFFFFF',
				'control'  => 'spacious-color',
				'type'     => 'control',
				'label'    => esc_html__( 'Read more text in post meta. Default is #FFFFFF.', 'spacious' ),
				'section'  => 'spacious_post_meta_section',
				'priority' => 140,
			),

			array(
				'name'     => 'spacious[spacious_post_meta_read_more_background_color]',
				'default'  => '#0FBE7C',
				'control'  => 'spacious-color',
				'type'     => 'control',
				'label'    => esc_html__( 'Read more text background color. Default is #0FBE7C.', 'spacious' ),
				'section'  => 'spacious_post_meta_section',
				'priority' => 150,
			),

			array(
				'name'     => 'spacious[post_meta_typography_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Typography', 'spacious' ),
				'section'  => 'spacious_post_meta_section',
				'priority' => 160,
			),

			// post meta typography group.
			array(
				'name'     => 'spacious_post_meta_font_size_group',
				'label'    => esc_html__( 'Post meta font size. Default is 14px. Post meta includes date, author, category etc. information of post.', 'spacious' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_post_meta_section',
				'priority' => 170,
			),

			array(
				'name'        => 'spacious[spacious_post_meta_font_size_typography]',
				'default'     => array(
					'font-size' => array(
						'desktop' => '16',
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
				'parent'      => 'spacious_post_meta_font_size_group',
				'section'     => 'spacious_post_meta_section',
				'priority'    => 180,
			),

			// post meta read more typography group.
			array(
				'name'     => 'spacious_read_more_font_size_group',
				'label'    => esc_html__( 'Read more link font size. Default is 14px. Read more in post meta, TG: Featured Single Page widget and TG: Services widget.', 'spacious' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'spacious-group',
				'section'  => 'spacious_post_meta_section',
				'priority' => 170,
			),

			array(
				'name'        => 'spacious[spacious_read_more_font_size_typography]',
				'default'     => array(
					'font-size' => array(
						'desktop' => '14',
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
				'parent'      => 'spacious_read_more_font_size_group',
				'section'     => 'spacious_post_meta_section',
				'priority'    => 180,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Post_Meta_Options();
