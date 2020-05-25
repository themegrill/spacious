<?php
/**
 * Spacious Customizer Class
 *
 * @package spacious
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Spacious_Customizer' ) ) :

	/**
	 * Spacious Customizer class
	 */
	class Spacious_Customizer {
		/**
		 * Constructor - Setup customizer
		 */
		public function __construct() {

			add_action( 'customize_register', array( $this, 'spacious_register_panel' ) );
			add_action( 'customize_register', array( $this, 'spacious_customize_register' ) );
			add_action( 'after_setup_theme', array( $this, 'spacious_customize_options' ) );

		}

		/**
		 * Register custom controls
		 *
		 * @param WP_Customize_Manager $wp_customize Manager instance.
		 */
		public function spacious_register_panel( $wp_customize ) {

			// Load customizer options extending classes.
			require get_template_directory() . '/inc/customizer/extend-customizer/class-spacious-customize-section.php';
			require get_template_directory() . '/inc/customizer/extend-customizer/class-spacious-customize-upsell-section.php';

			// Register extended classes.
			$wp_customize->register_section_type( 'Spacious_Customize_Section' );

			// Load base class for controls.
			require_once get_template_directory() . '/inc/customizer/controls/php/class-spacious-customize-base-control.php';
			// Load custom control classes.
			require_once get_template_directory() . '/inc/customizer/controls/php/class-spacious-customize-upsell-control.php';

			// Register JS-rendered control types.
			$wp_customize->register_control_type( 'Spacious_Customize_Upsell_Control' );

		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Manager instance.
		 */
		public function spacious_customize_register( $wp_customize ) {

			// Register panels and sections.
			require get_template_directory() . '/inc/customizer/register-panels-and-sections.php';

		}

		/**
		 * Include customizer options.
		 */
		public function spacious_customize_options() {
			/**
			 * Base class.
			 */
			require get_template_directory() . '/inc/customizer/options/class-spacious-customize-base-option.php';

			/**
			 * Child option classes.
			 */

			require get_template_directory() . '/inc/customizer/options/class-spacious-customize-upsell-option.php';
		}

	}
endif;

new Spacious_Customizer();
