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



if ( ! function_exists( 'spacious_header_left_section' ) ) :

	function spacious_header_left_section() {
		?>
		<div id="header-left-section">
				<?php
				if ( ( 'both' === get_theme_mod( 'spacious_show_header_logo_text', 'text_only' ) || 'logo_only' === get_theme_mod( 'spacious_show_header_logo_text', 'text_only' ) ) ) { ?>
					<div id="header-logo-image">

						<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo( $blog_id = 0 ) ) {
							spacious_the_custom_logo();
						} ?>

					</div><!-- #header-logo-image -->

					<?php
				}

				$screen_reader = '';
				if ( ( 'logo_only' === get_theme_mod( 'spacious_show_header_logo_text', 'text_only' ) || 'none' === get_theme_mod( 'spacious_show_header_logo_text', 'text_only' ) ) ) {
					$screen_reader = 'screen-reader-text';
				} ?>

				<div id="header-text" class="<?php echo $screen_reader; ?>">
					<?php if ( is_front_page() || is_home() ) : ?>
						<h1 id="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
							   title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
							   rel="home"><?php bloginfo( 'name' ); ?></a>
						</h1>
					<?php else : ?>
						<h3 id="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
							   title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
							   rel="home"><?php bloginfo( 'name' ); ?></a>
						</h3>
					<?php endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
					<p id="site-description"><?php echo $description; ?></p>
					<?php endif; ?><!-- #site-description -->
				</div><!-- #header-text -->

			</div><!-- #header-left-section -->
		<?php
	}

endif;

if ( ! function_exists( 'spacious_header_right_section' ) ) :

	function spacious_header_right_section() {
		?>
		<div id="header-right-section">
				<?php
				if ( is_active_sidebar( 'spacious_header_sidebar' ) ) {
					?>
					<div id="header-right-sidebar" class="clearfix">
						<?php
						// Calling the header sidebar if it exists.
						if ( ! dynamic_sidebar( 'spacious_header_sidebar' ) ):
						endif;
						?>
					</div>
					<?php
				} ?>

				<?php if ( 'four' !== get_theme_mod( 'spacious_header_display_type', 'one' ) ) : ?>
					<div class="header-action">
						<?php
						spacious_cart_icon();

						if ( 1 === get_theme_mod( 'spacious_header_search_icon', 0 ) ) :
							?>
							<div class="search-wrapper">
								<div class="search">
									<i class="fa fa-search"> </i>
								</div>
								<div class="header-search-form">
									<?php get_search_form(); ?>
								</div>
							</div><!-- /.search-wrapper -->
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if ( ! ( 'four' === get_theme_mod( 'spacious_header_display_type', 'one' ) ) ) :
					spacious_main_nav();
				endif; ?>

			</div><!-- #header-right-section -->
		<?php
	}

endif;

if ( ! function_exists( 'spacious_nav_text_wrap_close' ) ) :

	/**
	 * Header text nav wrap end.
	 */
	function spacious_nav_text_wrap_close() {
		?>
		</div><!-- #header-text-nav-wrap -->
		<?php
	}

endif;

if ( ! function_exists( 'spacious_inner_wrap_end' ) ) :

	/**
	 * Inner wrap ends.
	 */
	function spacious_inner_wrap_end() {
		?>
		</div><!-- .inner-wrap-->
		<?php
	}

endif;


if ( ! function_exists( 'spacious_bottom_menu' ) ) :

	/**
	 * Header ends.
	 */
	function spacious_bottom_menu() {
		?>
		<?php if ( 'four' === get_theme_mod( 'spacious_header_display_type', 'one' ) ) : ?>
		<div class="bottom-menu clearfix <?php echo get_theme_mod( 'spacious_header_button_setting' ) ? 'header-menu-button' : ''; ?>">
			<div class="inner-wrap clearfix">
				<?php spacious_main_nav(); ?>

				<div class="header-action">
					<?php
					spacious_cart_icon();

					if ( 1 === get_theme_mod( 'spacious_header_search_icon', 0 ) ) :
						?>
						<div class="search-wrapper">
							<div class="search">
								<i class="fa fa-search"> </i>
							</div>
							<div class="header-search-form">
								<?php get_search_form(); ?>
							</div>
						</div><!-- /.search-wrapper -->
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
		<?php
	}

endif;


if ( ! function_exists( 'spacious_nav_container_close' ) ) :

	/**
	 * Header nav ends.
	 */
	function spacious_nav_container_close() {
		?>
		</div><!-- #header-text-nav-container -->
		<?php
	}

endif;

if ( ! function_exists( 'spacious_header_image_below' ) ) :

	/**
	 * Header image position below.
	 */
	function spacious_header_image_below() {

		if ( 'below' === get_theme_mod( 'spacious_header_image_position', 'above' ) ) {
	spacious_render_header_image();
		}

	}

endif;

if ( ! function_exists( 'spacious_slider_activation' ) ) :

	/**
	 * Slider activation.
	 */
	function spacious_slider_activation() {

		if ( get_theme_mod( 'spacious_activate_slider', '0' ) == '1' ) {
			if ( get_theme_mod( 'spacious_blog_slider', '0' ) != '1' ) {
				if ( is_home() || is_front_page() ) {
					spacious_featured_image_slider();
				}
			} else {
				if ( is_front_page() ) {
					spacious_featured_image_slider();
				}
			}
		}

	}

endif;

if ( ! function_exists( 'spacious_header_title_content' ) ) :

	/**
	 * Slider activation.
	 */
	function spacious_header_title_content() {


		if ( ( '' != spacious_header_title() ) && ! ( is_front_page() ) && ( ! get_theme_mod( 'spacious_header_title_hide', 0 ) ) ) {
			if ( ! ( get_theme_mod( 'spacious_blog_slider', '0' ) != '1' && is_home() ) ) { ?>
				<div class="header-post-title-container clearfix">
					<div class="inner-wrap">
						<div class="post-title-wrapper">
							<?php
							if ( '' != spacious_header_title() ) {
								?>
								<?php if ( is_home() ) : ?>
									<h2 class="header-post-title-class"><?php echo spacious_header_title(); ?></h2>
								<?php else : ?>
									<h1 class="header-post-title-class"><?php echo spacious_header_title(); ?></h1>
								<?php endif; ?>
								<?php
							}
							?>
						</div>
						<?php if ( function_exists( 'spacious_breadcrumb' ) ) {
							spacious_breadcrumb();
						} ?>
					</div>
				</div>
				<?php
			}
		}

	}

endif;


if ( ! function_exists( 'spacious_header_end' ) ) :

	/**
	 * Header ends.
	 */
	function spacious_header_end() {
		?>
		</header><!-- #masthead -->
		<?php
	}

endif;

