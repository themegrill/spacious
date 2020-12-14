<?php
/**
 * Deprecated functions for Spacious theme.
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 2.4.5
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'spacious_the_custom_logo' ) ) :

	/**
	 * Deprecated function to display the custom logo.
	 */
	function spacious_the_custom_logo() {

		_deprecated_function( __FUNCTION__, '2.4.5', 'the_custom_logo()' );

		the_custom_logo();

	}

endif;

if ( ! function_exists( 'spacious_standard_fonts_array' ) ) :

	/**
	 * Deprecated function standard fonts array.
	 */
	function spacious_standard_fonts_array() {
		_deprecated_function( __FUNCTION__, '2.4.5' );
	}

endif;

if ( ! function_exists( 'spacious_google_fonts' ) ) :

	/**
	 * Deprecated function Google fonts array.
	 */
	function spacious_google_fonts() {
		_deprecated_function( __FUNCTION__, '2.4.5' );
	}

endif;

if ( ! function_exists( 'spacious_radio_sanitize' ) ) :

	/**
	 * Deprecate function for radio/select sanitization.
	 *
	 * @param string $input Input from the customize controls.
	 * @param WP_Customize_Setting $setting Setting instance.
	 */
	function spacious_radio_sanitize( $input, $setting ) {

		_deprecated_function( __FUNCTION__, '2.4.5', 'Spacious_Customizer_Sanitizes::sanitize_radio_select( $input, $setting )' );

		return Spacious_Customizer_Sanitizes::sanitize_radio_select( $input, $setting );

	}

endif;

if ( ! function_exists( 'spacious_font_sanitize' ) ) :

	/**
	 * Deprecate function for font sanitization.
	 *
	 * @param string $input Customizer input.
	 */
	function spacious_font_sanitize( $input ) {
		_deprecated_function( __FUNCTION__, '2.4.5' );
	}

endif;

if ( ! function_exists( 'spacious_checkbox_sanitize' ) ) :

	/**
	 * Deprecate function for checkbox sanitization.
	 *
	 * @param string $input Input from the customize controls.
	 */
	function spacious_checkbox_sanitize( $input ) {

		_deprecated_function( __FUNCTION__, '2.4.5', 'Spacious_Customizer_Sanitizes::sanitize_checkbox( $input )' );

		return Spacious_Customizer_Sanitizes::sanitize_checkbox( $input );

	}

endif;

if ( ! function_exists( 'spacious_editor_sanitize' ) ) :

	/**
	 * Deprecate function for editor sanitization.
	 *
	 * @param string $input Input from the customize controls.
	 */
	function spacious_editor_sanitize( $input ) {

		_deprecated_function( __FUNCTION__, '2.4.5', 'Spacious_Customizer_Sanitizes::sanitize_html( $input )' );

		return Spacious_Customizer_Sanitizes::sanitize_html( $input );

	}

endif;

if ( ! function_exists( 'spacious_color_option_hex_sanitize' ) ) :

	/**
	 * Deprecate function for hex color sanitization.
	 *
	 * @param string $color Input from the customize controls.
	 *
	 * @return string
	 */
	function spacious_color_option_hex_sanitize( $color ) {

		_deprecated_function( __FUNCTION__, '2.4.5', 'Spacious_Customizer_Sanitizes::sanitize_hex_color( $color )' );

		return Spacious_Customizer_Sanitizes::sanitize_hex_color( $color );

	}

endif;

if ( ! function_exists( 'spacious_color_escaping_option_sanitize' ) ) :

	/**
	 * Deprecate function for color escaping sanitization.
	 *
	 * @param string $input Input from the customize controls.
	 */
	function spacious_color_escaping_option_sanitize( $input ) {
		_deprecated_function( __FUNCTION__, '2.4.5' );
	}

endif;


if ( ! function_exists( 'spacious_text_sanitize' ) ) :

	/**
	 * Deprecate function for footer copyright editor sanitization.
	 *
	 * @param string $input Input from the customize controls.
	 */
	function spacious_text_sanitize( $input ) {

		_deprecated_function( __FUNCTION__, '2.4.5', 'Spacious_Customizer_Sanitizes::sanitize_html( $input )' );

		return Spacious_Customizer_Sanitizes::sanitize_html( $input );

	}

endif;

if ( ! function_exists( 'spacious_customize_partial_blogname' ) ) :

	/**
	 * Deprecate site title partial refresh function.
	 */
	function spacious_customize_partial_blogname() {

		_deprecated_function( __FUNCTION__, '2.4.5', 'Spacious_Customizer_Partials::render_customize_partial_blogname()' );

		Spacious_Customizer_Partials::render_customize_partial_blogname();

	}

endif;


if ( ! function_exists( 'spacious_customize_partial_blogdescription' ) ) :

	/**
	 * Deprecate site tagline partial refresh function.
	 */
	function spacious_customize_partial_blogdescription() {

		_deprecated_function( __FUNCTION__, '2.4.5', 'Spacious_Customizer_Partials::render_customize_partial_blogdescription()' );

		Spacious_Customizer_Partials::render_customize_partial_blogdescription();

	}

endif;

if ( ! function_exists( 'spacious_retina_logo_option' ) ) :

	/**
	 * Deprecate retina logo active call back  function.
	 */
	function spacious_retina_logo_option() {

		_deprecated_function( __FUNCTION__, '2.4.5' );

	}

endif;


if ( ! function_exists( 'spacious_options' ) ) :

	/**
	 *  Depreciate Spacious theme options function.
	 */
	function spacious_options( $id, $default = false ) {

		_deprecated_function( __FUNCTION__, '2.5.0', 'get_theme_mod' );

		return call_user_func( 'get_theme_mod', $id, $default = false );

	}

endif;
