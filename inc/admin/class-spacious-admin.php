<?php
/**
 * Spacious Admin Class.
 *
 * @author  ThemeGrill
 * @package Spacious
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Spacious_Admin' ) ) :

	/**
	 * Spacious_Admin Class.
	 */
	class Spacious_Admin {

		/**
		 * Constructor.
		 */
		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		/**
		 * Localize array for import button AJAX request.
		 */
		public function enqueue_scripts() {
			wp_enqueue_style( 'spacious-admin-style', get_template_directory_uri() . '/inc/admin/css/admin.css', array(), SPACIOUS_THEME_VERSION );

			wp_enqueue_script( 'spacious-plugin-install-helper', get_template_directory_uri() . '/inc/admin/js/plugin-handle.js', array( 'jquery' ), SPACIOUS_THEME_VERSION, true );

			$welcome_data = array(
				'uri'      => esc_url( admin_url( '/themes.php?page=demo-importer&browse=all&spacious-hide-notice=welcome' ) ),
				'btn_text' => esc_html__( 'Processing...', 'spacious' ),
				'nonce'    => wp_create_nonce( 'spacious_demo_import_nonce' ),
			);

			wp_localize_script( 'spacious-plugin-install-helper', 'spaciousRedirectDemoPage', $welcome_data );
		}
	}

endif;

return new Spacious_Admin();
