<?php
/**
 * Class to include Blog General customize options.
 *
 * Class Spacious_Customize_Blog_Archive_Options
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
					'blog_large'            => esc_html__( 'Blog Image Large', 'spacious' ),
					'blog_medium'           => esc_html__( 'Blog Image Medium', 'spacious' ),
					'blog_medium_alternate' => esc_html__( 'Blog Image Alternate Medium', 'spacious' ),
					'blog_full_content'     => esc_html__( 'Blog Full Content', 'spacious' ),
				),
				'priority'    => 20,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Blog_Archive_Options();
