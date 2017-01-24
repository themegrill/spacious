<?php
/**
 * Functions for configuring demo importer.
 *
 * @author   ThemeGrill
 * @category Admin
 * @package  Importer/Functions
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Setup demo importer packages.
 *
 * @param  array $packages
 * @return array
 */
function spacious_demo_importer_packages( $packages ) {
	$new_packages = array(
		'spacious-free' => array(
			'name'    => __( 'Spacious', 'spacious' ),
			'preview' => 'http://demo.themegrill.com/spacious/',
		),
	);

	return array_merge( $new_packages, $packages );
}
add_filter( 'themegrill_demo_importer_packages', 'spacious_demo_importer_packages' );
