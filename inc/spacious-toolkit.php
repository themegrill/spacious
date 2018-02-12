<?php
/**
 * Adds new widgets and compatibility for the Elementor plugin in Spacious theme.
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 1.4.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Spacious_Elementor_Addons {

	/**
	 * A reference to an instance of this class.
	 */
	private static $instance;

	/**
	 * Returns an instance of this class.
	 */
	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new Spacious_Elementor_Addons();
		}

		return self::$instance;

	}

	/**
	 * Initializes the plugin by setting filters and administration functions.
	 */
	public function __construct() {

		// Enqueue style for Elementor front-end
		add_action( 'elementor/frontend/after_enqueue_styles', array( $this, 'spacious_elementor_styles' ) );

		// Enqueue scripts for Elementor front-end
		add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'spacious_elementor_enqueue_scripts' ) );

		// Enqueue styles for Elementor editor
		add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'spacious_elementor_enqueue_editor_styles' ) );

	}

	/**
	 * Enqueue styles for Elementor frontends
	 */
	public function spacious_elementor_styles() {
		// Enqueue the main Elementor CSS file for use with Elementor.
		wp_enqueue_style( 'spacious-elementor', get_template_directory_uri() . '/inc/elementor/assets/css/elementor.css' );
	}

	/**
	 * Enqueue scripts for Elementor frontends
	 */
	public function spacious_elementor_enqueue_scripts() {

	}

	/**
	 * Enqueue styles for Elementor editor
	 */
	public function spacious_elementor_enqueue_editor_styles() {

	}

}

new Spacious_Elementor_Addons();
