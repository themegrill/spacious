<?php
/**
 * Spacious customizer class for theme customize options.
 *
 * Class Spacious_Customizer
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Include the customizer framework files.
require( dirname( __FILE__ ) . '/core/class-spacious-customizer-framework.php' );
require( dirname( __FILE__ ) . '/core/class-spacious-customize-base-option.php' );

/**
 * Spacious customizer class.
 *
 * Class Spacious_Customizer
 */
class Spacious_Customizer {

	/**
	 * Customizer setup constructor.
	 *
	 * Spacious_Customizer constructor.
	 */
	public function __construct() {

		add_filter( 'spacious_customizer_default_configuration', array(
			$this,
			'customizer_default_configuration'
		), 1 );

		add_filter( 'spacious_customize_datastore_type', array(
			$this,
			'customize_datastore_type'
		), 1 );

		// Include the required files for Customize option.
		add_action( 'customize_register', array( $this, 'customize_register' ), 12 );

		// Include the required files for Customize option.
		add_action( 'customize_register', array( $this, 'customize_options_file_include' ), 1 );

	}

	/**
	 * Include the required files for extending the custom Customize controls.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_register( $wp_customize ) {

		// Override default.
		require SPACIOUS_CUSTOMIZER_DIR . '/override-defaults.php';

	}

	/**
	 * Include the required files for Customize option.
	 */
	public function customize_options_file_include() {

		// Include the required customize section and panels register file.
		require SPACIOUS_CUSTOMIZER_DIR . '/class-spacious-customizer-register-sections-panels.php';

		/**
		 * Include the required customize options file.
		 */
		// Global.
		require SPACIOUS_CUSTOMIZER_DIR . '/options/global/class-spacious-customize-colors-options.php';
		require SPACIOUS_CUSTOMIZER_DIR . '/options/global/class-spacious-customize-background-options.php';
		require SPACIOUS_CUSTOMIZER_DIR . '/options/global/class-spacious-customize-typography-options.php';
		require SPACIOUS_CUSTOMIZER_DIR . '/options/global/class-spacious-customize-layout-options.php';

		// Header.
		require SPACIOUS_CUSTOMIZER_DIR . '/options/header/class-spacious-customize-site-identity-options.php';
		require SPACIOUS_CUSTOMIZER_DIR . '/options/header/class-spacious-customize-header-media-options.php';
		require SPACIOUS_CUSTOMIZER_DIR . '/options/header/class-spacious-customize-header-top-bar-options.php';
		require SPACIOUS_CUSTOMIZER_DIR . '/options/header/class-spacious-customize-primary-header-options.php';
		require SPACIOUS_CUSTOMIZER_DIR . '/options/header/class-spacious-customize-primary-menu-options.php';
		require SPACIOUS_CUSTOMIZER_DIR . '/options/header/class-spacious-customize-header-button.php';

		// Slider.
		require SPACIOUS_CUSTOMIZER_DIR . '/options/slider/class-spacious-customize-slider-options.php';

		// Content.
		require SPACIOUS_CUSTOMIZER_DIR . '/options/content/class-spacious-customize-page-header-options.php';
		require SPACIOUS_CUSTOMIZER_DIR . '/options/content/class-spacious-customize-blog-archive-options.php';
		require SPACIOUS_CUSTOMIZER_DIR . '/options/content/class-spacious-customize-single-post-options.php';
		require SPACIOUS_CUSTOMIZER_DIR . '/options/content/class-spacious-customize-page-options.php';

		// Additional.
		require SPACIOUS_CUSTOMIZER_DIR . '/options/social/class-spacious-customize-social-icons-options.php';

		// Footer.
		require SPACIOUS_CUSTOMIZER_DIR . '/options/footer/class-spacious-customize-footer-widgets-area-options.php';

		// WooCommerce.
		require SPACIOUS_CUSTOMIZER_DIR . '/options/woocommerce/class-spacious-customize-woocommerce-sidebar-options.php';
		require SPACIOUS_CUSTOMIZER_DIR . '/options/woocommerce/class-spacious-customize-woocommerce-design-options.php';
	}

	public function customizer_default_configuration( $default_configuration ) {
		$default_configuration['datastore_type'] = 'option';

		return $default_configuration;
	}

	public function customize_datastore_type() {
		return 'option';
	}

}

return new Spacious_Customizer();
