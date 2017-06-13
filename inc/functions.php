<?php
/**
 * Spacious functions and definitions
 *
 * This file contains all the functions and it's defination that particularly can't be
 * in other files.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */

/****************************************************************************************/

// Spacious theme options
function spacious_options( $id, $default = false ) {
   // assigning theme name
   $themename = get_option( 'stylesheet' );
   $themename = preg_replace("/\W/", "_", strtolower( $themename ) );

   // getting options value
   $spacious_options = get_option( $themename );
   if ( isset( $spacious_options[ $id ] ) ) {
	  return $spacious_options[ $id ];
   } else {
	  return $default;
   }
}

/****************************************************************************************/

add_action( 'wp_enqueue_scripts', 'spacious_scripts_styles_method' );
/**
 * Register jquery scripts
 */
function spacious_scripts_styles_method() {
   /**
	* Loads our main stylesheet.
	*/
	wp_enqueue_style( 'spacious_style', get_stylesheet_uri() );

	if( spacious_options( 'spacious_color_skin', 'light' ) == 'dark' ) {
		wp_enqueue_style( 'spacious_dark_style', SPACIOUS_CSS_URL. '/dark.css' );
	}

   // Add Genericons, used in the main stylesheet.
   wp_enqueue_style( 'spacious-genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.3.1' );

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/**
	 * Register JQuery cycle2 js file for slider.
	 */
	wp_register_script( 'jquery_cycle', SPACIOUS_JS_URL . '/jquery.cycle2.min.js', array( 'jquery' ), '2.1.6', true );
	wp_register_script( 'jquery-swipe', SPACIOUS_JS_URL . '/jquery.cycle2.swipe.min.js', array( 'jquery' ), false, true );

	wp_register_style( 'google_fonts', '//fonts.googleapis.com/css?family=Lato' );

	/**
	 * Enqueue Slider setup js file.
	 */
	if ( is_home() || is_front_page() && spacious_options( 'spacious_activate_slider', '0' ) == '1' ) {
		wp_enqueue_script( 'jquery-swipe' );
		wp_enqueue_script( 'spacious_slider', SPACIOUS_JS_URL . '/spacious-slider-setting.js', array( 'jquery_cycle' ), false, true );
	}
	wp_enqueue_script( 'spacious-navigation', SPACIOUS_JS_URL . '/navigation.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'spacious-custom', SPACIOUS_JS_URL. '/spacious-custom.js', array( 'jquery' ) );

	wp_enqueue_style( 'google_fonts' );

	wp_enqueue_script( 'html5', SPACIOUS_JS_URL . '/html5shiv.min.js', true );
	wp_script_add_data( 'html5', 'conditional', 'lte IE 8' );

}

/****************************************************************************************/

add_filter('the_content', 'spacious_add_mod_hatom_data');
// Adding the support for the entry-title tag for Google Rich Snippets
function spacious_add_mod_hatom_data($content) {
   $title = get_the_title();
   if ( is_single() ) {
	  $content .= '<div class="extra-hatom-entry-title"><span class="entry-title">' . $title . '</span></div>';
   }
   return $content;
}

/****************************************************************************************/

add_filter( 'excerpt_length', 'spacious_excerpt_length' );
/**
 * Sets the post excerpt length to 40 words.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function spacious_excerpt_length( $length ) {
	return 40;
}

add_filter( 'excerpt_more', 'spacious_continue_reading' );
/**
 * Returns a "Continue Reading" link for excerpts
 */
function spacious_continue_reading() {
	return '';
}

/****************************************************************************************/

/**
 * Removing the default style of wordpress gallery
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Filtering the size to be medium from thumbnail to be used in WordPress gallery as a default size
 */
function spacious_gallery_atts( $out, $pairs, $atts ) {
	$atts = shortcode_atts( array(
	'size' => 'medium',
	), $atts );

	$out['size'] = $atts['size'];

	return $out;

}
add_filter( 'shortcode_atts_gallery', 'spacious_gallery_atts', 10, 3 );

/****************************************************************************************/

add_filter( 'body_class', 'spacious_body_class' );
/**
 * Filter the body_class
 *
 * Throwing different body class for the different layouts in the body tag
 */
function spacious_body_class( $classes ) {
	global $post;

	if( $post ) { $layout_meta = get_post_meta( $post->ID, 'spacious_page_layout', true ); }

	if( is_home() ) {
		$queried_id = get_option( 'page_for_posts' );
		$layout_meta = get_post_meta( $queried_id, 'spacious_page_layout', true );
	}

	if( empty( $layout_meta ) || is_archive() || is_search() ) { $layout_meta = 'default_layout'; }

	$spacious_default_layout = spacious_options( 'spacious_default_layout', 'right_sidebar' );
	$spacious_default_page_layout = spacious_options( 'spacious_pages_default_layout', 'right_sidebar' );
	$spacious_default_post_layout = spacious_options( 'spacious_single_posts_default_layout', 'right_sidebar' );

	if( $layout_meta == 'default_layout' ) {
		if( is_page() ) {
			if( $spacious_default_page_layout == 'right_sidebar' ) { $classes[] = ''; }
			elseif( $spacious_default_page_layout == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
			elseif( $spacious_default_page_layout == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
			elseif( $spacious_default_page_layout == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }
		}
		elseif( is_single() ) {
			if( $spacious_default_post_layout == 'right_sidebar' ) { $classes[] = ''; }
			elseif( $spacious_default_post_layout == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
			elseif( $spacious_default_post_layout == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
			elseif( $spacious_default_post_layout == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }
		}
		elseif( $spacious_default_layout == 'right_sidebar' ) { $classes[] = ''; }
		elseif( $spacious_default_layout == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
		elseif( $spacious_default_layout == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
		elseif( $spacious_default_layout == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }
	}
	elseif( $layout_meta == 'right_sidebar' ) { $classes[] = ''; }
	elseif( $layout_meta == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
	elseif( $layout_meta == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
	elseif( $layout_meta == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }


	if ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_medium_alternate' ) {
		$classes[] = 'blog-alternate-medium';
	}
	if ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_medium' ) {
		$classes[] = 'blog-medium';
	}
	if( spacious_options( 'spacious_site_layout', 'box_1218px' ) == 'wide_978px' ) {
		$classes[] = 'wide-978';
	}
	elseif( spacious_options( 'spacious_site_layout', 'box_1218px' ) == 'box_978px' ) {
		$classes[] = 'narrow-978';
	}
	elseif( spacious_options( 'spacious_site_layout', 'box_1218px' ) == 'wide_1218px' ) {
		$classes[] = 'wide-1218';
	}
	else {
		$classes[] = '';
	}

	return $classes;
}

/****************************************************************************************/

if ( ! function_exists( 'spacious_sidebar_select' ) ) :
/**
 * Fucntion to select the sidebar
 */
function spacious_sidebar_select() {
	global $post;

	if( $post ) { $layout_meta = get_post_meta( $post->ID, 'spacious_page_layout', true ); }

	if( is_home() ) {
		$queried_id = get_option( 'page_for_posts' );
		$layout_meta = get_post_meta( $queried_id, 'spacious_page_layout', true );
	}

	if( empty( $layout_meta ) || is_archive() || is_search() ) { $layout_meta = 'default_layout'; }

	$spacious_default_layout = spacious_options( 'spacious_default_layout', 'right_sidebar' );
	$spacious_default_page_layout = spacious_options( 'spacious_pages_default_layout', 'right_sidebar' );
	$spacious_default_post_layout = spacious_options( 'spacious_single_posts_default_layout', 'right_sidebar' );

	if( $layout_meta == 'default_layout' ) {
		if( is_page() ) {
			if( $spacious_default_page_layout == 'right_sidebar' ) { get_sidebar(); }
			elseif ( $spacious_default_page_layout == 'left_sidebar' ) { get_sidebar( 'left' ); }
		}
		if( is_single() ) {
			if( $spacious_default_post_layout == 'right_sidebar' ) { get_sidebar(); }
			elseif ( $spacious_default_post_layout == 'left_sidebar' ) { get_sidebar( 'left' ); }
		}
		elseif( $spacious_default_layout == 'right_sidebar' ) { get_sidebar(); }
		elseif ( $spacious_default_layout == 'left_sidebar' ) { get_sidebar( 'left' ); }
	}
	elseif( $layout_meta == 'right_sidebar' ) { get_sidebar(); }
	elseif( $layout_meta == 'left_sidebar' ) { get_sidebar( 'left' ); }
}
endif;

/****************************************************************************************/

add_action( 'admin_head', 'spacious_favicon' );
add_action( 'wp_head', 'spacious_favicon' );
/**
 * Fav icon for the site
 */
function spacious_favicon() {
	if ( spacious_options( 'spacious_activate_favicon', '0' ) == '1' ) {
		$spacious_favicon = spacious_options( 'spacious_favicon', '' );
		$spacious_favicon_output = '';
		if ( ! function_exists( 'has_site_icon' ) || ( ! empty( $spacious_favicon ) && ! has_site_icon() ) ) {
			$spacious_favicon_output .= '<link rel="shortcut icon" href="'.esc_url( $spacious_favicon ).'" type="image/x-icon" />';
		}
		echo $spacious_favicon_output;
	}
}

/**************************************************************************************/

/**
 * Change hex code to RGB
 * Source: https://css-tricks.com/snippets/php/convert-hex-to-rgb/#comment-1052011
 */
function spacious_hex2rgb($hexstr) {
	$int = hexdec($hexstr);
	$rgb = array("red" => 0xFF & ($int >> 0x10), "green" => 0xFF & ($int >> 0x8), "blue" => 0xFF & $int);
	$r = $rgb['red'];
	$g = $rgb['green'];
	$b = $rgb['blue'];

	return "rgba($r,$g,$b, 0.85)";
}

/**
 * Generate darker color
 * Source: http://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
 */
function spacious_darkcolor($hex, $steps) {
	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max(-255, min(255, $steps));

	// Normalize into a six character long hex string
	$hex = str_replace('#', '', $hex);
	if (strlen($hex) == 3) {
		$hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
	}

	// Split into three parts: R, G and B
	$color_parts = str_split($hex, 2);
	$return = '#';

	foreach ($color_parts as $color) {
		$color   = hexdec($color); // Convert to decimal
		$color   = max(0,min(255,$color + $steps)); // Adjust color
		$return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
	}

	return $return;
}

/****************************************************************************************/

add_action('wp_head', 'spacious_custom_css', 100);
/**
 * Hooks the Custom Internal CSS to head section
 */
function spacious_custom_css() {
	$primary_color = spacious_options( 'spacious_primary_color', '#0FBE7C' );
	$primary_opacity = spacious_hex2rgb($primary_color);
	$primary_dark    = spacious_darkcolor($primary_color, -50);
	$spacious_internal_css = '';
	if( $primary_color != '#0FBE7C' ) {
		$spacious_internal_css = ' blockquote { border-left: 3px solid '.$primary_color.'; }
			.spacious-button, input[type="reset"], input[type="button"], input[type="submit"], button { background-color: '.$primary_color.'; }
			.previous a:hover, .next a:hover { 	color: '.$primary_color.'; }
			a { color: '.$primary_color.'; }
			#site-title a:hover { color: '.$primary_color.'; }
			.main-navigation ul li.current_page_item a, .main-navigation ul li:hover > a { color: '.$primary_color.'; }
			.main-navigation ul li ul { border-top: 1px solid '.$primary_color.'; }
			.main-navigation ul li ul li a:hover, .main-navigation ul li ul li:hover > a, .main-navigation ul li.current-menu-item ul li a:hover { color: '.$primary_color.'; }
			.site-header .menu-toggle:hover.entry-meta a.read-more:hover,#featured-slider .slider-read-more-button:hover,.call-to-action-button:hover,.entry-meta .read-more-link:hover,.spacious-button:hover, input[type="reset"]:hover, input[type="button"]:hover, input[type="submit"]:hover, button:hover { background: '.$primary_dark.'; }
			.main-small-navigation li:hover { background: '.$primary_color.'; }
			.main-small-navigation ul > .current_page_item, .main-small-navigation ul > .current-menu-item { background: '.$primary_color.'; }
			.main-navigation a:hover, .main-navigation ul li.current-menu-item a, .main-navigation ul li.current_page_ancestor a, .main-navigation ul li.current-menu-ancestor a, .main-navigation ul li.current_page_item a, .main-navigation ul li:hover > a  { color: '.$primary_color.'; }
			.small-menu a:hover, .small-menu ul li.current-menu-item a, .small-menu ul li.current_page_ancestor a, .small-menu ul li.current-menu-ancestor a, .small-menu ul li.current_page_item a, .small-menu ul li:hover > a { color: '.$primary_color.'; }
			#featured-slider .slider-read-more-button { background-color: '.$primary_color.'; }
			#controllers a:hover, #controllers a.active { background-color: '.$primary_color.'; color: '.$primary_color.'; }
			.widget_service_block a.more-link:hover, .widget_featured_single_post a.read-more:hover,#secondary a:hover,logged-in-as:hover  a,.single-page p a:hover{ color: '.$primary_dark.'; }
			.breadcrumb a:hover { color: '.$primary_color.'; }
			.tg-one-half .widget-title a:hover, .tg-one-third .widget-title a:hover, .tg-one-fourth .widget-title a:hover { color: '.$primary_color.'; }
			.pagination span ,.site-header .menu-toggle:hover{ background-color: '.$primary_color.'; }
			.pagination a span:hover { color: '.$primary_color.'; border-color: .'.$primary_color.'; }
			.widget_testimonial .testimonial-post { border-color: '.$primary_color.' #EAEAEA #EAEAEA #EAEAEA; }
			.call-to-action-content-wrapper { border-color: #EAEAEA #EAEAEA #EAEAEA '.$primary_color.'; }
			.call-to-action-button { background-color: '.$primary_color.'; }
			#content .comments-area a.comment-permalink:hover { color: '.$primary_color.'; }
			.comments-area .comment-author-link a:hover { color: '.$primary_color.'; }
			.comments-area .comment-author-link span { background-color: '.$primary_color.'; }
			.comment .comment-reply-link:hover { color: '.$primary_color.'; }
			.nav-previous a:hover, .nav-next a:hover { color: '.$primary_color.'; }
			#wp-calendar #today { color: '.$primary_color.'; }
			.widget-title span { border-bottom: 2px solid '.$primary_color.'; }
			.footer-widgets-area a:hover { color: '.$primary_color.' !important; }
			.footer-socket-wrapper .copyright a:hover { color: '.$primary_color.'; }
			a#back-top:before { background-color: '.$primary_color.'; }
			.read-more, .more-link { color: '.$primary_color.'; }
			.post .entry-title a:hover, .page .entry-title a:hover { color: '.$primary_color.'; }
			.post .entry-meta .read-more-link { background-color: '.$primary_color.'; }
			.post .entry-meta a:hover, .type-page .entry-meta a:hover { color: '.$primary_color.'; }
			.single #content .tags a:hover { color: '.$primary_color.'; }
			.widget_testimonial .testimonial-icon:before { color: '.$primary_color.'; }
			a#scroll-up { background-color: '.$primary_color.'; }
			.search-form span { background-color: '.$primary_color.'; }';
	}

	if( !empty( $spacious_internal_css ) ) {
		?>
		<style type="text/css"><?php echo $spacious_internal_css; ?></style>
		<?php
	}

	$spacious_custom_css = spacious_options( 'spacious_custom_css' );
	if( $spacious_custom_css && ! function_exists( 'wp_update_custom_css_post' ) ) {
		?>
		<style type="text/css"><?php echo $spacious_custom_css; ?></style>
		<?php
	}
}

/**************************************************************************************/

if ( ! function_exists( 'spacious_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function spacious_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<h3 class="screen-reader-text"><?php _e( 'Post navigation', 'spacious' ); ?></h3>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'spacious' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'spacious' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'spacious' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'spacious' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // spacious_content_nav

/**************************************************************************************/

if ( ! function_exists( 'spacious_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function spacious_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'spacious' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'spacious' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 74 );
					printf( '<div class="comment-author-link">%1$s%2$s</div>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'spacious' ) . '</span>' : ''
					);
					printf( '<div class="comment-date-time">%1$s</div>',
						sprintf( __( '%1$s at %2$s', 'spacious' ), get_comment_date(), get_comment_time() )
					);
					printf( __( '<a class="comment-permalink" href="%1$s">Permalink</a>', 'spacious'), esc_url( get_comment_link( $comment->comment_ID ) ) );
					edit_comment_link();
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'spacious' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'spacious' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</section><!-- .comment-content -->

		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

/**************************************************************************************/

add_action( 'spacious_footer_copyright', 'spacious_footer_copyright', 10 );
/**
 * function to show the footer info, copyright information
 */
if ( ! function_exists( 'spacious_footer_copyright' ) ) :
function spacious_footer_copyright() {
	$site_link = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';

	$wp_link = '<a href="'.esc_url( 'https://wordpress.org' ).'" target="_blank" title="' . esc_attr__( 'WordPress', 'spacious' ) . '"><span>' . __( 'WordPress', 'spacious' ) . '</span></a>';

	$tg_link =  '<a href="'.esc_url( 'https://themegrill.com/themes/spacious' ).'" target="_blank" title="'.esc_attr__( 'ThemeGrill', 'spacious' ).'" rel="designer"><span>'.__( 'ThemeGrill', 'spacious') .'</span></a>';

	$default_footer_value = sprintf( __( 'Copyright &copy; %1$s %2$s.', 'spacious' ), date( 'Y' ), $site_link ).' '.sprintf( __( 'Powered by %s.', 'spacious' ), $wp_link ).' '.sprintf( __( 'Theme: %1$s by %2$s.', 'spacious' ), 'Spacious', $tg_link );

	$spacious_footer_copyright = '<div class="copyright">'.$default_footer_value.'</div>';
	echo $spacious_footer_copyright;
}
endif;

/**************************************************************************************/

if ( ! function_exists( 'spacious_posts_listing_display_type_select' ) ) :
/**
 * Function to select the posts listing display type
 */
function spacious_posts_listing_display_type_select() {
	if ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_large' ) {
		$format = 'blog-image-large';
	}
	elseif ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_medium' ) {
		$format = 'blog-image-medium';
	}
	elseif ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_medium_alternate' ) {
		$format = 'blog-image-medium';
	}
	elseif ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_full_content' ) {
		$format = 'blog-full-content';
	}
	else {
		$format = get_post_format();
	}

	return $format;
}
endif;

/****************************************************************************************/

add_action('admin_init','spacious_textarea_sanitization_change', 100);
/**
 * Override the default textarea sanitization.
 */
function spacious_textarea_sanitization_change() {
   remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
   add_filter( 'of_sanitize_textarea', 'spacious_sanitize_textarea_custom',10,2 );
}

/**
 * sanitize the input for custom css
 */
function spacious_sanitize_textarea_custom( $input,$option ) {
   if( $option['id'] == "spacious_custom_css" ) {
	  $output = wp_filter_nohtml_kses( $input );
   } else {
	  $output = $input;
   }
   return $output;
}

/****************************************************************************************/

if ( ! function_exists( 'spacious_entry_meta' ) ) :
/**
 * Shows meta information of post.
 */
function spacious_entry_meta() {
   if ( 'post' == get_post_type() ) :
	  echo '<footer class="entry-meta-bar clearfix">';
	  echo '<div class="entry-meta clearfix">';
	  ?>

	  <span class="by-author author vcard"><a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span>

	  <?php
	  $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	  if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		 $time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	  }
	  $time_string = sprintf( $time_string,
		 esc_attr( get_the_date( 'c' ) ),
		 esc_html( get_the_date() ),
		 esc_attr( get_the_modified_date( 'c' ) ),
		 esc_html( get_the_modified_date() )
	  );
	  printf( __( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></span>', 'spacious' ),
		 esc_url( get_permalink() ),
		 esc_attr( get_the_time() ),
		 $time_string
	  ); ?>

	  <?php if( has_category() ) { ?>
		 <span class="category"><?php the_category(', '); ?></span>
	  <?php } ?>

	  <?php if ( comments_open() ) { ?>
		 <span class="comments"><?php comments_popup_link( __( 'No Comments', 'spacious' ), __( '1 Comment', 'spacious' ), __( '% Comments', 'spacious' ), '', __( 'Comments Off', 'spacious' ) ); ?></span>
	  <?php } ?>

	  <?php edit_post_link( __( 'Edit', 'spacious' ), '<span class="edit-link">', '</span>' ); ?>

	  <?php if ( ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) != 'blog_full_content' ) && !is_single() ) { ?>
		 <span class="read-more-link"><a class="read-more" href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'spacious' ); ?></a></span>
	  <?php } ?>

	  <?php
	  echo '</div>';
	  echo '</footer>';
   endif;
}
endif;

/**************************************************************************************/

/**
 * Making the theme Woocommrece compatible
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

add_filter( 'woocommerce_show_page_title', '__return_false' );

add_action('woocommerce_before_main_content', 'spacious_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'spacious_wrapper_end', 10);

function spacious_wrapper_start() {
	echo '<div id="primary">';
}

function spacious_wrapper_end() {
	echo '</div>';
}

function spacious_woocommerce_support() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'spacious_woocommerce_support' );

/**
 * Function to transfer the favicon added in Customizer Options of theme to Site Icon in Site Identity section
 */
function spacious_site_icon_migrate() {
	if ( get_option( 'spacious_site_icon_transfer' ) ) {
		return;
	}

	$spacious_favicon = spacious_options( 'spacious_favicon', 0 );

	// Migrate spacious site icon.
	if ( function_exists( 'has_site_icon' ) && ( ! empty( $spacious_favicon ) && ! has_site_icon() ) ) {
		// assigning theme name
		$themename = get_option( 'stylesheet' );
		$themename = preg_replace("/\W/", "_", strtolower( $themename ) );

		$theme_options = get_option( $themename );
		$attachment_id = attachment_url_to_postid( $spacious_favicon );

		// Update site icon transfer options.
		if ( $theme_options && $attachment_id ) {
			update_option( 'site_icon', $attachment_id );
			update_option( 'spacious_site_icon_transfer', 1 );

			// Remove old favicon options.
			foreach ( $theme_options as $option_key => $option_value ) {
				if ( in_array( $option_key, array( 'spacious_favicon', 'spacious_activate_favicon' ) ) ) {
					unset( $theme_options[ $option_key ] );
				}
			}
		}

		// Finally, update spacious theme options.
		update_option( $themename, $theme_options );
	}
}

add_action( 'after_setup_theme', 'spacious_site_icon_migrate' );

// Displays the site logo
if ( ! function_exists( 'spacious_the_custom_logo' ) ) {
	/**
	 * Displays the optional custom logo.
	 */
	function spacious_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' )  && ( spacious_options( 'spacious_header_logo_image','' ) == '') ) {
			the_custom_logo();
		}
	}
}

/**
 * Migrate any existing theme CSS codes added in Customize Options to the core option added in WordPress 4.7
 */
function spacious_custom_css_migrate() {
	if ( function_exists( 'wp_update_custom_css_post' ) ) {
		$custom_css = spacious_options( 'spacious_custom_css' );
		if ( $custom_css ) {
			// assigning theme name
			$themename = get_option( 'stylesheet' );
			$themename = preg_replace("/\W/", "_", strtolower( $themename ) );

			$core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
			$return = wp_update_custom_css_post( $core_css . $custom_css );

			if ( ! is_wp_error( $return ) ) {
				$theme_options = get_option( $themename );
				// Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
				if ( isset( $theme_options[ 'spacious_custom_css' ] ) ) {
					unset( $theme_options[ 'spacious_custom_css' ] );
				}

				// Finally, update spacious theme options.
				update_option( $themename, $theme_options );
			}
		}
	}
}

add_action( 'after_setup_theme', 'spacious_custom_css_migrate' );

/**
 * Function to transfer the Header Logo added in Customizer Options of theme to Site Logo in Site Identity section
 */
function spacious_site_logo_migrate() {
	if ( function_exists( 'the_custom_logo' ) && ! has_custom_logo( $blog_id = 0 ) ) {
		$logo_url = spacious_options( 'spacious_header_logo_image' );

		if ( $logo_url ) {
			// assigning theme name
			$themename = get_option( 'stylesheet' );
			$themename = preg_replace("/\W/", "_", strtolower( $themename ) );

			$customizer_site_logo_id = attachment_url_to_postid( $logo_url );
			set_theme_mod( 'custom_logo', $customizer_site_logo_id );

			// Delete the old Site Logo theme_mod option.
			$theme_options = get_option( $themename );

			if ( isset( $theme_options[ 'spacious_header_logo_image' ] ) ) {
				unset( $theme_options[ 'spacious_header_logo_image' ] );
			}

			// Finally, update spacious theme options.
			update_option( $themename, $theme_options );
		}
	}
}

add_action( 'after_setup_theme', 'spacious_site_logo_migrate' );
