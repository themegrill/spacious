<?php
/**
 * Functions for configuring demo importer.
 *
 * @package Importer/Functions
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Setup demo importer packages.
 *
 * @deprecated 1.5.0
 *
 * @param  array $packages Demo packages.
 *
 * @return array
 */
function spacious_demo_importer_packages( $packages ) {
	$new_packages = array(
		'spacious-free'         => array(
			'name'    => __( 'Spacious', 'spacious' ),
			'preview' => 'http://demo.themegrill.com/spacious/',
		),
		'spacious-blog'         => array(
			'name'    => __( 'Spacious Blog', 'spacious' ),
			'preview' => 'http://demo.themegrill.com/spacious-blog/',
		),
		'spacious-pro'          => array(
			'name'     => __( 'Spacious Pro', 'spacious' ),
			'preview'  => 'http://demo.themegrill.com/spacious-pro/',
			'pro_link' => 'https://themegrill.com/themes/spacious/',
		),
		'spacious-pro-business' => array(
			'name'     => __( 'Spacious Pro Business', 'spacious' ),
			'preview'  => 'http://demo.themegrill.com/spacious-pro-business/',
			'pro_link' => 'https://themegrill.com/themes/spacious/',
		),

	);

	return array_merge( $new_packages, $packages );
}

add_filter( 'themegrill_demo_importer_packages', 'spacious_demo_importer_packages' );
