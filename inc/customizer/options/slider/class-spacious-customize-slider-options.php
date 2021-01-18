<?php
/**
 * Class to include Blog Single Page customize options.
 *
 * Class jSpacious_Customize_Slider_Options
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
 * Class Spacious_Customize_Slider_Options
 */
class Spacious_Customize_Slider_Options extends Spacious_Customize_Base_Option {

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

			// Slider Activate heading.
			array(
				'name'    => 'slider_activate_heading',
				'type'    => 'control',
				'control' => 'spacious-title',
				'label'   => esc_html__( 'Activate slider', 'spacious' ),
				'section' => 'spacious_slider_options',
			),

			array(
				'name'      => 'spacious_activate_slider',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'     => esc_html__( 'Check to activate slider.', 'spacious' ),
				'section'   => 'spacious_slider_options',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector'        => '#featured-slider',
					'render_callback' => '',
				),
			),

			// slider status heading.
			array(
				'name'       => 'slider_status_heading',
				'type'       => 'control',
				'control'    => 'spacious-title',
				'label'      => esc_html__( 'Disable slider in Posts page', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious_activate_slider',
					'!=',
					0,
				),
			),

			array(
				'name'       => 'spacious_blog_slider',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Check to disable slider in Posts Page', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'transport'  => $customizer_selective_refresh,
				'partial'    => array(
					'selector'        => '#featured-slider',
					'render_callback' => '',
				),
				'dependency' => array(
					'spacious_activate_slider',
					'!=',
					0,
				),
			),
		);

		$options = array_merge( $options, $configs );

		for ( $i = 1; $i <= 5; $i++ ) {

			$configs[] = array(
				'name'       => 'slider_image_upload_heading' . $i,
				'type'       => 'control',
				'control'    => 'spacious-title',
				'label'      => sprintf( esc_html__( 'Slider Content #%1$s', 'spacious' ), $i ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious_activate_slider',
					'!=',
					0,
				),
			);

			$configs[] = array(
				'name'       => 'spacious_slider_image' . $i,
				'default'    => '',
				'type'       => 'control',
				'control'    => 'image',
				'label'      => esc_html__( 'Upload slider image.', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious_activate_slider',
					'!=',
					0,
				),
			);

			$configs[] = array(
				'name'       => 'spacious_slider_title' . $i,
				'default'    => '',
				'type'       => 'control',
				'control'    => 'text',
				'label'      => esc_html__( 'Enter title for your slider.', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious_activate_slider',
					'!=',
					0,
				),
			);

			$configs[] = array(
				'name'       => 'spacious_slider_text' . $i,
				'default'    => '',
				'type'       => 'control',
				'control'    => 'textarea',
				'label'      => esc_html__( 'Enter your slider description.', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious_activate_slider',
					'!=',
					0,
				),
			);

			$configs[] = array(
				'name'       => 'spacious_slider_button_text' . $i,
				'default'    => '',
				'type'       => 'control',
				'control'    => 'text',
				'label'      => esc_html__( 'Enter the button text. Default is "Read more"', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious_activate_slider',
					'!=',
					0,
				),
			);

			$configs[] = array(
				'name'       => 'spacious_slider_link' . $i,
				'default'    => '',
				'type'       => 'control',
				'control'    => 'url',
				'label'      => esc_html__( 'Enter link to redirect slider when clicked', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious_activate_slider',
					'!=',
					0,
				),
			);
		}

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Slider_Options();
