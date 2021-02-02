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
do_action( 'spacious_action_header_section' ); ?>


		</div><!-- #header-text-nav-wrap -->
	</div><!-- .inner-wrap -->
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
