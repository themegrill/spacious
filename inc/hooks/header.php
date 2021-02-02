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

if ( ! function_exists( 'spacious_header_start' ) ) :

	/**
	 * Header starts.
	 */
	function spacious_header_start() {
		?>

		<header id="masthead" class="site-header clearfix <?php echo esc_attr( $header_class ); ?>">

	<?php
	}

endif;

if ( ! function_exists( 'spacious_top_header' ) ) :

	function spacious_top_header() {
	if ( get_theme_mod( 'spacious_activate_top_header_bar', 0 ) == 1 ) { ?>
		<div id="header-meta">
			<div class="inner-wrap clearfix">
				<?php
					/**
					 * Functions hooked into spacious_action_header_top_content action.
					 *
					 * @hooked spacious_top_info - 5
					 * @hooked spacious_top_small_menu - 10
					 */
					do_action('spacious_action_header_top_content' );
					?>
			</div>
		</div>
	<?php }
	}
endif;

if ( ! function_exists( 'spacious_top_info' ) ) :

	function spacious_top_info() {

		if ( get_theme_mod( 'spacious_activate_social_links', 0 ) == 1 ) {
			spacious_social_links();
		}
		?>

		<div class="small-info-text"><?php spacious_header_info_text(); ?></div>
	<?php
	}
endif;

if ( ! function_exists( 'spacious_top_small_menu' ) ) :

function spacious_top_small_menu() {
	?>

	<nav class="small-menu" class="clearfix">
		<?php
		if ( has_nav_menu( 'header' ) ) {
			wp_nav_menu( array( 'theme_location' => 'header', 'depth' => -1 ) );
		}
		?>
	</nav>

	<?php
}

endif;

if ( ! function_exists( 'spacious_header_image_position' ) ) :

	function spacious_header_image_position() {

		if ( 'above' === get_theme_mod( 'spacious_header_image_position', 'above' ) ) {
			spacious_render_header_image();
		}

	}

endif;

if ( ! function_exists( 'spacious_nav_container_open' ) ) :

	function spacious_nav_container_open() {
		?>
	<div id="header-text-nav-container" class="<?php echo ( get_theme_mod( 'spacious_one_line_menu_setting', 0 ) == 1 ) ? 'menu-one-line' : ''; ?>">
		<?php
	}

endif;

if ( ! function_exists( 'spacious_nav_inner_wrap' ) ) :

function spacious_nav_inner_wrap() {
	?>
	<div class="inner-wrap" id="<?php echo esc_attr( spacious_header_display_type_class() ); ?>">
	<?php
}

endif;

if ( ! function_exists( 'spacious_nav_text_wrap' ) ) :

	function spacious_nav_text_wrap() {
		?>
		<div id="header-text-nav-wrap" class="clearfix">
		<?php
	}

endif;
