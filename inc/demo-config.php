<?php
/**
 * Functions for configuring demo importer.
 *
 * @package Importer/Functions
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Setup demo importer config.
 *
 * @deprecated 1.5.0
 *
 * @param  array $demo_config Demo config.
 *
 * @return array
 */
/**
 * Setup demo importer packages.
 *
 * @param  array $packages
 *
 * @return array
 */
function spacious_demo_importer_packages( $packages ) {
	$new_packages = array(
		'spacious-free' => array(
			'name'    => __( 'Spacious', 'spacious' ),
			'preview' => 'http://demo.themegrill.com/spacious/',
		),
		'spacious-blog' => array(
			'name'    => __( 'Spacious Blog', 'spacious' ),
			'preview' => 'http://demo.themegrill.com/spacious-blog/',
		),
	);

	return array_merge( $new_packages, $packages );
}

add_filter( 'themegrill_demo_importer_packages', 'spacious_demo_importer_packages' );
