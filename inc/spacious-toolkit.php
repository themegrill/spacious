<?php
/**
 * Adds new widgets and compatibility for the Elementor plugin in Spacious theme.
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 1.5
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
	 * Get suffix for library files
	 *
	 * @var string
	 */
	private $suffix;

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

		// Assign suffix for library files
		$this->suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		// Enqueue style for Elementor front-end
		add_action( 'elementor/frontend/after_enqueue_styles', array( $this, 'spacious_elementor_styles' ) );

		// Enqueue scripts for Elementor front-end
		add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'spacious_elementor_enqueue_scripts' ) );

		// Register scripts for Elementor front-end
		add_action( 'elementor/frontend/before_register_scripts', array(
			$this,
			'spacious_elementor_register_scripts'
		) );

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
		wp_enqueue_script( 'elementor-custom', SPACIOUS_JS_URL . '/elementor-custom.js', array( 'jquery' ), false, true );
	}

	/**
	 * Register script for Elementor frontends
	 */
	public function spacious_elementor_register_scripts() {
		wp_register_script( 'jquery-waypoints', SPACIOUS_JS_URL . '/waypoints' . $this->suffix . '.js', array( 'jquery' ), '2.0.3', true );
		wp_register_script( 'jquery-countTo', SPACIOUS_JS_URL . '/jquery.countTo' . $this->suffix . '.js', array( 'jquery' ), false, true );
	}

}

new Spacious_Elementor_Addons();
