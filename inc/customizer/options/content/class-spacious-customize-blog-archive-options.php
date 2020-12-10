<?php
/**
 * Class to include Blog General customize options.
 *
 * Class Spacious_Customize_Blog_Archive_Options
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
 * Class to include Blog General customize options.
 *
 * Class Spacious_Customize_Blog_Archive_Options
 */
class Spacious_Customize_Blog_Archive_Options extends Spacious_Customize_Base_Option {

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
				'name'     => 'blog_post_display_heading',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Blog Posts display type', 'spacious' ),
				'section'  => 'spacious_blog_content_options',
				'priority' => 10,
			),

			array(
				'name'        => 'spacious_archive_display_type',
				'default'     => 'blog_large',
				'type'        => 'control',
				'control'     => 'radio',
				'description' => esc_html__( 'Choose the layout option for the blog, archive and search results pages.', 'spacious' ),
				'section'     => 'spacious_blog_content_options',
				'choices'     => array(
					'blog_large'                  => esc_html__( 'Blog Image Large', 'spacious' ),
					'blog_medium'                 => esc_html__( 'Blog Image Medium', 'spacious' ),
					'blog_medium_alternate'       => esc_html__( 'Blog Image Alternate Medium', 'spacious' ),
					'blog_medium_round'           => esc_html__( 'Blog Image Round Medium', 'spacious' ),
					'blog_medium_round_alternate' => esc_html__( 'Blog Image Round Alternate Medium', 'spacious' ),
					'blog_full_content'           => esc_html__( 'Blog Full Content', 'spacious' ),
					'blog_masonry_content'        => esc_html__( 'Masonry', 'spacious' ),
					'blog_grid_content'           => esc_html__( 'Grid', 'spacious' ),
				),
				'priority'    => 20,
			),

			array(
				'name'       => 'spacious_blog_column_option',
				'default'    => '2',
				'type'       => 'control',
				'control'    => 'radio',
				'label'      => esc_html__( 'Column', 'spacious' ),
				'section'    => 'spacious_blog_content_options',
				'choices'    => array(
					'2' => esc_html__( 'Two', 'spacious' ),
					'3' => esc_html__( 'Three', 'spacious' ),
				),
				'dependency' => array(
					'conditions' => array(
						array(
							'spacious_archive_display_type',
							'==',
							'blog_masonry_content',
						),
						array(
							'spacious_archive_display_type',
							'==',
							'blog_grid_content',
						),
					),
					'operator'   => 'OR',
				),
				'priority'   => 30,
			),

			array(
				'name'     => 'excerpt_length_heading',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Excerpt Length', 'spacious' ),
				'section'  => 'spacious_blog_content_options',
				'priority' => 40,
			),

			// Excerpt length option.
			array(
				'name'     => 'spacious_excerpt_length',
				'default'  => 40,
				'type'     => 'control',
				'control'  => 'number',
				'label'    => esc_html__( 'Enter the number of Words you wish to show on excerpt. Default value is 40 words.', 'spacious' ),
				'section'  => 'spacious_blog_content_options',
				'priority' => 50,
			),

			array(
				'name'     => 'excerpt_readmore_heading',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Excerpt Read More Text', 'spacious' ),
				'section'  => 'spacious_blog_content_options',
				'priority' => 60,
			),

			// Read more text change option.
			array(
				'name'      => 'spacious_read_more_text',
				'default'   => esc_html__( 'Read more', 'spacious' ),
				'type'      => 'control',
				'control'   => 'text',
				'label'     => esc_html__( 'Replace the default Read more text with your own words', 'spacious' ),
				'section'   => 'spacious_blog_content_options',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector'        => '.read-more',
					'render_callback' => array(
						'Spacious_Customizer_Partials',
						'read_more_text_render',
					),
				),
				'priority'  => 70,
			),

			array(
				'name'     => 'content_readmore_heading',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Content Read More Tag', 'spacious' ),
				'section'  => 'spacious_blog_content_options',
				'priority' => 80,
			),

			array(
				'name'     => 'spacious_content_read_more_tag_display',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to display content read more tag from beginning.', 'spacious' ),
				'section'  => 'spacious_blog_content_options',
				'priority' => 90,
			),

			array(
				'name'     => 'category_description_heading',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Category Options', 'spacious' ),
				'section'  => 'spacious_blog_content_options',
				'priority' => 100,
			),

			array(
				'name'      => 'spacious_term_description',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'     => esc_html__( 'Activate term description', 'spacious' ),
				'section'   => 'spacious_blog_content_options',
				'priority'  => 110,
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector'        => '.taxonomy-description',
					'render_callback' => array(
						'Spacious_Customizer_Partials',
						'spacious_taxonomy_description',
					),
				),
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Blog_Archive_Options();
