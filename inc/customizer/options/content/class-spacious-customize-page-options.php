<?php
/**
 * Class to include Blog Single Page customize options.
 *
 * Class Spacious_Customize_Page_Options
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
 * Class to include Page customize options.
 *
 * Class Spacious_Customize_Page_Options
 */
class Spacious_Customize_Page_Options extends Spacious_Customize_Base_Option {

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
				'name'     => 'featured_image_page_heading',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Featured Image in Single Page', 'spacious' ),
				'section'  => 'spacious_page_section',
				'priority' => 10,
			),

			// Featured image display in single page option.
			array(
				'name'     => 'spacious_featured_image_single_page',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to enable the featured image in single page.', 'spacious' ),
				'section'  => 'spacious_page_section',
				'priority' => 20,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Page_Options();
