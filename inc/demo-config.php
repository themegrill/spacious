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

add_filter( 'themegrill_demo_importer_config', 'spacious_demo_importer_config' );

/**
 * Setup demo importer config.
 *
 * @param  array $demo_config
 * @return array
 */
function spacious_demo_importer_config( $demo_config ) {
	$new_demo_config = array(
		'spacious-free' => array(
			'name'         => __( 'Spacious', 'spacious' ),
			'demo_url'     => 'http://demo.themegrill.com/spacious/',
			'demo_pack'    => true,
			'core_options' => array(
				'blogname'       => 'Spacious',
				'page_on_front'  => 'Business Template',
				'page_for_posts' => 'Blog',
			),
			'widgets_data_update' => array(

				/**
				 * Dropdown Pages - Handles widgets Page ID.
				 *
				 * 1. spacious_service_widget
				 * 2. spacious_featured_single_page_widget
				 * 3. spacious_recent_work_widget
				 */
				'dropdown_pages' => array(
					'spacious_service_widget' => array(
						2 => array(
							'page_id0' => 'Super Fast Loading',
							'page_id1' => 'Responsive Design',
							'page_id2' => 'Awesome Support',
						),
					),
					'spacious_featured_single_page_widget' => array(
						2 => array(
							'page_id' => 'Just Arrived',
						),
					),
					'spacious_recent_work_widget' => array(
						2 => array(
							'page_id0' => 'Recent Work Skateboard',
							'page_id1' => 'Recent Work Spectacle',
							'page_id2' => 'Recent Work Camera',
						),
					),
				),
			),
			'customizer_data_update' => array(
				'nav_menu_locations' => array(
					'primary'   => 'Primary',
					'footer'    => 'Footer Menu',
				),
			),
			'plugins_list' => array(
				'recommended' => array(
					'woocommerce' => array(
						'name' => __( 'WooCommerce', 'spacious' ),
						'slug' => 'woocommerce/woocommerce.php',
					),
					'recent-posts-widget-extended' => array(
						'name' => __( 'Recent Posts Widget Extended', 'spacious' ),
						'slug' => 'recent-posts-widget-extended/rpwe.php',
					),
				),
			),
		),
	);

	return array_merge( $new_demo_config, $demo_config );
}
