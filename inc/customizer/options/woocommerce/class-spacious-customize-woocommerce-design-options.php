<?php
/**
 * Class to include Design WooCommerce customize options.
 *
 * Class Spacious_Customize_WooCommerce_Design_Options
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
 * Bail out if `WooCommerce` plugin is not installed and activated.
 */
if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

/**
 * Class to include Design WooCommerce customize options.
 *
 * Class Spacious_Customize_WooCommerce_Design_Options
 */
class Spacious_Customize_WooCommerce_Design_Options extends Spacious_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array $options Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize ) {

		$configs = array(

			array(
				'name'     => 'spacious[woocommerce_cart_icon_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Cart Icon', 'spacious' ),
				'section'  => 'spacious_woocommerce_button_design',
				'priority' => 10,
			),

			array(
				'name'     => 'spacious[spacious_cart_icon]',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to show WooCommerce cart icon on menu bar', 'spacious' ),
				'section'  => 'spacious_woocommerce_button_design',
				'priority' => 20,
			),

			array(
				'name'     => 'spacious[woocommerce_sale_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Sale Design', 'spacious' ),
				'section'  => 'spacious_woocommerce_button_design',
				'priority' => 30,
			),

			array(
				'name'     => 'spacious[spacious_woocommerce_sale_design_setting]',
				'default'  => 'woocommerce-sale-style-default',
				'type'     => 'control',
				'control'  => 'select',
				'label'    => esc_html__( 'Choose the WooCommerce sale batch design.', 'spacious' ),
				'section'  => 'spacious_woocommerce_button_design',
				'choices'  => array(
					'woocommerce-sale-style-default' => esc_html__( 'Default', 'spacious' ),
					'woocommerce-sale-style-1'       => esc_html__( 'Style 1', 'spacious' ),
					'woocommerce-sale-style-2'       => esc_html__( 'Style 2', 'spacious' ),
					'woocommerce-sale-style-3'       => esc_html__( 'Style 3', 'spacious' ),
				),
				'priority' => 40,
			),

			array(
				'name'     => 'spacious[woocommerce_add_to_cart_heading]',
				'type'     => 'control',
				'control'  => 'spacious-title',
				'label'    => esc_html__( 'Add To Cart Design', 'spacious' ),
				'section'  => 'spacious_woocommerce_button_design',
				'priority' => 50,
			),

			array(
				'name'     => 'spacious[spacious_woocommerce_add_to_cart_design_setting]',
				'default'  => 'woocommerce-add-to-cart-default',
				'type'     => 'control',
				'control'  => 'select',
				'label'    => esc_html__( 'Choose the WooCommerce Add to Cart button design.', 'spacious' ),
				'section'  => 'spacious_woocommerce_button_design',
				'choices'  => array(
					'woocommerce-add-to-cart-default' => esc_html__( 'Default', 'spacious' ),
					'woocommerce-add-to-cart-style-1' => esc_html__( 'Style 1', 'spacious' ),
					'woocommerce-add-to-cart-style-2' => esc_html__( 'Style 2', 'spacious' ),
				),
				'priority' => 60,
			),

			array(
				'name'     => 'spacious[spacious_add_to_cart_text_color]',
				'default'  => '#ffffff',
				'type'     => 'control',
				'control'  => 'spacious-color',
				'label'    => esc_html__( 'Text Color', 'spacious' ),
				'section'  => 'spacious_woocommerce_button_design',
				'priority' => 90,
			),

			array(
				'name'     => 'spacious[spacious_add_to_cart_text_hover_color]',
				'default'  => '#515151',
				'type'     => 'control',
				'control'  => 'spacious-color',
				'label'    => esc_html__( 'Text Hover Color', 'spacious' ),
				'section'  => 'spacious_woocommerce_button_design',
				'priority' => 90,
			),

			array(
				'name'       => 'spacious[spacious_add_to_cart_background_color]',
				'default'    => '#0fbe7c',
				'type'       => 'control',
				'control'    => 'spacious-color',
				'label'      => esc_html__( 'Background Color', 'spacious' ),
				'section'    => 'spacious_woocommerce_button_design',
				'dependency' => array(
					'spacious[spacious_woocommerce_add_to_cart_design_setting]',
					'!=',
					'woocommerce-add-to-cart-style-2',
				),
				'priority'   => 100,
			),

			array(
				'name'       => 'spacious[spacious_add_to_cart_background_hover_color]',
				'default'    => '#0fbe7c',
				'type'       => 'control',
				'control'    => 'spacious-color',
				'label'      => esc_html__( 'Background Hover Color', 'spacious' ),
				'section'    => 'spacious_woocommerce_button_design',
				'dependency' => array(
					'spacious[spacious_woocommerce_add_to_cart_design_setting]',
					'!=',
					'woocommerce-add-to-cart-style-2',
				),
				'priority'   => 110,
			),

			array(
				'name'       => 'spacious[spacious_add_to_cart_border_color]',
				'default'    => '#0fbe7c',
				'type'       => 'control',
				'control'    => 'spacious-color',
				'label'      => esc_html__( 'Border Color', 'spacious' ),
				'section'    => 'spacious_woocommerce_button_design',
				'priority'   => 120,
			),

			array(
				'name'       => 'spacious[spacious_add_to_cart_border_hover_color]',
				'default'    => '#0fbe7c',
				'type'       => 'control',
				'control'    => 'spacious-color',
				'label'      => esc_html__( 'Border Hover Color', 'spacious' ),
				'section'    => 'spacious_woocommerce_button_design',
				'priority'   => 130,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}
}

return new Spacious_Customize_WooCommerce_Design_Options();
