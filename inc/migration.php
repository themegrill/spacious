<?php
/**
 * Migration scripts for Spacious theme.
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
 * Migrate all of the customize options for 3.0.0 theme update.
 *
 * @since Spacious 3.0.0
 */
function spacious_major_controls_migrate() {

	if ( get_option( 'spacious_major_controls_migrate' ) ) {
		return;
	}

	// Get theme options.
	$spacious_theme_options = get_option( 'spacious' );

	// Base heading.
	$spacious_content_font = get_theme_mod( 'spacious_content_font', 'Lato' );
	// All heading
	$spacious_titles_font     = get_theme_mod( 'spacious_titles_font', 'Lato' );

	if ( 'Lato' !== $spacious_content_font ) {
		$spacious_theme_options['spacious_content_font_typography'] = array(
			'font-family' => $spacious_content_font,
		);
	}

	if ( 'Lato' !== $spacious_titles_font ) {
		$spacious_theme_options['spacious_titles_font_typography'] = array(
			'font-family' => $spacious_titles_font,
		);
	}

	// Delete options data.
	$spacious_remove_theme_options = array(
		'spacious_content_font',
		'spacious_titles_font',
	);

	foreach ( $spacious_remove_theme_options as $spacious_remove_theme_option ) {
		unset( $spacious_theme_options[ $spacious_remove_theme_option ] );
	}

	// Finally, update spacious theme options.
	update_option( 'spacious', $spacious_theme_options );

	// Set a flag.
	update_option( 'spacious_major_controls_migrate', 1 );
}

add_action( 'after_setup_theme', 'spacious_major_controls_migrate' );


if ( ! function_exists( 'spacious_options_migrate' ) ) :
	/**
	 * Migrate Options Framework data to Customizer
	 *
	 */
	function spacious_options_migrate() {

		// Shifting Users data from Theme Option to Customizer
		if ( get_option( 'spacious_customizer_transfer' ) ) {
			return;
		}

		// Set transfer
		update_option( 'spacious_customizer_transfer', 1 );

		$spacious_themename      = get_option( 'stylesheet' );
		$spacious_themename_preg = preg_replace( '/\W/', '_', strtolower( $spacious_themename ) );
		if ( false === ( $mods = get_option( $spacious_themename_preg ) ) ) {
			return;
		}

		$spacious_theme_options = array();
		$spacious_theme_mods    = array();

		// When child theme is active.
		if ( is_child_theme() ) {
			$spacious_theme_options = get_option( $spacious_themename_preg );
			$spacious_theme_mods    = get_theme_mods();

			foreach ( $spacious_theme_options as $key => $value ) {
				$spacious_theme_mods[ $key ] = $value;
			}
			update_option( 'theme_mods_' . $spacious_themename, $spacious_theme_mods );
		}
		// For parent theme data Transfer
		if ( false !== ( $mods = get_option( 'spacious' ) ) ) {
			$spacious_theme_options = get_option( 'spacious' );
			$spacious_theme_mods    = get_option( 'theme_mods_spacious' );

			foreach ( $spacious_theme_options as $key => $value ) {
				$spacious_theme_mods[ $key ] = $value;
			}

			update_option( 'theme_mods_spacious', $spacious_theme_mods );
		}
	}
endif;

add_action( 'after_setup_theme', 'spacious_options_migrate', 12 );
