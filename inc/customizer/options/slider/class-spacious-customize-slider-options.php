<?php
/**
 * Class to include Blog Single Page customize options.
 *
 * Class jSpacious_Customize_Slider_Options
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
				'name'    => 'spacious[slider_activate_heading]',
				'type'    => 'control',
				'control' => 'spacious-title',
				'label'   => esc_html__( 'Activate slider', 'spacious' ),
				'section' => 'spacious_slider_options',
			),

			array(
				'name'      => 'spacious[spacious_activate_slider]',
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
				'name'       => 'spacious[slider_status_heading]',
				'type'       => 'control',
				'control'    => 'spacious-title',
				'label'      => esc_html__( 'Slider Status', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			),

			// Slider status options.
			array(
				'name'       => 'spacious[spacious_slider_status]',
				'default'    => 'home_front_page',
				'type'       => 'control',
				'control'    => 'radio',
				'label'      => esc_html__( 'Choose the slider status that you want.', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'choices'    => array(
					'home_front_page' => esc_html__( 'Slider on Front and blog page', 'spacious' ),
					'front_only'      => esc_html__( 'Slider on Front page only', 'spacious' ),
					'all_page'        => esc_html__( 'Slider on all pages', 'spacious' ),
				),
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			),

			// Heading for slider setting.
			array(
				'name'       => 'spacious[slider_setting_heading]',
				'type'       => 'control',
				'control'    => 'spacious-title',
				'label'      => esc_html__( 'Slider Settings', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			),

			array(
				'name'       => 'spacious[spacious_slider_transition_effect]',
				'default'    => 'fade',
				'type'       => 'control',
				'control'    => 'select',
				'label'      => esc_html__( 'Slider transition effect', 'spacious' ) . '  ' . esc_html__( 'Choose the transition effect that you like. Default is "fade".', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'choices'    => array(
					'fade'       => esc_html__( 'Fade', 'spacious' ),
					'fadeout'    => esc_html__( 'FadeOut', 'spacious' ),
					'none'       => esc_html__( 'None', 'spacious' ),
					'scrollHorz' => esc_html__( 'ScrollHorz', 'spacious' ),
					'flipHorz'   => esc_html__( 'FlipHorz', 'spacious' ),
					'flipVert'   => esc_html__( 'FlipVert', 'spacious' ),
					'tileBlind'  => esc_html__( 'TileBlind', 'spacious' ),
					'shuffle'    => esc_html__( 'Shuffle', 'spacious' ),
				),
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			),

			array(
				'name'       => 'spacious[spacious_slider_transition_delay]',
				'default'    => 4,
				'type'       => 'control',
				'control'    => 'text',
				'label'      => esc_html__( 'Slider transition delay time', 'spacious' ) . '  ' . esc_html__( 'Add number in seconds. Default is 4.', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			),

			array(
				'name'       => 'spacious[spacious_slider_transition_length]',
				'default'    => 1,
				'type'       => 'control',
				'control'    => 'text',
				'label'      => esc_html__( 'Slider transition length time', 'spacious' ) . '  ' . esc_html__( 'Add number in seconds. Default is 1.', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			),

			array(
				'name'       => 'spacious[spacious_slider_number]',
				'default'    => 5,
				'type'       => 'control',
				'control'    => 'text',
				'label'      => esc_html__( 'Number of slides', 'spacious' ) . '  ' . esc_html__( 'Enter the number of slides you want then click save.', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			),

			array(
				'name'       => 'spacious[spacious_slider_image_link_option]',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Check to make the slider images link back to respective links.', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			),

			array(
				'name'       => 'spacious[spacious_slider_next_prev_option]',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Check to enable next/prev option.', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			),

			array(
				'name'       => 'spacious[spacious_slider_pause_on_hover_option]',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Check to enable pause on hover.', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			),

			array(
				'name'       => 'spacious[spacious_slider_progressbar_option]',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Check to enable progressbar.', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			),

			array(
				'name'       => 'spacious[spacious_slider_random_order_option]',
				'default'    => false,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Check to display slides in random order.', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			),

		);

		$options = array_merge( $options, $configs );

		$num_of_slides = spacious_options( 'spacious_slider_number', '5' );

		for ( $i = 1; $i <= $num_of_slides; $i++ ) {

			$configs[] = array(
				'name'       => 'spacious[slider_image_upload_heading' . $i . ' ]',
				'type'       => 'control',
				'control'    => 'spacious-title',
				'label'      => sprintf( esc_html__( 'Slider Content #%1$s', 'spacious' ), $i ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			);

			$configs[] = array(
				'name'       => 'spacious[spacious_slider_image' . $i . ']',
				'default'    => '',
				'type'       => 'control',
				'control'    => 'image',
				'label'      => esc_html__( 'Upload slider image.', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			);

			$configs[] = array(
				'name'       => 'spacious[spacious_slider_title' . $i . ']',
				'default'    => '',
				'type'       => 'control',
				'control'    => 'text',
				'label'      => esc_html__( 'Enter title for your slider.', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			);

			$configs[] = array(
				'name'       => 'spacious[spacious_slider_text' . $i . ']',
				'default'    => '',
				'type'       => 'control',
				'control'    => 'textarea',
				'label'      => esc_html__( 'Enter your slider description.', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			);

			$configs[] = array(
				'name'       => 'spacious[spacious_slide_text_position' . $i . ']',
				'default'    => 'left',
				'type'       => 'control',
				'control'    => 'radio',
				'label'      => esc_html__( 'Slider text position.', 'spacious' ),
				'choices'    => array(
					'right'  => esc_html__( 'Right side', 'spacious' ),
					'left'   => esc_html__( 'Left side', 'spacious' ),
					'center' => esc_html__( 'Center', 'spacious' ),
				),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			);

			$configs[] = array(
				'name'       => 'spacious[spacious_slider_button_text' . $i . ']',
				'default'    => '',
				'type'       => 'control',
				'control'    => 'text',
				'label'      => esc_html__( 'Enter the button text. Default is "Read more"', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			);

			$configs[] = array(
				'name'       => 'spacious[spacious_slider_link' . $i . ']',
				'default'    => '',
				'type'       => 'control',
				'control'    => 'url',
				'label'      => esc_html__( 'Enter link to redirect slider when clicked', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			);
		}

		$options = array_merge( $options, $configs );

		$configs = array(

			array(
				'name'       => 'spacious[slider_color_heading]',
				'type'       => 'control',
				'control'    => 'spacious-title',
				'label'      => esc_html__( 'Colors', 'colormag' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			),

			array(
				'name'       => 'spacious[spacious_slider_title_color]',
				'default'    => '#FFFFFF',
				'type'       => 'control',
				'control'    => 'spacious-color',
				'label'      => esc_html__( 'Slider title. Default is #FFFFFF.', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			),

			array(
				'name'       => 'spacious[spacious_slider_content_color]',
				'default'    => '#FFFFFF',
				'type'       => 'control',
				'control'    => 'spacious-color',
				'label'      => esc_html__( 'Slider content. Default is #FFFFFF.', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			),

			array(
				'name'       => 'spacious[spacious_slider_button_color]',
				'default'    => '#FFFFFF',
				'type'       => 'control',
				'control'    => 'spacious-color',
				'label'      => esc_html__( 'Slider button text color. Default is #FFFFFF.', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			),

			array(
				'name'       => 'spacious[spacious_slider_button_background_color]',
				'default'    => '#0FBE7C',
				'type'       => 'control',
				'control'    => 'spacious-color',
				'label'      => esc_html__( 'Slider button background color. Default is #0FBE7C.', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			),

			array(
				'name'       => 'spacious[spacious_slider_content_background_color]',
				'default'    => 'rgba(0, 0, 0, 0.3)',
				'type'       => 'control',
				'control'    => 'spacious-color',
				'label'      => esc_html__( 'Slider content background color.', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			),

			// Slider typography heading.
			array(
				'name'       => 'spacious[slider_typography_heading]',
				'type'       => 'control',
				'control'    => 'spacious-title',
				'label'      => esc_html__( 'Typography', 'spacious' ),
				'section'    => 'spacious_slider_options',
				'priority'   => 80,
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
			),

			// slider title font size option
			array(
				'name'       => 'spacious[spacious_slider_title_font_size_heading]',
				'label'      => esc_html__( 'Slider title. Default is 26px.', 'spacious' ),
				'default'    => '',
				'type'       => 'control',
				'control'    => 'spacious-group',
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
				'priority'   => 515,
			),

			array(
				'name'        => 'spacious[spacious_slider_title_font_size_typography]',
				'default'     => array(
					'font-size' => array(
						'desktop' => '26',
						'tablet'  => '',
						'mobile'  => '',
					),
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 20,
							'max'  => 40,
						),
					),
					'tablet'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 20,
							'max'  => 40,
						),
					),
					'mobile'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 30,
						),
					),
				),
				'type'        => 'sub-control',
				'control'     => 'spacious-typography',
				'parent'      => 'spacious[spacious_slider_title_font_size_heading]',
				'section'     => 'spacious_slider_options',
				'dependency'  => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
				'priority'    => 515,
			),

			// Slider content font size.
			array(
				'name'       => 'spacious[spacious_slider_content_font_size_heading]',
				'label'      => esc_html__( 'Slider content. Default is 16px.', 'spacious' ),
				'default'    => '',
				'type'       => 'control',
				'control'    => 'spacious-group',
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
				'priority'   => 515,
			),

			array(
				'name'        => 'spacious[spacious_slider_content_font_size_typography]',
				'default'     => array(
					'font-size' => array(
						'desktop' => '12',
						'tablet'  => '',
						'mobile'  => '',
					),
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 20,
						),
					),
					'tablet'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 20,
						),
					),
					'mobile'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 20,
						),
					),
				),
				'type'        => 'sub-control',
				'control'     => 'spacious-typography',
				'parent'      => 'spacious[spacious_slider_content_font_size_heading]',
				'section'     => 'spacious_slider_options',
				'dependency'  => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
				'priority'    => 515,
			),

			// Slider button font size.
			array(
				'name'       => 'spacious[spacious_slider_button_font_size_heading]',
				'label'      => esc_html__( 'Slider button text. Default is 20px.', 'spacious' ),
				'default'    => '',
				'type'       => 'control',
				'control'    => 'spacious-group',
				'section'    => 'spacious_slider_options',
				'dependency' => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
				'priority'   => 515,
			),

			array(
				'name'        => 'spacious[spacious_slider_button_font_size_typography]',
				'default'     => array(
					'font-size' => array(
						'desktop' => '12',
						'tablet'  => '',
						'mobile'  => '',
					),
				),
				'input_attrs' => array(
					'desktop' => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 16,
						),
					),
					'tablet'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 30,
						),
					),
					'mobile'  => array(
						'font-size' => array(
							'step' => 1,
							'min'  => 12,
							'max'  => 30,
						),
					),
				),
				'type'        => 'sub-control',
				'control'     => 'spacious-typography',
				'parent'      => 'spacious[spacious_slider_button_font_size_heading]',
				'section'     => 'spacious_slider_options',
				'dependency'  => array(
					'spacious[spacious_activate_slider]',
					'!=',
					0,
				),
				'priority'    => 515,
			),


		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new Spacious_Customize_Slider_Options();
