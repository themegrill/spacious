<?php
/**
 * Class to include Social customize options.
 *
 * Class Spacious_Customize_Social_Icons_Options
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
				'name'    => 'spacious[social_link_activation_heading]',
				'type'    => 'control',
				'control' => 'spacious-title',
				'label'   => esc_html__( 'Activate social links area', 'spacious' ),
				'section' => 'spacious_social_links_options',
			),

			// Social links enable/disable option.
			array(
				'name'      => 'spacious[spacious_activate_social_links]',
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
				'name'       => 'spacious[social_icon_heading]',
				'type'       => 'control',
				'control'    => 'spacious-title',
				'label'      => esc_html__( 'Social Icon', 'spacious' ),
				'section'    => 'spacious_social_links_options',
				'dependency' => array(
					'spacious[spacious_social_link_activate]',
					'!=',
					0,
				),
			),

		);

		$options = array_merge( $options, $configs );

		// Social links lists.
		$spacious_social_links = array(
			'spacious_social_facebook'    => esc_html__( 'Facebook', 'spacious' ),
			'spacious_social_twitter'     => esc_html__( 'Twitter', 'spacious' ),
			'spacious_social_googleplus'  => esc_html__( 'GooglePlus', 'spacious' ),
			'spacious_social_instagram'   => esc_html__( 'Instagram', 'spacious' ),
			'spacious_social_codepen'     => esc_html__( 'CodePen', 'spacious' ),
			'spacious_social_digg'        => esc_html__( 'Digg', 'spacious' ),
			'spacious_social_dribbble'    => esc_html__( 'Dribbble', 'spacious' ),
			'spacious_social_flickr'      => esc_html__( 'Flickr', 'spacious' ),
			'spacious_social_github'      => esc_html__( 'GitHub', 'spacious' ),
			'spacious_social_linkedin'    => esc_html__( 'LinkedIn', 'spacious' ),
			'spacious_social_pinterest'   => esc_html__( 'Pinterest', 'spacious' ),
			'spacious_social_polldaddy'   => esc_html__( 'Polldaddy', 'spacious' ),
			'spacious_social_pocket'      => esc_html__( 'Pocket', 'spacious' ),
			'spacious_social_reddit'      => esc_html__( 'Reddit', 'spacious' ),
			'spacious_social_skype'       => esc_html__( 'Skype', 'spacious' ),
			'spacious_social_stumbleupon' => esc_html__( 'StumbleUpon', 'spacious' ),
			'spacious_social_tumblr'      => esc_html__( 'Tumblr', 'spacious' ),
			'spacious_social_vimeo'       => esc_html__( 'Vimeo', 'spacious' ),
			'spacious_social_wordpress'   => esc_html__( 'WordPress', 'spacious' ),
			'spacious_social_youtube'     => esc_html__( 'YouTube', 'spacious' ),
			'spacious_social_rss'         => esc_html__( 'RSS', 'spacious' ),
			'spacious_social_mail'        => esc_html__( 'Mail', 'spacious' ),
		);
		$i                     = 1;

		// Available social links via theme.
		foreach ( $spacious_social_links as $key => $value ) {

			// Social links url option.
			$configs[] = array(
				'name'       => 'spacious[' . $key . ']',
				'default'    => '',
				'type'       => 'control',
				'control'    => 'url',
				'label'      => sprintf( 'Add link for %1$s', $value ),
				'section'    => 'spacious_social_links_options',
				'dependency' => array(
					'spacious[spacious_social_link_activate]',
					'!=',
					0,
				),
			);

			// Social links open in new tab enable/disable option.
			$configs[] = array(
				'name'       => 'spacious[' . $key . 'new_tab]',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Check to show in new tab', 'spacious' ),
				'section'    => 'spacious_social_links_options',
				'dependency' => array(
					'spacious[spacious_social_link_activate]',
					'!=',
					0,
				),
			);

			// Social links separator.
			$configs[] = array(
				'name'       => 'spacious[' . $key . '_additional]',
				'type'       => 'control',
				'control'    => 'spacious-divider',
				'section'    => 'spacious_social_links_options',
				'dependency' => array(
					'spacious[spacious_social_link_activate]',
					'!=',
					0,
				),
			);

			$i++;

		}

		$options = array_merge( $options, $configs );

		// Adding additional custom social links.
		$spacious_social_links_additional_icons = array(
			'spacious_social_additional_icon_one'   => esc_html__( 'Additional Social Icon One', 'spacious' ),
			'spacious_social_additional_icon_two'   => esc_html__( 'Additional Social Icon Two', 'spacious' ),
			'spacious_social_additional_icon_three' => esc_html__( 'Additional Social Icon Three', 'spacious' ),
			'spacious_social_additional_icon_four'  => esc_html__( 'Additional Social Icon Four', 'spacious' ),
			'spacious_social_additional_icon_five'  => esc_html__( 'Additional Social Icon Five', 'spacious' ),
		);

		$i = 1;
		foreach ( $spacious_social_links_additional_icons as $key => $value ) {

			$configs[] = array(
				'name'       => 'spacious[' . $key . '_additional]',
				'type'       => 'control',
				'control'    => 'spacious-divider',
				'section'    => 'spacious_social_links_options',
				'dependency' => array(
					'spacious[spacious_social_link_activate]',
					'!=',
					0,
				),
			);

			// Social links url option.
			$configs[] = array(
				'name'       => 'spacious[' . $key . ']',
				'default'    => '',
				'type'       => 'control',
				'control'    => 'url',
				'label'      => sprintf( esc_html__( 'Add link for %1$s', 'spacious' ), $value ),
				'section'    => 'spacious_social_links_options',
				'dependency' => array(
					'spacious[spacious_social_link_activate]',
					'!=',
					0,
				),
			);

			// Social links fontawesome icon option.
			$configs[] = array(
				'name'       => 'spacious[' . $key . '_fontawesome]',
				'default'    => '',
				'type'       => 'control',
				'control'    => 'text',
				'label'      => wp_kses(
					__( 'Add font awesome icon name. Example: soundcloud. You can find list <a href="http://fortawesome.github.io/Font-Awesome/icons/">here</a>', 'spacious' ), array(
						'a' => array(
							'href' => array(),
						)
					)
				),
				'section'    => 'spacious_social_links_options',
				'dependency' => array(
					'spacious[spacious_social_link_activate]',
					'!=',
					0,
				),
			);

			// Social links icon color option.
			$configs[] = array(
				'name'       => 'spacious[' . $key . '_color]',
				'default'    => '',
				'type'       => 'control',
				'control'    => 'spacious-color',
				'label'      => esc_html__( 'Add color for icon.', 'spacious' ),
				'section'    => 'spacious_social_links_options',
				'dependency' => array(
					'spacious[spacious_social_link_activate]',
					'!=',
					0,
				),
			);

			// Social links open in new tab enable/disable option.
			$configs[] = array(
				'name'       => 'spacious[' . $key . 'new_tab]',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Check to show in new tab', 'spacious' ),
				'section'    => 'spacious_social_links_options',
				'dependency' => array(
					'spacious[spacious_social_link_activate]',
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
