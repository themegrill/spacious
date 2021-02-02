<?php
/**
 * Theme Header Section for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main" class="clearfix"> <div class="inner-wrap">
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<?php
	/**
	 * Functions hooked into spacious_action_head action.
	 *
	 * @hooked spacious_head - 10
	 */
	do_action( 'spacious_action_head' );

	/**
	 * This hook is important for WordPress plugins and other many things
	 */
	wp_head();
	?>
</head>

<body <?php body_class(); ?>>

<?php
/**
 * WordPress function to load custom scripts after body.
 *
 * Introduced in WordPress 5.2.0
 *
 * @since Spacious 1.6.4
 */
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}
?>

<?php do_action( 'before' );

/**
 * Functions hooked into spacious_action_before action.
 *
 * @hooked spacious_page_start - 10
 * @hooked spacious_skip_content_link - 15
 */
do_action( 'spacious_action_before' );

/*
 * Hook: spacious_before_header
 */
do_action( 'spacious_before_header' );

/**
 * Functions hooked into spacious_action_before_header action.
 * @hooked spacious_header_start
 */
do_action( 'spacious_action_before_header' );

/**
 * Functions hooked into spacious_action_header_top action.
 *
 * @hooked spacious_top_header
 */
do_action( 'spacious_action_header_top' );

/**
 * Functions hooked into spacious_action_header_top action.
 *
 * @hooked spacious_header_image_position - 10
 */
do_action( 'spacious_action_header_image' );

/**
 * Functions hooked into spacious_action_nav_container action.
 *
 * @hooked spacious_nav_container_open - 5
 * @hooked spacious_nav_inner_wrap - 10
 * @hooked spacious_nav_text_wrap - 15
 */
do_action( 'spacious_action_nav_container' );


/**
 * Functions hooked into spacious_action_header_section action.
 *
 * @hooked spacious_header_left_section - 10
 * @hooked spacious_header_right_section - 15
 */
do_action( 'spacious_action_header_section' );

/**
 * Functions hooked into spacious_action_header_section action.
 *
 * @hooked spacious_nav_text_wrap_close - 5
 * @hooked spacious_inner_wrap_end - 15
 * @hooked spacious_bottom_menu - 20
 * @hooked spacious_nav_container_close - 25
 */
do_action( 'spacious_action_header_section_close' );

/**
 * Functions hooked into spacious_action_header_content action.
 *
 * @hooked spacious_header_image_below - 5
 * @hooked spacious_slider_activation - 10
 * @hooked spacious_header_title_content - 15
 */
do_action( 'spacious_action_header_content' );

/**
 * Functions hooked into spacious_action_after_header action.
 *
 * @hooked spacious_header_end - 10
 */
do_action( 'spacious_action_after_header' );

do_action( 'spacious_after_header' );

do_action( 'spacious_before_main' ); ?>

<div id="main" class="clearfix">
	<div class="inner-wrap">
