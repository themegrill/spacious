<?php
/**
 * Hooks for the header.
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'spacious_head' ) ) :

	function spacious_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<?php
	}

endif;

if ( ! function_exists( 'spacious_page_start' ) ) :

	/**
	 * Page start.
	 */
	function spacious_page_start() {
		?>
		<div id="page" class="hfeed site">
		<?php
	}

endif;

if ( ! function_exists( 'spacious_skip_content_link' ) ) :

	/**
	 * Skip content link.
	 */
	function spacious_skip_content_link() {
		?>
		<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'spacious' ); ?></a>
		<?php
	}

endif;
