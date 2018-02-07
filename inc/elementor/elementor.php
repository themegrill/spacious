<?php
add_action( 'wp_enqueue_scripts', 'spacious_elementor_scripts_styles_method' );

function spacious_elementor_scripts_styles_method() {
	/**
	 * Register scripts for elementor widgets
	 */
	wp_register_script( 'jquery-waypoints', SPACIOUS_JS_URL . '/waypoints.min.js', array( 'jquery' ), '2.0.3', true );
	wp_register_script( 'jquery-countTo', SPACIOUS_JS_URL . '/jquery.countTo.min.js', array( 'jquery' ), false, true );
	wp_register_script( 'elementor-custom', SPACIOUS_JS_URL . '/elementor-custom.js', array( 'jquery' ), false, true );
}