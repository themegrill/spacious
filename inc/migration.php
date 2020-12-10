<?php
/**
 * Migration scripts for Spacious theme.
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
 * Migrate all of the customize options for 3.0.0 theme update.
 *
 * @since Spacious 3.0.0
 */
function spacious_major_controls_migrate() {

	if ( get_option( 'spacious_major_controls_migrate' ) ) {
		return;
	}

	// Get theme options.
	$spacious_theme_options = get_option( 'spacious' );

	// Base heading.
	$spacious_content_font = get_theme_mod( 'spacious_content_font', 'Lato' );
	// All heading
	$spacious_titles_font     = get_theme_mod( 'spacious_titles_font', 'Lato' );
	$site_title_font_family   = get_theme_mod( 'spacious_site_title_font', 'Lato' );
	$site_title_font_size     = get_theme_mod( 'spacious_site_title_font_size', '36' );
	$site_tagline_font_family = get_theme_mod( 'spacious_site_tagline_font', 'Lato' );
	$site_tagline_font_size   = get_theme_mod( 'spacious_tagline_font_size', '16' );

	// Header top info.
	$small_info_text_size        = get_theme_mod( 'spacious_small_info_text_size', '12' );
	$small_header_menu_font_size = get_theme_mod( 'spacious_small_header_menu_font_size', '12' );


	// Primary menu.
	$menu_font_family           = get_theme_mod( 'spacious_menu_font', 'Lato' );
	$primary_menu_font_size     = get_theme_mod( 'spacious_primary_menu_font_size', '16' );
	$primary_sub_menu_font_size = get_theme_mod( 'spacious_primary_sub_menu_font_size', '13' );

	// Page header.
	$title_font_size                          = get_theme_mod( 'spacious_title_font_size', '22' );
	$breadcrumb_text_font_size                = get_theme_mod( 'spacious_breadcrumb_text_font_size', '12' );

	$header_title_background_image            = get_theme_mod( 'spacious_header_title_background_image', '' );
	$header_title_background_image_position   = get_theme_mod( 'spacious_header_title_background_image_position', 'center-center' );
	$header_title_background_image_size       = get_theme_mod( 'spacious_header_title_background_image_size', 'auto' );
	$header_title_background_image_attachment = get_theme_mod( 'spacious_header_title_background_image_attachment', 'scroll' );
	$header_title_background_image_repeat     = get_theme_mod( 'spacious_header_title_background_image_repeat', 'repeat' );

	// Post meta.
	$post_meta_font_size          = get_theme_mod( 'spacious_post_meta_font_size', '14' );
	$post_meta_readmore_font_size = get_theme_mod( 'spacious_read_more_font_size', '14' );

	// Sitcky content and sidebar Widget title.
	$widget_title_font_size = get_theme_mod( 'spacious_widget_title_font_size', '22' );

	// Comment.
	$comment_title_font_size   = get_theme_mod( 'spacious_comment_title_font_size', '26' );
	$comment_content_font_size = get_theme_mod( 'spacious_content_font_size', '16' );

	// TG: Widgets.
	$call_to_action_title_font_size  = get_theme_mod( 'spacious_call_to_action_title_font_size', '22' );
	$call_to_action_button_font_size = get_theme_mod( 'spacious_call_to_action_button_font_size', '26' );
	$archive_title_font_size         = get_theme_mod( 'spacious_archive_title_font_size', '24' );
	$client_widget_title_font_size   = get_theme_mod( 'spacious_client_widget_title_font_size', '30' );

	// Slider.
	$slider_title_font_size   = get_theme_mod( 'spacious_slider_title_font_size', '26' );
	$slider_content_font_size = get_theme_mod( 'spacious_slider_content_font_size', '16' );
	$slider_button_font_size  = get_theme_mod( 'spacious_slider_button_font_size', '20' );

	// Footer
	$footer_widget_title_font_size   = get_theme_mod( 'spacious_footer_widget_title_font_size', '22' );
	$footer_widget_content_font_size = get_theme_mod( 'spacious_footer_widget_content_font_size', '14' );

	// Footer bottom bar.
	$footer_copyright_text_font_size = get_theme_mod( 'spacious_footer_copyright_text_font_size', '12' );
	$small_footer_menu_font_size     = get_theme_mod( 'spacious_small_footer_menu_font_size', '12' );

	$spacious_footer_background_image            = get_theme_mod( 'spacious_footer_background_image', '' );
	$spacious_footer_background_image_position   = get_theme_mod( 'spacious_footer_background_image_position', 'center-center' );
	$spacious_footer_background_image_size       = get_theme_mod( 'spacious_footer_background_image_size', 'auto' );
	$spacious_footer_background_image_attachment = get_theme_mod( 'spacious_footer_background_image_attachment', 'scroll' );
	$spacious_footer_background_image_repeat     = get_theme_mod( 'spacious_footer_background_image_repeat', 'repeat' );


	if ( 'Lato' !== $spacious_content_font ) {
		$spacious_theme_options['spacious_content_font_typography'] = array(
			'font-family' => $spacious_content_font,
		);
	}

	if ( 'Lato' !== $spacious_titles_font ) {
		$spacious_theme_options['spacious_titles_font_typography'] = array(
			'font-family' => $spacious_titles_font,
		);
	}

	if ( 'Lato' !== $site_title_font_family || '36' !== $site_title_font_size ) {
		$spacious_theme_options['spacious_site_title_font_typography'] = array(
			'font-family' => $site_title_font_family,
			'font-size'   => array(
				'desktop' => $site_title_font_size,
				'tablet'  => '',
				'mobile'  => '',
			),
		);
	}

	if ( 'Lato' !== $site_tagline_font_family || '16' !== $site_tagline_font_size ) {
		$spacious_theme_options['spacious_site_tagline_font_typography'] = array(
			'font-family' => $site_tagline_font_family,
			'font-size'   => array(
				'desktop' => $site_tagline_font_size,
				'tablet'  => '',
				'mobile'  => '',
			),
		);
	}

	if ( '12' !== $small_info_text_size ) {
		$spacious_theme_options['spacious_small_info_text_size_typography'] = array(
			'font-size' => array(
				'desktop' => $small_info_text_size,
				'tablet'  => '',
				'mobile'  => '',
			),
		);
	}

	if ( '12' !== $small_header_menu_font_size ) {
		$spacious_theme_options['spacious_small_header_menu_font_size_typography'] = array(
			'font-size' => array(
				'desktop' => $small_header_menu_font_size,
				'tablet'  => '',
				'mobile'  => '',
			),
		);
	}

	if ( '16' !== $primary_menu_font_size || 'Lato' !== $menu_font_family ) {
		$spacious_theme_options['spacious_primary_menu_font_typography'] = array(
			'font-family' => $menu_font_family,
			'font-size'   => array(
				'desktop' => $primary_menu_font_size,
				'tablet'  => '',
				'mobile'  => '',
			),
		);
	}

	if ( '13' !== $primary_sub_menu_font_size ) {
		$spacious_theme_options['spacious_primary_sub_menu_font_size_typography'] = array(
			'font-size' => array(
				'desktop' => $primary_sub_menu_font_size,
				'tablet'  => '',
				'mobile'  => '',
			),
		);
	}

	if ( '22' !== $title_font_size ) {
		$spacious_theme_options['spacious_title_font_size_typography'] = array(
			'font-size' => array(
				'desktop' => $title_font_size,
				'tablet'  => '',
				'mobile'  => '',
			),
		);
	}

	if ( '12' !== $breadcrumb_text_font_size ) {
		$spacious_theme_options['spacious_breadcrumb_text_font_size_typography'] = array(
			'font-size' => array(
				'desktop' => $breadcrumb_text_font_size,
				'tablet'  => '',
				'mobile'  => '',
			),
		);
	}

	if ( '' !== $header_title_background_image || 'center-center' !== $header_title_background_image_position || 'auto' !== $header_title_background_image_size || 'scroll' !== $header_title_background_image_attachment || 'repeat' !== $header_title_background_image_repeat ) {
		$spacious_theme_options['spacious_header_title_background_option'] = array(
			'background-image'      => $header_title_background_image,
			'background-position'   => str_replace( '-', ' ', $header_title_background_image_position ),
			'background-size'       => $header_title_background_image_size,
			'background-attachment' => $header_title_background_image_attachment,
			'background-repeat'     => $header_title_background_image_repeat,
		);
	}

	if ( '14' !== $post_meta_font_size ) {
		$spacious_theme_options['spacious_post_meta_font_size_typography'] = array(
			'font-size' => array(
				'desktop' => $post_meta_font_size,
				'tablet'  => '',
				'mobile'  => '',
			),
		);
	}

	if ( '14' !== $post_meta_readmore_font_size ) {
		$spacious_theme_options['spacious_read_more_font_size_typography'] = array(
			'font-size' => array(
				'desktop' => $post_meta_readmore_font_size,
				'tablet'  => '',
				'mobile'  => '',
			),
		);
	}

	if ( '22' !== $widget_title_font_size ) {
		$spacious_theme_options['spacious_widget_title_font_size_typography'] = array(
			'font-size' => array(
				'desktop' => $widget_title_font_size,
				'tablet'  => '',
				'mobile'  => '',
			),
		);
	}

	if ( '26' !== $comment_title_font_size ) {
		$spacious_theme_options['spacious_comment_title_font_size_typography'] = array(
			'font-size' => array(
				'desktop' => $comment_title_font_size,
				'tablet'  => '',
				'mobile'  => '',
			),
		);
	}

	if ( '16' !== $comment_content_font_size ) {
		$spacious_theme_options['spacious_content_font_size_typography'] = array(
			'font-size' => array(
				'desktop' => $comment_content_font_size,
				'tablet'  => '',
				'mobile'  => '',
			),
		);
	}

	if ( '22' !== $call_to_action_title_font_size ) {
		$spacious_theme_options['spacious_call_to_action_title_font_size_typography'] = array(
			'font-size' => array(
				'desktop' => $call_to_action_title_font_size,
				'tablet'  => '',
				'mobile'  => '',
			),
		);
	}

	if ( '26' !== $call_to_action_button_font_size ) {
		$spacious_theme_options['spacious_call_to_action_button_font_size_typography'] = array(
			'font-size' => array(
				'desktop' => $call_to_action_button_font_size,
				'tablet'  => '',
				'mobile'  => '',
			),
		);
	}

	if ( '24' !== $archive_title_font_size ) {
		$spacious_theme_options['spacious_archive_title_font_size_typography'] = array(
			'font-size' => array(
				'desktop' => $archive_title_font_size,
				'tablet'  => '',
				'mobile'  => '',
			),
		);
	}

	if ( '30' !== $client_widget_title_font_size ) {
		$spacious_theme_options['spacious_client_widget_title_font_size_typography'] = array(
			'font-size' => array(
				'desktop' => $client_widget_title_font_size,
				'tablet'  => '',
				'mobile'  => '',
			),
		);
	}

	if ( '26' !== $slider_title_font_size ) {
		$spacious_theme_options['spacious_slider_title_font_size_typography'] = array(
			'font-size' => array(
				'desktop' => $slider_title_font_size,
				'tablet'  => '',
				'mobile'  => '',
			),
		);
	}

	if ( '16' !== $slider_content_font_size ) {
		$spacious_theme_options['spacious_slider_content_font_size_typography'] = array(
			'font-size' => array(
				'desktop' => $slider_content_font_size,
				'tablet'  => '',
				'mobile'  => '',
			),
		);
	}

	if ( '20' !== $slider_button_font_size ) {
		$spacious_theme_options['spacious_slider_button_font_size_typography'] = array(
			'font-size' => array(
				'desktop' => $slider_button_font_size,
				'tablet'  => '',
				'mobile'  => '',
			),
		);
	}

	if ( '22' !== $footer_widget_title_font_size ) {
		$spacious_theme_options['spacious_footer_widget_title_font_size_typography'] = array(
			'font-size' => array(
				'desktop' => $footer_widget_title_font_size,
				'tablet'  => '',
				'mobile'  => '',
			),
		);
	}

	if ( '14' !== $footer_widget_content_font_size ) {
		$spacious_theme_options['spacious_footer_widget_content_font_size_typography'] = array(
			'font-size' => array(
				'desktop' => $footer_widget_content_font_size,
				'tablet'  => '',
				'mobile'  => '',
			),
		);
	}

	if ( '12' !== $footer_copyright_text_font_size ) {
		$spacious_theme_options['spacious_footer_copyright_text_font_size_typography'] = array(
			'font-size' => array(
				'desktop' => $footer_copyright_text_font_size,
				'tablet'  => '',
				'mobile'  => '',
			),
		);
	}

	if ( '12' !== $small_footer_menu_font_size ) {
		$spacious_theme_options['spacious_small_footer_menu_font_size_typography'] = array(
			'font-size' => array(
				'desktop' => $small_footer_menu_font_size,
				'tablet'  => '',
				'mobile'  => '',
			),
		);
	}


	if ( '' !== $spacious_footer_background_image || 'center-center' !== $spacious_footer_background_image_position || 'auto' !== $spacious_footer_background_image_size || 'scroll' !== $spacious_footer_background_image_attachment || 'repeat' !== $spacious_footer_background_image_repeat ) {
		$spacious_theme_options['spacious_footer_background_options'] = array(
			'background-image'      => $spacious_footer_background_image,
			'background-position'   => str_replace( '-', ' ', $spacious_footer_background_image_position ),
			'background-size'       => $spacious_footer_background_image_size,
			'background-attachment' => $spacious_footer_background_image_attachment,
			'background-repeat'     => $spacious_footer_background_image_repeat,
		);
	}


	// Delete options data.
	$spacious_remove_theme_options = array(
		'spacious_content_font',
		'spacious_titles_font',
		'spacious_site_title_font',
		'spacious_site_title_font_size',
		'spacious_site_tagline_font',
		'spacious_tagline_font_size',
		'spacious_small_info_text_size',
		'spacious_small_header_menu_font_size',
		'spacious_menu_font',
		'spacious_primary_menu_font_size',
		'spacious_header_title_background_image',
		'spacious_header_title_background_image_position',
		'spacious_header_title_background_image_size',
		'spacious_header_title_background_image_attachment',
		'spacious_header_title_background_image_repeat',
		'spacious_primary_sub_menu_font_size',
		'spacious_title_font_size',
		'spacious_breadcrumb_text_font_size',
		'spacious_post_meta_font_size',
		'spacious_read_more_font_size',
		'spacious_widget_title_font_size',
		'spacious_comment_title_font_size',
		'spacious_content_font_size',
		'spacious_call_to_action_title_font_size',
		'spacious_call_to_action_button_font_size',
		'spacious_archive_title_font_size',
		'spacious_client_widget_title_font_size',
		'spacious_slider_title_font_size',
		'spacious_slider_content_font_size',
		'spacious_slider_button_font_size',
		'spacious_footer_widget_title_font_size',
		'spacious_footer_widget_content_font_size',
		'spacious_footer_copyright_text_font_size',
		'spacious_small_footer_menu_font_size',
		'spacious_footer_background_image',
		'spacious_footer_background_image_position',
		'spacious_footer_background_image_size',
		'spacious_footer_background_image_attachment',
		'spacious_footer_background_image_repeat',
	);

	foreach ( $spacious_remove_theme_options as $spacious_remove_theme_option ) {
		unset( $spacious_theme_options[ $spacious_remove_theme_option ] );
	}

	// Finally, update spacious theme options.
	update_option( 'spacious', $spacious_theme_options );

	// Set a flag.
	update_option( 'spacious_major_controls_migrate', 1 );
}

add_action( 'after_setup_theme', 'spacious_major_controls_migrate' );


/**
 * Migrate Options Framework data to Customizer
 * df
 */
function spacious_options_migrate() {

	// Shifting Users data from Theme Option to Customizer
	if ( get_option( 'spacious_customizer_transfer' ) ) {
		return;
	}

	// Set transfer
	update_option( 'spacious_customizer_transfer', 1 );

	$spacious_themename = get_option( 'stylesheet' );

	$spacious_theme_options = array();
	$spacious_theme_mods    = array();

	// When child theme is active.
	if ( is_child_theme() ) {
		$spacious_theme_options = get_option( 'spacious' );
		$spacious_theme_mods    = get_theme_mods();

		foreach ( $spacious_theme_options as $key => $value ) {
			$spacious_theme_mods[ $key ] = $value;
		}

		update_option( 'theme_mods_' . $spacious_themename, $spacious_theme_mods );
	}

	// For parent theme data Transfer
	if ( false !== ( $mods = get_option( 'spacious' ) ) ) {
		$spacious_theme_options = get_option( 'spacious' );
		$spacious_theme_mods    = get_option( 'theme_mods_spacious-pro' );

		foreach ( $spacious_theme_options as $key => $value ) {
			$spacious_theme_mods[ $key ] = $value;
		}

		update_option( 'theme_mods_spacious-pro', $spacious_theme_mods );
	}
}

add_action( 'after_setup_theme', 'spacious_options_migrate', 12 );
