<?php
/**
 * Theme Header Section for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main" class="clearfix"> <div class="inner-wrap">
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
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
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
/**
 * This hook is important for wordpress plugins and other many things
 */
wp_head();
?>
</head>

<body <?php body_class(); ?>>
<?php	do_action( 'before' ); ?>
<div id="page" class="hfeed site">
	<?php do_action( 'spacious_before_header' ); ?>
	<header id="masthead" class="site-header clearfix">

		<?php if( spacious_options( 'spacious_header_image_position', 'above' ) == 'above' ) { spacious_render_header_image(); } ?>

		<div id="header-text-nav-container">
			<div class="inner-wrap">

				<div id="header-text-nav-wrap" class="clearfix">
					<div id="header-left-section">
						<?php
						if( ( spacious_options( 'spacious_show_header_logo_text', 'text_only' ) == 'both' || spacious_options( 'spacious_show_header_logo_text', 'text_only' ) == 'logo_only' ) ) {
						?>
							<div id="header-logo-image">
								<?php if ( spacious_options('spacious_header_logo_image', '') != '') { ?>
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo spacious_options( 'spacious_header_logo_image', '' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
								<?php } ?>

								<?php if (function_exists('the_custom_logo') && has_custom_logo( $blog_id = 0 )) {
									spacious_the_custom_logo();
								} ?>
							</div><!-- #header-logo-image -->
						<?php
						}
						$screen_reader = '';
                  if ( ( spacious_options( 'spacious_show_header_logo_text', 'text_only' ) == 'logo_only' || spacious_options( 'spacious_show_header_logo_text', 'text_only' ) == 'none' ) ) {
                     $screen_reader = 'screen-reader-text';
                  }
						?>
						<div id="header-text" class="<?php echo $screen_reader; ?>">
                  <?php if ( is_front_page() || is_home() ) : ?>
							<h1 id="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							</h1>
                  <?php else : ?>
                     <h3 id="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                     </h3>
                  <?php endif; ?>
                  <?php
                  $description = get_bloginfo( 'description', 'display' );
                  if ( $description || is_customize_preview() ) : ?>
                     <p id="site-description"><?php echo $description; ?></p>
                  <?php endif; ?><!-- #site-description -->
						</div><!-- #header-text -->
					</div><!-- #header-left-section -->
					<div id="header-right-section">
						<?php
						if( is_active_sidebar( 'spacious_header_sidebar' ) ) {
						?>
						<div id="header-right-sidebar" class="clearfix">
						<?php
							// Calling the header sidebar if it exists.
							if ( !dynamic_sidebar( 'spacious_header_sidebar' ) ):
							endif;
						?>
						</div>
						<?php
						}
						?>
						<nav id="site-navigation" class="main-navigation" role="navigation">
							<h3 class="menu-toggle"><?php _e( 'Menu', 'spacious' ); ?></h3>
							<?php
								if ( has_nav_menu( 'primary' ) ) {
									wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'menu-primary-container' ) );
								}
								else {
									wp_page_menu();
								}
							?>
						</nav>
			    	</div><!-- #header-right-section -->

			   </div><!-- #header-text-nav-wrap -->
			</div><!-- .inner-wrap -->
		</div><!-- #header-text-nav-container -->

		<?php if( spacious_options( 'spacious_header_image_position', 'above' ) == 'below' ) { spacious_render_header_image(); } ?>

		<?php
   	if( spacious_options( 'spacious_activate_slider', '0' ) == '1' ) {
   		if( spacious_options( 'spacious_blog_slider', '0' ) != '1' ) {
   			if( is_home() || is_front_page() ) {
   				spacious_featured_image_slider();
			}
   		} else {
   			if( is_front_page() ) {
   				spacious_featured_image_slider();
   			}
   		}
   	}

		if( ( '' != spacious_header_title() )  && !( is_front_page() ) ) {
			if( !( spacious_options( 'spacious_blog_slider', '0' ) != '1' && is_home( ) ) ){ ?>
				<div class="header-post-title-container clearfix">
					<div class="inner-wrap">
						<div class="post-title-wrapper">
							<?php
							if( '' != spacious_header_title() ) {
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
						<?php if( function_exists( 'spacious_breadcrumb' ) ) { spacious_breadcrumb(); } ?>
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
