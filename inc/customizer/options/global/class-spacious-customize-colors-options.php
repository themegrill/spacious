<?php
/**
 * Class to include Colors customize options.
 *
 * Class Spacious_Customize_Colors_Options
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
 * Class to include Colors customize options.
 *
 * Class Spacious_Customize_Colors_Options
 */
class Spacious_Customize_Colors_Options extends Spacious_Customize_Base_Option {

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
			 * Primary Colors.
			 */
			// Primary color option.
			array(
				'name'     => 'spacious_primary_color',
				'default'  => '#0FBE7C',
				'type'     => 'control',
				'control'  => 'spacious-color',
				'label'    => esc_html__( 'Primary Color', 'spacious' ),
				'section'  => 'spacious_primary_colors_section',
				'priority' => 5,
			),

			// Skin color option.
			array(
				'name'     => 'spacious_color_skin',
				'default'  => 'light',
				'type'     => 'control',
				'control'  => 'spacious-radio-image',
				'label'    => esc_html__( 'Color Skin', 'spacious' ),
				'section'  => 'spacious_skin_color_section',
				'choices'  => array(
					'light' => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/light-color.jpg',
					),
					'dark'  => array(
						'label' => '',
						'url'   => SPACIOUS_ADMIN_IMAGES_URL . '/dark-color.jpg',
					),
				),
				'priority' => 0,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Colors_Options();
