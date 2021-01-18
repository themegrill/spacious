<?php
/**
 * Spacious customizer class for theme customize options.
 *
 * Class Spacious_Customizer
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 1.9.0
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
	public function customize_custom_panels_sections_includes( $wp_customize ) {

		// Include the required customizer nested panels and sections files.
		require SPACIOUS_CUSTOMIZER_DIR . '/extend-customizer/class-spacious-upsell-section.php';

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
	 * Register Spacious customize panels, sections and controls type.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function register_panels_sections_controls( $wp_customize ) {

		// Register panels and sections.
		$wp_customize->register_panel_type( 'Spacious_WP_Customize_Panel' );
		$wp_customize->register_section_type( 'Spacious_WP_Customize_Section' );
		$wp_customize->register_section_type( 'Spacious_Upsell_Section' );

		/**
		 * Register controls.
		 */
		/**
		 * WordPress default controls.
		 */
		// Checkbox control.
		Spacious_Customize_Base_Control::add_control(
			'checkbox',
			array(
				'sanitize_callback' => array(
					'Spacious_Customizer_Sanitizes',
					'sanitize_checkbox',
				),
			)
		);

		// Radio control.
		Spacious_Customize_Base_Control::add_control(
			'radio',
			array(
				'sanitize_callback' => array(
					'Spacious_Customizer_Sanitizes',
					'sanitize_radio_select',
				),
			)
		);

		// Select control.
		Spacious_Customize_Base_Control::add_control(
			'select',
			array(
				'sanitize_callback' => array(
					'Spacious_Customizer_Sanitizes',
					'sanitize_radio_select',
				),
			)
		);

		// Text control.
		Spacious_Customize_Base_Control::add_control(
			'text',
			array(
				'sanitize_callback' => array(
					'Spacious_Customizer_Sanitizes',
					'sanitize_nohtml',
				),
			)
		);

		// Number control.
		Spacious_Customize_Base_Control::add_control(
			'number',
			array(
				'sanitize_callback' => array(
					'Spacious_Customizer_Sanitizes',
					'sanitize_number',
				),
			)
		);

		// Email control.
		Spacious_Customize_Base_Control::add_control(
			'email',
			array(
				'sanitize_callback' => array(
					'Spacious_Customizer_Sanitizes',
					'sanitize_email',
				),
			)
		);

		// URL control.
		Spacious_Customize_Base_Control::add_control(
			'url',
			array(
				'sanitize_callback' => array(
					'Spacious_Customizer_Sanitizes',
					'sanitize_url',
				),
			)
		);

		// Textarea control.
		Spacious_Customize_Base_Control::add_control(
			'textarea',
			array(
				'sanitize_callback' => array(
					'Spacious_Customizer_Sanitizes',
					'sanitize_html',
				),
			)
		);

		// Dropdown pages control.
		Spacious_Customize_Base_Control::add_control(
			'dropdown-pages',
			array(
				'sanitize_callback' => array(
					'Spacious_Customizer_Sanitizes',
					'sanitize_dropdown_pages',
				),
			)
		);

		// Color control.
		Spacious_Customize_Base_Control::add_control(
			'color',
			array(
				'callback'          => 'WP_Customize_Color_Control',
				'sanitize_callback' => array(
					'Spacious_Customizer_Sanitizes',
					'sanitize_hex_color',
				),
			)
		);

		// Image upload control.
		Spacious_Customize_Base_Control::add_control(
			'image',
			array(
				'callback'          => 'WP_Customize_Image_Control',
				'sanitize_callback' => array(
					'Spacious_Customizer_Sanitizes',
					'sanitize_image_upload',
				),
			)
		);

		// Radio image control.
		Spacious_Customize_Base_Control::add_control(
			'spacious-radio-image',
			array(
				'callback'          => 'Spacious_Radio_Image_Control',
				'sanitize_callback' => array(
					'Spacious_Customizer_Sanitizes',
					'sanitize_radio_select',
				),
			)
		);

		// Heading control.
		Spacious_Customize_Base_Control::add_control(
			'spacious-heading',
			array(
				'callback'          => 'Spacious_Heading_Control',
				'sanitize_callback' => array(
					'Spacious_Customizer_Sanitizes',
					'sanitize_false_values',
				),
			)
		);

		// Editor control.
		Spacious_Customize_Base_Control::add_control(
			'spacious-editor',
			array(
				'callback'          => 'Spacious_Editor_Control',
				'sanitize_callback' => array(
					'Spacious_Customizer_Sanitizes',
					'sanitize_html',
				),
			)
		);

		// Color control.
		Spacious_Customize_Base_Control::add_control(
			'spacious-color',
			array(
				'callback'          => 'Spacious_Color_Control',
				'sanitize_callback' => array(
					'Spacious_Customizer_Sanitizes',
					'sanitize_alpha_color',
				),
			)
		);

		// Buttonset control.
		Spacious_Customize_Base_Control::add_control(
			'spacious-buttonset',
			array(
				'callback'          => 'Spacious_Buttonset_Control',
				'sanitize_callback' => array(
					'Spacious_Customizer_Sanitizes',
					'sanitize_radio_select',
				),
			)
		);

		// Toggle control.
		Spacious_Customize_Base_Control::add_control(
			'spacious-toggle',
			array(
				'callback'          => 'Spacious_Toggle_Control',
				'sanitize_callback' => array(
					'Spacious_Customizer_Sanitizes',
					'sanitize_checkbox',
				),
			)
		);

		// Divider control.
		Spacious_Customize_Base_Control::add_control(
			'spacious-divider',
			array(
				'callback'          => 'Spacious_Divider_Control',
				'sanitize_callback' => array(
					'Spacious_Customizer_Sanitizes',
					'sanitize_false_values',
				),
			)
		);

		// Slider control.
		Spacious_Customize_Base_Control::add_control(
			'spacious-slider',
			array(
				'callback'          => 'Spacious_Slider_Control',
				'sanitize_callback' => array(
					'Spacious_Customizer_Sanitizes',
					'sanitize_number',
				),
			)
		);

		// Custom control.
		Spacious_Customize_Base_Control::add_control(
			'spacious-custom',
			array(
				'callback'          => 'Spacious_Custom_Control',
				'sanitize_callback' => array(
					'Spacious_Customizer_Sanitizes',
					'sanitize_false_values',
				),
			)
		);

		// Dropdown categories control.
		Spacious_Customize_Base_Control::add_control(
			'spacious-dropdown-categories',
			array(
				'callback'          => 'Spacious_Dropdown_Categories_Control',
				'sanitize_callback' => array(
					'Spacious_Customizer_Sanitizes',
					'sanitize_dropdown_categories',
				),
			)
		);

		// Background control.
		Spacious_Customize_Base_Control::add_control(
			'spacious-background',
			array(
				'callback'          => 'Spacious_Background_Control',
				'sanitize_callback' => array(
					'Spacious_Customizer_Sanitizes',
					'sanitize_background',
				),
			)
		);

		// Typography control.
		Spacious_Customize_Base_Control::add_control(
			'spacious-typography',
			array(
				'callback'          => 'Spacious_Typography_Control',
				'sanitize_callback' => array(
					'Spacious_Customizer_Sanitizes',
					'sanitize_typography',
				),
			)
		);

		// Hidden control.
		Spacious_Customize_Base_Control::add_control(
			'spacious-hidden',
			array(
				'callback'          => 'Spacious_Hidden_Control',
				'sanitize_callback' => '',
			)
		);

		// Sortable control.
		Spacious_Customize_Base_Control::add_control(
			'spacious-sortable',
			array(
				'callback'          => 'Spacious_Sortable_Control',
				'sanitize_callback' => array(
					'Spacious_Customizer_Sanitizes',
					'sanitize_sortable',
				),
			)
		);

		// Group control.
		Spacious_Customize_Base_Control::add_control(
			'spacious-group',
			array(
				'callback' => 'Spacious_Group_Control',
			)
		);

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

}

return new Spacious_Customizer();
