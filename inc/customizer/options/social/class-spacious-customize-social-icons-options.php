<?php
/**
 * Class to include Social customize options.
 *
 * Class Spacious_Customize_Social_Icons_Options
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
 * Class to include Social customize option.
 *
 * Class Spacious_Customize_Social_Icons_Options
 */
class Spacious_Customize_Social_Icons_Options extends Spacious_Customize_Base_Option {

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
			 * Social Icons.
			 */
			array(
				'name'    => 'social_link_activation_heading',
				'type'    => 'control',
				'control' => 'spacious-title',
				'label'   => esc_html__( 'Activate social links area', 'spacious' ),
				'section' => 'spacious_social_links_options',
			),

			// Social links enable/disable option.
			array(
				'name'      => 'spacious_activate_social_links',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'     => esc_html__( 'Check to activate social links area. You also need to activate the header top bar section in Header options to show this social links area', 'spacious' ),
				'section'   => 'spacious_social_links_options',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector' => '.social-links',
				),
			),

			array(
				'name'       => 'social_icon_heading',
				'type'       => 'control',
				'control'    => 'spacious-title',
				'label'      => esc_html__( 'Social Icon', 'spacious' ),
				'section'    => 'spacious_social_links_options',
				'dependency' => array(
					'spacious_activate_social_links',
					'!=',
					0,
				),
			),

		);

		$options = array_merge( $options, $configs );

		// Social links lists.
		$spacious_social_links = array(
			'spacious_social_facebook'  => esc_html__( 'Facebook', 'spacious' ),
			'spacious_social_twitter'   => esc_html__( 'Twitter', 'spacious' ),
			'spacious_social_instagram' => esc_html__( 'Instagram', 'spacious' ),
			'spacious_social_linkedin'  => esc_html__( 'LinkedIn', 'spacious' )
		);

		$i = 1;

		// Available social links via theme.
		foreach ( $spacious_social_links as $key => $value ) {

			// Social links url option.
			$configs[] = array(
				'name'       => $key,
				'default'    => '',
				'type'       => 'control',
				'control'    => 'url',
				'label'      => sprintf( 'Add link for %1$s', $value ),
				'section'    => 'spacious_social_links_options',
				'dependency' => array(
					'spacious_activate_social_links',
					'!=',
					0,
				),
			);

			// Social links open in new tab enable/disable option.
			$configs[] = array(
				'name'       => $key . 'new_tab',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Check to show in new tab', 'spacious' ),
				'section'    => 'spacious_social_links_options',
				'dependency' => array(
					'spacious_activate_social_links',
					'!=',
					0,
				),
			);

			// Social links separator.
			$configs[] = array(
				'name'       => $key . '_additional',
				'type'       => 'control',
				'control'    => 'spacious-divider',
				'section'    => 'spacious_social_links_options',
				'dependency' => array(
					'spacious_activate_social_links',
					'!=',
					0,
				),
			);

			$i++;

		}

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Social_Icons_Options();
