<?php
/**
 * Class to include Blog Single Post customize options.
 *
 * Class Spacious_Customize_Single_Post_Options
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
 * Class to include Blog Single Post customize options.
 *
 * Class Spacious_Customize_Single_Post_Options
 */
class Spacious_Customize_Single_Post_Options extends Spacious_Customize_Base_Option {

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

			/**
			 * Author Bio.
			 */
			array(
				'name'     => 'spacious[author_bio_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Author Bio', 'spacious' ),
				'section'  => 'spacious_single_post_section',
				'priority' => 10,
			),

			array(
				'name'      => 'spacious[spacious_author_bio]',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'     => esc_html__( 'Check to enable the author bio section just below the post.', 'spacious' ),
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector' => '.author-box',
				),
				'section'   => 'spacious_single_post_section',
				'priority'  => 20,
			),

			array(
				'name'     => 'spacious[spacious_author_bio_link]',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to add the all post link of author url in the author box.', 'spacious' ),
				'section'  => 'spacious_single_post_section',
				'priority' => 30,
			),

			array(
				'name'     => 'spacious[spacious_author_bio_social_link_setting]',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to show the Social Profiles in the Author Bio.', 'spacious' ),
				'section'  => 'spacious_single_post_section',
				'priority' => 40,
			),

			array(
				'name'     => 'spacious[spacious_author_bio_social_link]',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to add the social links in the author bio section. Note: it suppots only the social icons provided by All In One SEO Pack or WordPress SEO plugin.', 'spacious' ),
				'section'  => 'spacious_single_post_section',
				'priority' => 50,
			),

			/**
			 * Featured Image.
			 */
			array(
				'name'     => 'spacious[featured_image_single_post_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Featured Image In Single Post Page', 'spacious' ),
				'section'  => 'spacious_single_post_section',
				'priority' => 70,
			),

			array(
				'name'     => 'spacious[spacious_featured_image_single_post_page]',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to enable the featured image in single post page.', 'spacious' ),
				'section'  => 'spacious_single_post_section',
				'priority' => 80,
			),

			/**
			 * Related posts options.
			 */
			array(
				'name'     => 'spacious[related_post_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Related Posts', 'spacious' ),
				'section'  => 'spacious_single_post_section',
				'priority' => 160,
			),

			array(
				'name'        => 'spacious[spacious_related_posts_activate]',
				'default'     => 0,
				'type'        => 'control',
				'control'     => 'checkbox',
				'label'       => esc_html__( 'Check to activate the related posts', 'spacious' ),
				'section'     => 'spacious_single_post_section',
				'priority'    => 170,
			),

			array(
				'name'       => 'spacious[spacious_related_posts]',
				'default'    => 'categories',
				'type'       => 'control',
				'control'    => 'radio',
				'label'      => esc_html__( 'Related Posts Must Be Shown As:', 'spacious' ),
				'section'    => 'spacious_single_post_section',
				'choices'    => array(
					'categories' => esc_html__( 'Related Posts By Categories', 'spacious' ),
					'tags'       => esc_html__( 'Related Posts By Tags', 'spacious' ),
				),
				'dependency' => array(
					'spacious[spacious_related_posts_activate]',
					'!=',
					0,
				),
				'priority'   => 180,
			),

			array(
				'name'       => 'spacious[spacious_related_post_number_display]',
				'default'    => '3',
				'type'       => 'control',
				'control'    => 'select',
				'label'      => esc_html__( 'Number of post to display', 'spacious' ),
				'section'    => 'spacious_single_post_section',
				'choices'    => array(
					'3' => esc_html__( '3', 'spacious' ),
					'6' => esc_html__( '6', 'spacious' ),
				),
				'dependency' => array(
					'spacious[spacious_related_posts_activate]',
					'!=',
					0,
				),
				'priority'   => 190,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Single_Post_Options();
