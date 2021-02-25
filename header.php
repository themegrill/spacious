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
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php
	/**
	 * This hook is important for wordpress plugins and other many things
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

<?php do_action( 'before' ); ?>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'spacious' ); ?></a>

	<?php do_action( 'spacious_before_header' ); ?>

	<?php
	$spacious_header_display_type = get_theme_mod( 'spacious_header_display_type', 'one' );
	if ( $spacious_header_display_type === 'one' ) {
		$header_class = 'spacious-header-display-one';
	} elseif ( $spacious_header_display_type === 'four' ) {
		$header_class = 'spacious-header-display-four';
	}
	?>

	<header id="masthead" class="site-header clearfix <?php echo esc_attr( $header_class ); ?>">

		<?php if ( get_theme_mod( 'spacious_activate_top_header_bar', 0 ) == 1 ) { ?>
			<div id="header-meta">
				<div class="inner-wrap clearfix">
					<?php
					if ( get_theme_mod( 'spacious_activate_social_links', 0 ) == 1 ) {
						spacious_social_links();
					}
					?>

					<div class="small-info-text"><?php spacious_header_info_text(); ?></div>

					<nav class="small-menu" class="clearfix">
						<?php
						if ( has_nav_menu( 'header' ) ) {
							wp_nav_menu( array( 'theme_location' => 'header', 'depth' => -1 ) );
						}
						?>
					</nav>
				</div>
			</div>
		<?php } ?>

		<?php if ( 'above' === get_theme_mod( 'spacious_header_image_position', 'above' ) ) {
			spacious_render_header_image();
		} ?>

		<div id="header-text-nav-container" class="<?php echo ( get_theme_mod( 'spacious_one_line_menu_setting', 0 ) == 1 ) ? 'menu-one-line' : ''; ?>">

			<div class="inner-wrap" id="<?php echo esc_attr( $header_class ); ?>">

				<div id="header-text-nav-wrap" class="clearfix">
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

				</div><!-- #header-text-nav-wrap -->
			</div><!-- .inner-wrap -->
			<?php if ( 'four' === get_theme_mod( 'spacious_header_display_type', 'one' ) ) : ?>
				<div class="bottom-menu clearfix <?php echo esc_attr(get_theme_mod( 'spacious_header_button_setting' ) ? 'header-menu-button' : ''); ?>">
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
		</div><!-- #header-text-nav-container -->

		<?php if ( 'below' === get_theme_mod( 'spacious_header_image_position', 'above' ) ) {
			spacious_render_header_image();
		} ?>

		<?php
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
		?>
	</header>
	<?php do_action( 'spacious_after_header' ); ?>
	<?php do_action( 'spacious_before_main' ); ?>
	<div id="main" class="clearfix">
		<div class="inner-wrap">
