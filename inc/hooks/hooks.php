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


