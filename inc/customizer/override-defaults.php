<?php
/**
 * Override default customizer panels, sections, settings or controls.
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 1.9.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Override Sections.
 */
// Header media section.
$wp_customize->get_section( 'header_image' )->panel    = 'spacious_header_panel';
$wp_customize->get_section( 'header_image' )->priority = 15;

/**
 * Override controls.
 */
// Outside container > background control.
$wp_customize->get_control( 'background_color' )->section  = 'spacious_global_background_section';
$wp_customize->get_control( 'background_color' )->type     = 'spacious-color';
$wp_customize->get_control( 'background_color' )->priority = 20;

$wp_customize->get_control( 'background_image' )->section  = 'spacious_global_background_section';
$wp_customize->get_control( 'background_image' )->priority = 25;

$wp_customize->get_control( 'background_preset' )->section  = 'spacious_global_background_section';
$wp_customize->get_control( 'background_preset' )->priority = 30;

$wp_customize->get_control( 'background_position' )->section  = 'spacious_global_background_section';
$wp_customize->get_control( 'background_position' )->priority = 35;

$wp_customize->get_control( 'background_size' )->section  = 'spacious_global_background_section';
$wp_customize->get_control( 'background_size' )->priority = 40;

$wp_customize->get_control( 'background_repeat' )->section  = 'spacious_global_background_section';
$wp_customize->get_control( 'background_repeat' )->priority = 45;

$wp_customize->get_control( 'background_attachment' )->section  = 'spacious_global_background_section';
$wp_customize->get_control( 'background_attachment' )->priority = 50;

// Site Identity.
$wp_customize->get_control( 'custom_logo' )->priority     = 6;
$wp_customize->get_control( 'site_icon' )->priority       = 9;
$wp_customize->get_control( 'blogname' )->priority        = 10;
$wp_customize->get_control( 'blogdescription' )->priority = 14;

$wp_customize->get_setting( 'header_textcolor' )->transport = 'refresh';
$wp_customize->get_control( 'header_textcolor' )->section   = 'title_tagline';
$wp_customize->get_control( 'header_textcolor' )->type      = 'spacious-color';
$wp_customize->get_control( 'header_textcolor' )->priority  = 20;

// Header media options.
$wp_customize->get_section( 'header_image' )->panel    = 'spacious_header_options';
$wp_customize->get_section( 'header_image' )->priority = 2;

// Override Settings.
$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector'        => '#site-title a',
			'render_callback' => array(
				'Spacious_Customizer_Partials',
				'render_customize_partial_blogname',
			),
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector'        => '#site-description',
			'render_callback' => array(
				'Spacious_Customizer_Partials',
				'render_customize_partial_blogdescription',
			),
		)
	);
}

/*
 * Modify WooCommerce default section priorities
*/
if ( class_exists( 'WooCommerce' ) ) {
	$wp_customize->get_panel( 'woocommerce' )->priority = 70;
}
