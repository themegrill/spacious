<?php
/**
 * Spacious theme hooks.
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
 * Hooks for the header of this theme.
 */
// HTML Head.
add_action( 'spacious_action_head', 'spacious_head', 10 );

// Page start.
add_action( 'spacious_action_before', 'spacious_page_start', 10 );

// Header starts.
add_action( 'spacious_action_before_header', 'spacious_header_start', 10 );

// Header top.
add_action( 'spacious_action_header_top', 'spacious_top_header' );
add_action( 'spacious_action_header_top_content', 'spacious_top_info', 5 );
add_action( 'spacious_action_header_top_content', 'spacious_top_small_menu', 10 );

add_action( 'spacious_action_header_image', 'spacious_header_image_position', 10 );

// Header nav container.
add_action( 'spacious_action_nav_container', 'spacious_nav_container_open', 5 );
add_action( 'spacious_action_nav_container', 'spacious_nav_inner_wrap', 10 );
add_action( 'spacious_action_nav_container', 'spacious_nav_text_wrap', 15 );

// Header left/right section.
add_action( 'spacious_action_header_section', 'spacious_header_left_section', 5 );
add_action( 'spacious_action_header_section', 'spacious_header_right_section', 10 );

add_action( 'spacious_action_header_section_close', 'spacious_nav_text_wrap_close', 5 );
add_action( 'spacious_action_header_section_close', 'spacious_inner_wrap_end', 15 );
add_action( 'spacious_action_header_section_close', 'spacious_bottom_menu', 20 );
add_action( 'spacious_action_header_section_close', 'spacious_nav_container_close', 25 );

// Header image position.
add_action( 'spacious_action_header_content', 'spacious_header_image_below', 5 );
add_action( 'spacious_action_header_content', 'spacious_slider_activation', 10 );
add_action( 'spacious_action_header_content', 'spacious_header_title_content', 15 );

// Header ends.
add_action( 'spacious_action_after_header', 'spacious_header_end', 10 );

// Main Starts
add_action( 'spacious_action_main', 'spacious_main_start', 5 );
add_action( 'spacious_action_main', 'spacious_main_inner_wrap', 10 );
