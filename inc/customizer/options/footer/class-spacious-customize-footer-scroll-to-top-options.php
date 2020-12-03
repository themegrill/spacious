<?php
/**
 * Class to include Footer Bottom Bar customize options.
 *
 * Class Spacious_Customize_Scroll_To_Top_Options
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
 * Class Spacious_Customize_Scroll_To_Top_Options
 */
class Spacious_Customize_Scroll_To_Top_Options extends Spacious_Customize_Base_Option {

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
				'name'    => 'spacious[spacious_scroll_to_top_feature]',
				'default' => 0,
				'type'    => 'control',
				'control' => 'checkbox',
				'label'   => esc_html__( 'Check to disable the scroll to top button.', 'spacious' ),
				'section' => 'spacious_scroll_to_top_feature_section',
			),

		);


		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Scroll_To_Top_Options();
