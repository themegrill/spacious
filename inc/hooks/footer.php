<?php
/**
 * Hooks for the footer.
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'spacious_main_end' ) ) :

	/**
	 * inner wrap ends.
	 */
	function spacious_main_end() {
		?>
		</div><!-- .inner-wrap -->
		<?php
	}

endif;

if ( ! function_exists( 'spacious_main_inner_wrap_end' ) ) :

	/**
	 * inner wrap ends.
	 */
	function spacious_main_inner_wrap_end() {
		?>
		</div><!-- .main end -->
		<?php
	}

endif;

if ( ! function_exists( 'spacious_footer_wrapper_start' ) ) :

	/**
	 * Footer wrapper.
	 */
	function spacious_footer_wrapper_start() {
		?>
		<footer id="colophon" class="clearfix">
		<?php
	}

endif;

if ( ! function_exists( 'spacious_footer_content' ) ) :
	function spacious_footer_content() {

		get_sidebar( 'footer' ); ?>

		<div class="footer-socket-wrapper clearfix">
			<div class="inner-wrap">
				<div class="footer-socket-area">
					<?php do_action( 'spacious_footer_copyright' ); ?>
					<nav class="small-menu clearfix">
						<?php
						if ( has_nav_menu( 'footer' ) ) {
							wp_nav_menu( array(
								'theme_location' => 'footer',
								'depth'          => -1,
							) );
						}
						?>
					</nav>
				</div>
			</div>
		</div>
		<?php
	}

endif;

if ( ! function_exists( 'spacious_footer_wrapper_end' ) ) :

	/**
	 * Footer wrapper.
	 */
	function spacious_footer_wrapper_end() {
		?>
		</footer>
		<?php
	}

endif;

if ( ! function_exists( 'spacious_after_footer' ) ) :

	/**
	 * Footer wrapper.
	 */
	function spacious_after_footer() {
		?>
		<a href="#masthead" id="scroll-up"></a>
		<?php
	}

endif;

if ( ! function_exists( 'spacious_footer_page_end' ) ) :

	/**
	 * page end.
	 */
	function spacious_footer_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}

endif;

