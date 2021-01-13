<?php
/**
 * Spacious enqueue CSS and JS files.
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 1.9.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function spacious_scripts_styles_method() {

	// Return if enqueueing is not enabled by the user.
	if ( false === apply_filters( 'spacious_enqueue_theme_assets', true ) ) {
		return;
	}

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	/**
	 * Loads our main stylesheet.
	 */
	wp_enqueue_style( 'spacious_style', get_stylesheet_uri() );
	wp_style_add_data( 'spacious_style', 'rtl', 'replace' );

	if ( get_theme_mod( 'spacious_color_skin', 'light' ) == 'dark' ) {
		wp_enqueue_style( 'spacious_dark_style', SPACIOUS_CSS_URL . '/dark.css' );
	}

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'spacious-genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.3.1' );

	// Enqueue font-awesome style.
	wp_enqueue_style( 'spacious-font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );

	/**
	 * Inline CSS for this theme.
	 */
	add_filter( 'spacious_dynamic_theme_css', array( 'Spacious_Dynamic_CSS', 'render_output' ) );

	// Enqueue required Google font for the theme.
	Spacious_Generate_Fonts::render_fonts();

	// Generate dynamic CSS to add inline styles for the theme.
	$theme_dynamic_css = apply_filters( 'spacious_dynamic_theme_css', '' );
	if ( get_theme_mod( 'spacious_color_skin', 'light' ) == 'dark' ) {
		wp_add_inline_style( 'spacious_dark_style', $theme_dynamic_css );
	} else {
		wp_add_inline_style( 'spacious_style', $theme_dynamic_css );
	}

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/**
	 * Register JQuery cycle2 js file for slider.
	 */
	wp_register_script( 'jquery_cycle', SPACIOUS_JS_URL . '/jquery.cycle2.min.js', array( 'jquery' ), '2.1.6', true );
	wp_register_script( 'jquery-swipe', SPACIOUS_JS_URL . '/jquery.cycle2.swipe.min.js', array( 'jquery' ), false, true );

	wp_register_style( 'google_fonts', '//fonts.googleapis.com/css?family=Lato' );

	/**
	 * Enqueue Slider setup js file.
	 */
	if ( is_home() || is_front_page() && get_theme_mod( 'spacious_activate_slider', '0' ) == '1' ) {
		wp_enqueue_script( 'jquery-swipe' );
		wp_enqueue_script( 'jquery_cycle' );
	}

	wp_enqueue_script( 'spacious-navigation', SPACIOUS_JS_URL . '/navigation.js', array( 'jquery' ), false, true );

	// Skip link focus fix JS enqueue.
	wp_enqueue_script( 'spacious-skip-link-focus-fix', SPACIOUS_JS_URL . '/skip-link-focus-fix.js', array(), false, true );

	wp_enqueue_script( 'spacious-custom', SPACIOUS_JS_URL . '/spacious-custom.js', array( 'jquery' ) );

	wp_enqueue_script( 'html5', SPACIOUS_JS_URL . '/html5shiv.min.js', true );
	wp_script_add_data( 'html5', 'conditional', 'lte IE 8' );

}

add_action( 'wp_enqueue_scripts', 'spacious_scripts_styles_method' );

/**
 * Action hook to get the required Google fonts for this theme.
 */
function spacious_get_fonts() {

	/*
	 * Global
	 */
	$spacious_content_font_typography_default    = array(
		'font-family' => 'Lato',
	);
	$spacious_titles_font_typography_default     = array(
		'font-family' => 'Lato',
	);
	$spacious_site_title_font_typography_default = array(
		'font-family' => 'Lato',
	);
	$spacious_site_tagline_font_typography_default = array(
		'font-family' => 'Lato',
	);
	$spacious_primary_menu_font_typography_default = array(
		'font-family' => 'Lato',
	);
	$spacious_content_font_typography            = get_theme_mod( 'spacious_content_font_typography', $spacious_content_font_typography_default );
	$spacious_titles_font_typography             = get_theme_mod( 'spacious_titles_font_typography', $spacious_titles_font_typography_default );

	Spacious_Generate_Fonts::add_font( $spacious_content_font_typography['font-family'] );
	Spacious_Generate_Fonts::add_font( $spacious_titles_font_typography['font-family'] );
}

add_action( 'spacious_get_fonts', 'spacious_get_fonts' );


if ( ! function_exists( 'spacious_parse_css' ) ) :

	/**
	 * Parses CSS.
	 *
	 * @param string|array $default_value Default value.
	 * @param string|array $output_value Updated value.
	 * @param array $css_output Array of CSS.
	 * @param string $min_media Min Media breakpoint.
	 * @param string $max_media Max Media breakpoint.
	 *
	 * @return string Generated CSS.
	 */
	function spacious_parse_css( $default_value, $output_value, $css_output = array(), $min_media = '', $max_media = '' ) {

		// Return if default value matches.
		if ( $default_value == $output_value ) {
			return;
		}

		$parse_css = '';
		if ( is_array( $css_output ) && count( $css_output ) > 0 ) {

			foreach ( $css_output as $selector => $properties ) {

				if ( null === $properties ) {
					break;
				}

				if ( ! count( $properties ) ) {
					continue;
				}

				$temp_parse_css   = $selector . '{';
				$properties_added = 0;

				foreach ( $properties as $property => $value ) {

					if ( '' === $value ) {
						continue;
					}

					$properties_added++;
					$temp_parse_css .= $property . ':' . $value . ';';
				}

				$temp_parse_css .= '}';

				if ( $properties_added > 0 ) {
					$parse_css .= $temp_parse_css;
				}
			}

			if ( '' !== $parse_css && ( '' !== $min_media || '' !== $max_media ) ) {

				$media_css       = '@media ';
				$min_media_css   = '';
				$max_media_css   = '';
				$media_separator = '';

				if ( '' !== $min_media ) {
					$min_media_css = '(min-width:' . $min_media . 'px)';
				}

				if ( '' !== $max_media ) {
					$max_media_css = '(max-width:' . $max_media . 'px)';
				}

				if ( '' !== $min_media && '' !== $max_media ) {
					$media_separator = ' and ';
				}

				$media_css .= $min_media_css . $media_separator . $max_media_css . '{' . $parse_css . '}';

				return $media_css;

			}
		}

		return $parse_css;

	}

endif;

if ( ! function_exists( 'spacious_parse_background_css' ) ) :

	/**
	 * Returns the background CSS property for dynamic CSS generation.
	 *
	 * @param string|array $default_value Default value.
	 * @param string|array $output_value Updated value.
	 * @param string $selector CSS selector.
	 *
	 * @return string|void Generated CSS for background CSS property.
	 */
	function spacious_parse_background_css( $default_value, $output_value, $selector ) {

		if ( $default_value == $output_value ) {
			return;
		}

		$parse_css = '';
		$parse_css .= $selector . '{';

		// For background color.
		if ( isset( $output_value['background-color'] ) && ( $output_value['background-color'] != $default_value['background-color'] ) ) {
			$parse_css .= 'background-color:' . $output_value['background-color'] . ';';
		}

		// For background image.
		if ( isset( $output_value['background-image'] ) && ( $output_value['background-image'] != $default_value['background-image'] ) ) {
			$parse_css .= 'background-image:url(' . $output_value['background-image'] . ');';
		}

		// For background position.
		if ( isset( $output_value['background-position'] ) && ( $output_value['background-position'] != $default_value['background-position'] ) ) {
			$parse_css .= 'background-position:' . $output_value['background-position'] . ';';
		}

		// For background size.
		if ( isset( $output_value['background-size'] ) && ( $output_value['background-size'] != $default_value['background-size'] ) ) {
			$parse_css .= 'background-size:' . $output_value['background-size'] . ';';
		}

		// For background attachment.
		if ( isset( $output_value['background-attachment'] ) && ( $output_value['background-attachment'] != $default_value['background-attachment'] ) ) {
			$parse_css .= 'background-attachment:' . $output_value['background-attachment'] . ';';
		}

		// For background repeat.
		if ( isset( $output_value['background-repeat'] ) && ( $output_value['background-repeat'] != $default_value['background-repeat'] ) ) {
			$parse_css .= 'background-repeat:' . $output_value['background-repeat'] . ';';
		}

		$parse_css .= '}';

		return $parse_css;

	}

endif;

if ( ! function_exists( 'spacious_parse_typography_css' ) ) :

	/**
	 * Returns the background CSS property for dynamic CSS generation.
	 *
	 * @param string|array $default_value Default value.
	 * @param string|array $output_value Updated value.
	 * @param string $selector CSS selector.
	 * @param array $devices Devices for breakpoints.
	 *
	 * @return string|void Generated CSS for typography CSS.
	 */
	function spacious_parse_typography_css( $default_value, $output_value, $selector, $devices = array() ) {

		if ( $default_value == $output_value ) {
			return;
		}

		$parse_css = '';
		$parse_css .= $selector . '{';

		// For font family.
		if ( isset( $output_value['font-family'] ) && ( $output_value['font-family'] != $default_value['font-family'] ) ) {
			$parse_css .= 'font-family:' . $output_value['font-family'] . ';';
		}

		// For font style.
		if ( isset( $output_value['font-style'] ) && ( $output_value['font-style'] != $default_value['font-style'] ) ) {
			$parse_css .= 'font-style:' . $output_value['font-style'] . ';';
		}

		// For text transform.
		if ( isset( $output_value['text-transform'] ) && ( $output_value['text-transform'] != $default_value['text-transform'] ) ) {
			$parse_css .= 'text-transform:' . $output_value['text-transform'] . ';';
		}

		// For text decoration.
		if ( isset( $output_value['text-decoration'] ) && ( $output_value['text-decoration'] != $default_value['text-decoration'] ) ) {
			$parse_css .= 'text-decoration:' . $output_value['text-decoration'] . ';';
		}

		// For font weight.
		if ( isset( $output_value['font-weight'] ) && ( $output_value['font-weight'] != $default_value['font-weight'] ) ) {
			$font_weight_value = $output_value['font-weight'];

			if ( 'italic' === $font_weight_value || 'regular' === $font_weight_value ) {
				$parse_css .= 'font-weight:' . 400 . ';';
			} else {
				$parse_css .= 'font-weight:' . str_replace( 'italic', '', $font_weight_value ) . ';';
			}
		}

		// For font size on desktop.
		if ( isset( $output_value['font-size']['desktop'] ) && ( $output_value['font-size']['desktop'] != $default_value['font-size']['desktop'] ) ) {
			$parse_css .= 'font-size:' . $output_value['font-size']['desktop'] . 'px;';
		}

		// For line height on desktop.
		if ( isset( $output_value['line-height']['desktop'] ) && ( $output_value['line-height']['desktop'] != $default_value['line-height']['desktop'] ) ) {
			$parse_css .= 'line-height:' . $output_value['line-height']['desktop'] . ';';
		}

		// For letter spacing on desktop.
		if ( isset( $output_value['letter-spacing']['desktop'] ) && ( $output_value['letter-spacing']['desktop'] != $default_value['letter-spacing']['desktop'] ) ) {
			$parse_css .= 'letter-spacing:' . $output_value['letter-spacing']['desktop'] . 'px;';
		}

		$parse_css .= '}';

		// For responsive devices.
		if ( is_array( $devices ) ) {

			foreach ( $devices as $device => $size ) {

				// For tablet devices.
				if ( 'tablet' === $device && $size ) {
					if ( ( isset( $output_value['font-size']['tablet'] ) && $output_value['font-size']['tablet'] ) || ( isset( $output_value['line-height']['tablet'] ) && $output_value['line-height']['tablet'] ) || ( isset( $output_value['letter-spacing']['tablet'] ) && $output_value['letter-spacing']['tablet'] ) ) {
						$parse_css .= '@media(max-width:' . $size . 'px){';
						$parse_css .= $selector . '{';

						// For font size on tablet.
						if ( isset( $output_value['font-size']['tablet'] ) && ( $output_value['font-size']['tablet'] != $default_value['font-size']['tablet'] ) ) {
							$parse_css .= 'font-size:' . $output_value['font-size']['tablet'] . 'px;';
						}

						// For line height on tablet.
						if ( isset( $output_value['line-height']['tablet'] ) && ( $output_value['line-height']['tablet'] != $default_value['line-height']['tablet'] ) ) {
							$parse_css .= 'line-height:' . $output_value['line-height']['tablet'] . ';';
						}

						// For letter spacing on tablet.
						if ( isset( $output_value['letter-spacing']['tablet'] ) && ( $output_value['letter-spacing']['tablet'] != $default_value['letter-spacing']['tablet'] ) ) {
							$parse_css .= 'letter-spacing:' . $output_value['letter-spacing']['tablet'] . 'px;';
						}

						$parse_css .= '}';
						$parse_css .= '}';
					}
				}

				// For mobile devices.
				if ( 'mobile' === $device && $size ) {
					if ( ( isset( $output_value['font-size']['mobile'] ) && $output_value['font-size']['mobile'] ) || ( isset( $output_value['line-height']['mobile'] ) && $output_value['line-height']['mobile'] ) || ( isset( $output_value['letter-spacing']['mobile'] ) && $output_value['letter-spacing']['mobile'] ) ) {
						$parse_css .= '@media(max-width:' . $size . 'px){';
						$parse_css .= $selector . '{';

						// For font size on mobile.
						if ( isset( $output_value['font-size']['mobile'] ) && ( $output_value['font-size']['mobile'] != $default_value['font-size']['mobile'] ) ) {
							$parse_css .= 'font-size:' . $output_value['font-size']['mobile'] . 'px;';
						}

						// For line height on mobile.
						if ( isset( $output_value['line-height']['mobile'] ) && ( $output_value['line-height']['mobile'] != $default_value['line-height']['mobile'] ) ) {
							$parse_css .= 'line-height:' . $output_value['line-height']['mobile'] . ';';
						}

						// For letter spacing on mobile.
						if ( isset( $output_value['letter-spacing']['mobile'] ) && ( $output_value['letter-spacing']['mobile'] != $default_value['letter-spacing']['mobile'] ) ) {
							$parse_css .= 'letter-spacing:' . $output_value['letter-spacing']['mobile'] . 'px;';
						}

						$parse_css .= '}';
						$parse_css .= '}';
					}
				}
			}
		}

		return $parse_css;

	}

endif;
