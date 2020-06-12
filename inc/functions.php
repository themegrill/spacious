<?php
/**
 * Spacious functions and definitions
 *
 * This file contains all the functions and it's defination that particularly can't be
 * in other files.
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 1.0
 */

/****************************************************************************************/

// Spacious theme options
function spacious_options( $id, $default = false ) {
	// assigning theme name
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace( "/\W/", "_", strtolower( $themename ) );

	// getting options value
	$spacious_options = get_option( $themename );
	if ( isset( $spacious_options[ $id ] ) ) {
		return $spacious_options[ $id ];
	} else {
		return $default;
	}
}

/****************************************************************************************/

/**
 * Register jquery scripts
 */
function spacious_scripts_styles_method() {
	/**
	 * Loads our main stylesheet.
	 */
	wp_enqueue_style( 'spacious_style', get_stylesheet_uri() );

	if ( spacious_options( 'spacious_color_skin', 'light' ) == 'dark' ) {
		wp_enqueue_style( 'spacious_dark_style', SPACIOUS_CSS_URL . '/dark.css' );
	}

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'spacious-genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.3.1' );

	// Enqueue font-awesome style.
	wp_enqueue_style( 'spacious-font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );
	

	$spacious_googlefonts = array();
	array_push( $spacious_googlefonts, spacious_options( 'spacious_titles_font', 'Lato' ) );
	array_push( $spacious_googlefonts, spacious_options( 'spacious_content_font', 'Lato' ) );

	// Assign required fonts from database in array and make it unique.
	$spacious_googlefonts          = array_unique( $spacious_googlefonts );
	$spacious_google_fonts         = spacious_google_fonts();
	$spacious_standard_fonts_array = spacious_standard_fonts_array();

	// Check for the Google Fonts arrays.
	foreach ( $spacious_googlefonts as $spacious_googlefont ) {

		// If the array_key_exists for currently selected fonts,
		// then only proceed to create new array to include,
		// only the required Google fonts.
		// For Standard fonts, no need for loading up the Google Fonts array.
		if ( array_key_exists( $spacious_googlefont, $spacious_google_fonts ) ) {
			$spacious_googlefont_lists[] = $spacious_googlefont;
		}

	}

	// Check for the Standard Fonts arrays.
	foreach ( $spacious_googlefonts as $spacious_standard_font ) {

		// If the array_key_exists for currently selected fonts,
		// then only proceed to create new array to include,
		// only the required Standard fonts,
		// in order to enqueue to Google Fonts only when,
		// no theme_mods data is altered.
		if ( array_key_exists( $spacious_standard_font, $spacious_standard_fonts_array ) ) {
			$spacious_standard_font_lists[] = $spacious_standard_font;
		}

	}

	// Proceed only if the Google Fonts array is available,
	// to enqueue the Google Fonts.
	if ( isset( $spacious_googlefont_lists ) ) :

		$spacious_googlefont_lists = implode( "|", $spacious_googlefont_lists );

		wp_register_style( 'spacious_googlefonts', '//fonts.googleapis.com/css?family=' . $spacious_googlefont_lists );
		wp_enqueue_style( 'spacious_googlefonts' );

	// Proceed only if the theme is installed first time,
	// or the theme_mods data for typography is not changed.
	elseif ( ! isset( $spacious_standard_font_lists ) ) :

		$spacious_googlefonts = implode( "|", $spacious_googlefonts );

		wp_register_style( 'spacious_googlefonts', '//fonts.googleapis.com/css?family=' . $spacious_googlefonts );
		wp_enqueue_style( 'spacious_googlefonts' );

	endif;

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

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
		wp_enqueue_script( 'jquery_cycle' );
	}

	wp_enqueue_script( 'spacious-navigation', SPACIOUS_JS_URL . '/navigation.js', array( 'jquery' ), false, true );

	// Skip link focus fix JS enqueue.
	wp_enqueue_script( 'spacious-skip-link-focus-fix', SPACIOUS_JS_URL . '/skip-link-focus-fix.js', array(), false, true );

	wp_enqueue_script( 'spacious-custom', SPACIOUS_JS_URL . '/spacious-custom.js', array( 'jquery' ) );

	wp_enqueue_script( 'html5', SPACIOUS_JS_URL . '/html5shiv.min.js', true );
	wp_script_add_data( 'html5', 'conditional', 'lte IE 8' );
}

add_action( 'wp_enqueue_scripts', 'spacious_scripts_styles_method' );

/**
 * Enqueue block editor styles.
 *
 * @since Spacious 1.0
 */
function spacious_block_editor_styles() {
	wp_enqueue_style( 'spacious-block-editor-styles', get_template_directory_uri() . '/style-editor-block.css' );
	wp_enqueue_style( 'spacious-editor-googlefonts', '//fonts.googleapis.com/css?family=Open+Sans:400,600' );
}
add_action( 'enqueue_block_editor_assets', 'spacious_block_editor_styles', 1, 1 );



/****************************************************************************************/

/*
 * Display the related posts.
 */
if ( ! function_exists( 'spacious_related_posts_function' ) ) {

	function spacious_related_posts_function() {
		wp_reset_postdata();
		global $post;

		// Define shared post arguments
		$args = array(
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'ignore_sticky_posts'    => 1,
			'orderby'                => 'rand',
			'post__not_in'           => array( $post->ID ),
			'posts_per_page'         => 3,
		);

		// Related by categories.
		if ( spacious_options( 'spacious_related_posts', 'categories' ) == 'categories' ) {
			$cats                 = wp_get_post_categories( $post->ID, array( 'fields' => 'ids' ) );
			$args['category__in'] = $cats;
		}

		// Related by tags.
		if ( spacious_options( 'spacious_related_posts', 'categories' ) == 'tags' ) {
			$tags            = wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) );
			$args['tag__in'] = $tags;

			if ( ! $tags ) {
				$break = true;
			}
		}

		$query = ! isset( $break ) ? new WP_Query( $args ) : new WP_Query();

		return $query;
	}
}

/****************************************************************************************/

// Adding the support for the entry-title tag for Google Rich Snippets
function spacious_add_mod_hatom_data( $content ) {
	$title = get_the_title();

	if ( is_single() ) {
		$content .= '<div class="extra-hatom-entry-title"><span class="entry-title">' . $title . '</span></div>';
	}

	return $content;
}

add_filter( 'the_content', 'spacious_add_mod_hatom_data' );

/****************************************************************************************/

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

add_filter( 'excerpt_length', 'spacious_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function spacious_continue_reading() {
	return '';
}

add_filter( 'excerpt_more', 'spacious_continue_reading' );

/****************************************************************************************/

/**
 * Removing the default style of WordPress gallery
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

/**
 * Filter the body_class
 *
 * Throwing different body class for the different layouts in the body tag
 */
function spacious_body_class( $classes ) {
	global $post;

	if ( $post ) {
		$layout_meta = get_post_meta( $post->ID, 'spacious_page_layout', true );
	}

	if ( is_home() ) {
		$queried_id  = get_option( 'page_for_posts' );
		$layout_meta = get_post_meta( $queried_id, 'spacious_page_layout', true );
	}

	if ( empty( $layout_meta ) || is_archive() || is_search() ) {
		$layout_meta = 'default_layout';
	}

	$spacious_default_layout      = spacious_options( 'spacious_default_layout', 'right_sidebar' );
	$spacious_default_page_layout = spacious_options( 'spacious_pages_default_layout', 'right_sidebar' );
	$spacious_default_post_layout = spacious_options( 'spacious_single_posts_default_layout', 'right_sidebar' );
	$spacious_woo_archive_layout  = spacious_options( 'spacious_woo_archive_layout', 'no_sidebar_full_width' );
	$spacious_woo_product_layout  = spacious_options( 'spacious_woo_product_layout', 'no_sidebar_full_width' );

	if ( $layout_meta == 'default_layout' ) {
		if ( is_page() ) {
			if ( $spacious_default_page_layout == 'right_sidebar' ) {
				$classes[] = '';
			} elseif ( $spacious_default_page_layout == 'left_sidebar' ) {
				$classes[] = 'left-sidebar';
			} elseif ( $spacious_default_page_layout == 'no_sidebar_full_width' ) {
				$classes[] = 'no-sidebar-full-width';
			} elseif ( $spacious_default_page_layout == 'no_sidebar_content_centered' ) {
				$classes[] = 'no-sidebar';
			} elseif ( $spacious_default_page_layout == 'no_sidebar_content_stretched' ) {
				$classes[] = 'no-sidebar-content-stretched';
			}
		} elseif ( function_exists( 'spacious_is_in_woocommerce_page' ) && is_product() ) {
			if ( $spacious_woo_product_layout == 'right_sidebar' ) {
				$classes[] = '';
			} elseif ( $spacious_woo_product_layout == 'left_sidebar' ) {
				$classes[] = 'left-sidebar';
			} elseif ( $spacious_woo_product_layout == 'no_sidebar_full_width' ) {
				$classes[] = 'no-sidebar-full-width';
			} elseif ( $spacious_woo_product_layout == 'no_sidebar_content_centered' ) {
				$classes[] = 'no-sidebar';
			}
		} elseif ( is_single() ) {
			if ( $spacious_default_post_layout == 'right_sidebar' ) {
				$classes[] = '';
			} elseif ( $spacious_default_post_layout == 'left_sidebar' ) {
				$classes[] = 'left-sidebar';
			} elseif ( $spacious_default_post_layout == 'no_sidebar_full_width' ) {
				$classes[] = 'no-sidebar-full-width';
			} elseif ( $spacious_default_post_layout == 'no_sidebar_content_centered' ) {
				$classes[] = 'no-sidebar';
			} elseif ( $spacious_default_post_layout == 'no_sidebar_content_stretched' ) {
				$classes[] = 'no-sidebar-content-stretched';
			}
		} elseif ( function_exists( 'spacious_is_in_woocommerce_page' ) && spacious_is_in_woocommerce_page() ) {
			if ( $spacious_woo_archive_layout == 'right_sidebar' ) {
				$classes[] = '';
			} elseif ( $spacious_woo_archive_layout == 'left_sidebar' ) {
				$classes[] = 'left-sidebar';
			} elseif ( $spacious_woo_archive_layout == 'no_sidebar_full_width' ) {
				$classes[] = 'no-sidebar-full-width';
			} elseif ( $spacious_woo_archive_layout == 'no_sidebar_content_centered' ) {
				$classes[] = 'no-sidebar';
			}
		} elseif ( $spacious_default_layout == 'right_sidebar' ) {
			$classes[] = '';
		} elseif ( $spacious_default_layout == 'left_sidebar' ) {
			$classes[] = 'left-sidebar';
		} elseif ( $spacious_default_layout == 'no_sidebar_full_width' ) {
			$classes[] = 'no-sidebar-full-width';
		} elseif ( $spacious_default_layout == 'no_sidebar_content_centered' ) {
			$classes[] = 'no-sidebar';
		} elseif ( $spacious_default_layout == 'no_sidebar_content_stretched' ) {
			$classes[] = 'no-sidebar-content-stretched';
		}
	} elseif ( $layout_meta == 'right_sidebar' ) {
		$classes[] = '';
	} elseif ( $layout_meta == 'left_sidebar' ) {
		$classes[] = 'left-sidebar';
	} elseif ( $layout_meta == 'no_sidebar_full_width' ) {
		$classes[] = 'no-sidebar-full-width';
	} elseif ( $layout_meta == 'no_sidebar_content_centered' ) {
		$classes[] = 'no-sidebar';
	} elseif ( $layout_meta == 'no_sidebar_content_stretched' ) {
		$classes[] = 'no-sidebar-content-stretched';
	}

	if ( spacious_options( 'spacious_new_menu', 0 ) == '1' ) {
		$classes[] = 'better-responsive-menu';
	}

	if ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_medium_alternate' ) {
		$classes[] = 'blog-alternate-medium';
	}

	if ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_medium' ) {
		$classes[] = 'blog-medium';
	}

	if ( spacious_options( 'spacious_site_layout', 'box_1218px' ) == 'wide_978px' ) {
		$classes[] = 'wide-978';
	} elseif ( spacious_options( 'spacious_site_layout', 'box_1218px' ) == 'box_978px' ) {
		$classes[] = 'narrow-978';
	} elseif ( spacious_options( 'spacious_site_layout', 'box_1218px' ) == 'wide_1218px' ) {
		$classes[] = 'wide-1218';
	} else {
		$classes[] = '';
	}

	// For header menu button enabled option.
	$header_button_link_1 = spacious_options( 'spacious_header_button_one_link' );
	if ( $header_button_link_1 ) {
		$classes[] = 'spacious-menu-header-button-enabled';
	}

	return $classes;
}

add_filter( 'body_class', 'spacious_body_class' );

/****************************************************************************************/

if ( ! function_exists( 'spacious_sidebar_select' ) ) :
	/**
	 * Fucntion to select the sidebar
	 */
	function spacious_sidebar_select() {
		global $post;

		if ( $post ) {
			$layout_meta = get_post_meta( $post->ID, 'spacious_page_layout', true );
		}

		if ( is_home() ) {
			$queried_id  = get_option( 'page_for_posts' );
			$layout_meta = get_post_meta( $queried_id, 'spacious_page_layout', true );
		}

		if ( empty( $layout_meta ) || is_archive() || is_search() ) {
			$layout_meta = 'default_layout';
		}

		$spacious_default_layout      = spacious_options( 'spacious_default_layout', 'right_sidebar' );
		$spacious_default_page_layout = spacious_options( 'spacious_pages_default_layout', 'right_sidebar' );
		$spacious_default_post_layout = spacious_options( 'spacious_single_posts_default_layout', 'right_sidebar' );

		if ( $layout_meta == 'default_layout' ) {
			if ( is_page() ) {
				if ( $spacious_default_page_layout == 'right_sidebar' ) {
					get_sidebar();
				} elseif ( $spacious_default_page_layout == 'left_sidebar' ) {
					get_sidebar( 'left' );
				}
			}

			if ( is_single() ) {
				if ( $spacious_default_post_layout == 'right_sidebar' ) {
					get_sidebar();
				} elseif ( $spacious_default_post_layout == 'left_sidebar' ) {
					get_sidebar( 'left' );
				}
			} elseif ( $spacious_default_layout == 'right_sidebar' ) {
				get_sidebar();
			} elseif ( $spacious_default_layout == 'left_sidebar' ) {
				get_sidebar( 'left' );
			}
		} elseif ( $layout_meta == 'right_sidebar' ) {
			get_sidebar();
		} elseif ( $layout_meta == 'left_sidebar' ) {
			get_sidebar( 'left' );
		}
	}
endif;

/**************************************************************************************/

/**
 * Change hex code to RGB
 * Source: https://css-tricks.com/snippets/php/convert-hex-to-rgb/#comment-1052011
 */
function spacious_hex2rgb( $hexstr ) {
	$int = hexdec( str_replace( '#', '', $hexstr ) );

	$rgb = array( "red" => 0xFF & ( $int >> 0x10 ), "green" => 0xFF & ( $int >> 0x8 ), "blue" => 0xFF & $int );
	$r   = $rgb['red'];
	$g   = $rgb['green'];
	$b   = $rgb['blue'];

	return "rgba($r,$g,$b, 0.85)";
}

/**
 * Generate darker color
 * Source: http://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
 */
function spacious_darkcolor( $hex, $steps ) {
	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max( - 255, min( 255, $steps ) );

	// Normalize into a six character long hex string
	$hex = str_replace( '#', '', $hex );
	if ( strlen( $hex ) == 3 ) {
		$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
	}

	// Split into three parts: R, G and B
	$color_parts = str_split( $hex, 2 );
	$return      = '#';

	foreach ( $color_parts as $color ) {
		$color  = hexdec( $color ); // Convert to decimal
		$color  = max( 0, min( 255, $color + $steps ) ); // Adjust color
		$return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
	}

	return $return;
}

/****************************************************************************************/

/**
 * Hooks the Custom Internal CSS to head section
 */
function spacious_custom_css() {
	$primary_color         = spacious_options( 'spacious_primary_color', '#0FBE7C' );
	$primary_opacity       = spacious_hex2rgb( $primary_color );
	$primary_dark          = spacious_darkcolor( $primary_color, - 50 );
	$spacious_internal_css = '';
	if ( $primary_color != '#0FBE7C' ) {
		$spacious_internal_css .= ' blockquote { border-left: 3px solid ' . $primary_color . '; }
			.spacious-button, input[type="reset"], input[type="button"], input[type="submit"], button { background-color: ' . $primary_color . '; }
			.previous a:hover, .next a:hover { 	color: ' . $primary_color . '; }
			a { color: ' . $primary_color . '; }
			#site-title a:hover { color: ' . $primary_color . '; }
			.main-navigation ul li.current_page_item a, .main-navigation ul li:hover > a { color: ' . $primary_color . '; }
			.main-navigation ul li ul { border-top: 1px solid ' . $primary_color . '; }
			.main-navigation ul li ul li a:hover, .main-navigation ul li ul li:hover > a, .main-navigation ul li.current-menu-item ul li a:hover, .main-navigation ul li:hover > .sub-toggle { color: ' . $primary_color . '; }
			.site-header .menu-toggle:hover.entry-meta a.read-more:hover,#featured-slider .slider-read-more-button:hover,.call-to-action-button:hover,.entry-meta .read-more-link:hover,.spacious-button:hover, input[type="reset"]:hover, input[type="button"]:hover, input[type="submit"]:hover, button:hover { background: ' . $primary_dark . '; }
			.main-small-navigation li:hover { background: ' . $primary_color . '; }
			.main-small-navigation ul > .current_page_item, .main-small-navigation ul > .current-menu-item { background: ' . $primary_color . '; }
			.main-navigation a:hover, .main-navigation ul li.current-menu-item a, .main-navigation ul li.current_page_ancestor a, .main-navigation ul li.current-menu-ancestor a, .main-navigation ul li.current_page_item a, .main-navigation ul li:hover > a  { color: ' . $primary_color . '; }
			.small-menu a:hover, .small-menu ul li.current-menu-item a, .small-menu ul li.current_page_ancestor a, .small-menu ul li.current-menu-ancestor a, .small-menu ul li.current_page_item a, .small-menu ul li:hover > a { color: ' . $primary_color . '; }
			#featured-slider .slider-read-more-button { background-color: ' . $primary_color . '; }
			#controllers a:hover, #controllers a.active { background-color: ' . $primary_color . '; color: ' . $primary_color . '; }
			.widget_service_block a.more-link:hover, .widget_featured_single_post a.read-more:hover,#secondary a:hover,logged-in-as:hover  a,.single-page p a:hover{ color: ' . $primary_dark . '; }
			.breadcrumb a:hover { color: ' . $primary_color . '; }
			.tg-one-half .widget-title a:hover, .tg-one-third .widget-title a:hover, .tg-one-fourth .widget-title a:hover { color: ' . $primary_color . '; }
			.pagination span ,.site-header .menu-toggle:hover{ background-color: ' . $primary_color . '; }
			.pagination a span:hover { color: ' . $primary_color . '; border-color: ' . $primary_color . '; }
			.widget_testimonial .testimonial-post { border-color: ' . $primary_color . ' #EAEAEA #EAEAEA #EAEAEA; }
			.call-to-action-content-wrapper { border-color: #EAEAEA #EAEAEA #EAEAEA ' . $primary_color . '; }
			.call-to-action-button { background-color: ' . $primary_color . '; }
			#content .comments-area a.comment-permalink:hover { color: ' . $primary_color . '; }
			.comments-area .comment-author-link a:hover { color: ' . $primary_color . '; }
			.comments-area .comment-author-link span { background-color: ' . $primary_color . '; }
			.comment .comment-reply-link:hover { color: ' . $primary_color . '; }
			.nav-previous a:hover, .nav-next a:hover { color: ' . $primary_color . '; }
			#wp-calendar #today { color: ' . $primary_color . '; }
			.widget-title span { border-bottom: 2px solid ' . $primary_color . '; }
			.footer-widgets-area a:hover { color: ' . $primary_color . ' !important; }
			.footer-socket-wrapper .copyright a:hover { color: ' . $primary_color . '; }
			a#back-top:before { background-color: ' . $primary_color . '; }
			.read-more, .more-link { color: ' . $primary_color . '; }
			.post .entry-title a:hover, .page .entry-title a:hover { color: ' . $primary_color . '; }
			.post .entry-meta .read-more-link { background-color: ' . $primary_color . '; }
			.post .entry-meta a:hover, .type-page .entry-meta a:hover { color: ' . $primary_color . '; }
			.single #content .tags a:hover { color: ' . $primary_color . '; }
			.widget_testimonial .testimonial-icon:before { color: ' . $primary_color . '; }
			a#scroll-up { background-color: ' . $primary_color . '; }
			.search-form span { background-color: ' . $primary_color . '; }.header-action .search-wrapper:hover .fa{ color: ' . $primary_color . '} .spacious-woocommerce-cart-views .cart-value { background:' . $primary_color . '}.main-navigation .tg-header-button-wrap.button-one a{background-color:' . $primary_color . '} .main-navigation .tg-header-button-wrap.button-one a{border-color:' . $primary_color . '}.main-navigation .tg-header-button-wrap.button-one a:hover{background-color:' . $primary_dark . '}.main-navigation .tg-header-button-wrap.button-one a:hover{border-color:' . $primary_dark . '}';
	}

	/* Typography */
	// Font family option.
	if ( spacious_options( 'spacious_titles_font', 'Lato' ) != 'Lato' ) {
		$spacious_internal_css .= ' h1, h2, h3, h4, h5, h6 { font-family: ' . spacious_options( 'spacious_titles_font', 'Lato' ) . '; }';
	}
	if ( spacious_options( 'spacious_content_font', 'Lato' ) != 'Lato' ) {
		$spacious_internal_css .= ' body, button, input, select, textarea, p, .entry-meta, .read-more, .more-link, .widget_testimonial .testimonial-author, #featured-slider .slider-read-more-button { font-family: ' . spacious_options( 'spacious_content_font', 'Lato' ) . '; }';
	}

	if ( ! empty( $spacious_internal_css ) ) {
		?>
		<style type="text/css"><?php echo $spacious_internal_css; ?></style>
		<?php
	}

	$spacious_custom_css = spacious_options( 'spacious_custom_css' );
	if ( $spacious_custom_css && ! function_exists( 'wp_update_custom_css_post' ) ) {
		?>
		<style type="text/css"><?php echo $spacious_custom_css; ?></style>
		<?php
	}
}

add_action( 'wp_head', 'spacious_custom_css', 100 );

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
			$next     = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous ) {
				return;
			}
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

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

		</nav>
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
				<p><?php _e( 'Pingback:', 'spacious' ); ?><?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'spacious' ), '<span class="edit-link">', '</span>' ); ?></p>
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
						printf( __( '<a class="comment-permalink" href="%1$s">Permalink</a>', 'spacious' ), esc_url( get_comment_link( $comment->comment_ID ) ) );
						edit_comment_link();
						?>
					</header><!-- .comment-meta -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'spacious' ); ?></p>
					<?php endif; ?>

					<section class="comment-content comment">
						<?php comment_text(); ?>
						<?php comment_reply_link( array_merge( $args, array(
							'reply_text' => __( 'Reply', 'spacious' ),
							'after'      => '',
							'depth'      => $depth,
							'max_depth'  => $args['max_depth'],
						) ) ); ?>
					</section><!-- .comment-content -->

				</article><!-- #comment-## -->
				<?php
				break;
		endswitch; // end comment_type check
	}
endif;

/**************************************************************************************/

/**
 * function to show the footer info, copyright information
 */
if ( ! function_exists( 'spacious_footer_copyright' ) ) :
	function spacious_footer_copyright() {
		$site_link = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';

		$wp_link = '<a href="' . esc_url( 'https://wordpress.org' ) . '" target="_blank" title="' . esc_attr__( 'WordPress', 'spacious' ) . '"><span>' . __( 'WordPress', 'spacious' ) . '</span></a>';

		$tg_link = '<a href="' . esc_url( 'https://themegrill.com/themes/spacious' ) . '" target="_blank" title="' . esc_attr__( 'ThemeGrill', 'spacious' ) . '" rel="author"><span>' . __( 'ThemeGrill', 'spacious' ) . '</span></a>';

		$default_footer_value = sprintf( __( 'Copyright &copy; %1$s %2$s.', 'spacious' ), date( 'Y' ), $site_link ) . ' ' . sprintf( __( 'Powered by %s.', 'spacious' ), $wp_link ) . ' ' . sprintf( __( 'Theme: %1$s by %2$s.', 'spacious' ), 'Spacious', $tg_link );

		$spacious_footer_copyright = '<div class="copyright">' . $default_footer_value . '</div>';
		echo $spacious_footer_copyright;
	}
endif;
add_action( 'spacious_footer_copyright', 'spacious_footer_copyright', 10 );

/**************************************************************************************/

if ( ! function_exists( 'spacious_posts_listing_display_type_select' ) ) :
	/**
	 * Function to select the posts listing display type
	 */
	function spacious_posts_listing_display_type_select() {
		if ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_large' ) {
			$format = 'blog-image-large';
		} elseif ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_medium' ) {
			$format = 'blog-image-medium';
		} elseif ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_medium_alternate' ) {
			$format = 'blog-image-medium';
		} elseif ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_full_content' ) {
			$format = 'blog-full-content';
		} else {
			$format = get_post_format();
		}

		return $format;
	}
endif;

/****************************************************************************************/

/**
 * sanitize the input for custom css
 */
function spacious_sanitize_textarea_custom( $input, $option ) {
	if ( $option['id'] == "spacious_custom_css" ) {
		$output = wp_filter_nohtml_kses( $input );
	} else {
		$output = $input;
	}

	return $output;
}

/**
 * Override the default textarea sanitization.
 */
function spacious_textarea_sanitization_change() {
	remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
	add_filter( 'of_sanitize_textarea', 'spacious_sanitize_textarea_custom', 10, 2 );
}

add_action( 'admin_init', 'spacious_textarea_sanitization_change', 100 );

/****************************************************************************************/

if ( ! function_exists( 'spacious_entry_meta' ) ) :
	/**
	 * Shows meta information of post.
	 */
	function spacious_entry_meta( $spacious_show_readmore = true ) {
		if ( 'post' == get_post_type() ) :
			echo '<footer class="entry-meta-bar clearfix">';
			echo '<div class="entry-meta clearfix">';
			?>

			<span class="by-author author vcard"><a class="url fn n"
			                                        href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span>

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
			);

			if ( has_category() ) { ?>
				<span class="category"><?php the_category( ', ' ); ?></span>
				<?php
			}

			if ( comments_open() ) {
				?>
				<span
					class="comments"><?php comments_popup_link( __( 'No Comments', 'spacious' ), __( '1 Comment', 'spacious' ), __( '% Comments', 'spacious' ), '', __( 'Comments Off', 'spacious' ) ); ?></span>
			<?php }

			edit_post_link( __( 'Edit', 'spacious' ), '<span class="edit-link">', '</span>' );

			if ( ( ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) != 'blog_full_content' ) && ! is_single() ) || is_archive() || is_search() ) {
				if ( $spacious_show_readmore ) { ?>
					<span class="read-more-link">
						<a class="read-more"
						   href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'spacious' ); ?></a>
					</span>
					<?php
				}
			}

			echo '</div>';
			echo '</footer>';
		endif;
	}
endif;

/**************************************************************************************/

/**
 * Making the theme Woocommrece compatible
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

add_filter( 'woocommerce_show_page_title', '__return_false' );

add_action( 'woocommerce_before_main_content', 'spacious_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'spacious_wrapper_end', 10 );

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

if ( class_exists( 'woocommerce' ) && ! function_exists( 'spacious_is_in_woocommerce_page' ) ):
	/*
	 * woocommerce - conditional to check if woocommerce related page showed
	 */
	function spacious_is_in_woocommerce_page() {
		return ( is_shop() || is_product_category() || is_product_tag() || is_product() || is_cart() || is_checkout() || is_account_page() ) ? true : false;
	}
endif;


// Displays the site logo
if ( ! function_exists( 'spacious_the_custom_logo' ) ) {
	/**
	 * Displays the optional custom logo.
	 */
	function spacious_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
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
			$themename = preg_replace( "/\W/", "_", strtolower( $themename ) );

			$core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
			$return   = wp_update_custom_css_post( $core_css . $custom_css );

			if ( ! is_wp_error( $return ) ) {
				$theme_options = get_option( $themename );
				// Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
				if ( isset( $theme_options['spacious_custom_css'] ) ) {
					unset( $theme_options['spacious_custom_css'] );
				}

				// Finally, update spacious theme options.
				update_option( $themename, $theme_options );
			}
		}
	}
}

add_action( 'after_setup_theme', 'spacious_custom_css_migrate' );

/**
 * Transfer header designs options to header display type.
 */
function spacious_site_header_migrate() {

	if ( get_option( 'spacious_site_header_migrate' ) ) {
		return;
	}

	$spacious_header_design = spacious_options( 'spacious_header_design', 'style_one' );

	// Get theme options.
	$theme_options = get_option( 'spacious' );

	if ( 'style_two' === $spacious_header_design ) {

		// Set header display type to 4
		$theme_options['spacious_header_display_type'] = 'four';

	}

	// Remove header designs from database.
	unset( $theme_options['spacious_header_design'] );

	// Finally, update spacious theme options.
	update_option( 'spacious', $theme_options );

	update_option( 'spacious_site_header_migrate', 1 );

}

add_action( 'after_setup_theme', 'spacious_site_header_migrate' );

/**
 * Remove footer designs options
 */
function spacious_site_footer_designs_eliminate() {

	if ( get_option( 'spacious_site_footer_eliminate' ) ) {
		return;
	}

	$spacious_footer_design = spacious_options( 'spacious_footer_design', 'style_one' );

	if ( $spacious_footer_design ) {

		// Get theme options.
		$theme_options = get_option( 'spacious' );

		// Remove footer designs data from db.
		unset( $theme_options['spacious_footer_design'] );

		// Finally, update spacious theme options.
		update_option( 'spacious', $theme_options );

		// Set a flag.
		update_option( 'spacious_site_footer_eliminate', 1 );

	}

}

add_action( 'after_setup_theme', 'spacious_site_footer_designs_eliminate' );

if ( ! function_exists( 'spacious_pingback_header' ) ) :

	/**
	 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
	 */
	function spacious_pingback_header() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}

endif;

add_action( 'wp_head', 'spacious_pingback_header' );

/**
 * Migrate script to migrate `spacious[spacious_header_display_type]` to
 * `themefolder[spacious_header_display_type]`.
 *
 * @since 1.5.9
 */
function spacious_header_display_type_migrate() {

	$spacious_options = get_option( 'spacious' );

	// Return if `spacious` options is not found.
	if ( ! $spacious_options ) {
		return;
	}

	// Return if `spacious_header_display_type_migrate` options is set.
	if ( get_option( 'spacious_header_display_type_migrate' ) ) {
		return;
	}

	/**
	 * Assigning the theme name.
	 */
	$spacious_themename = get_option( 'stylesheet' );
	$spacious_themename = preg_replace( "/\W/", "_", strtolower( $spacious_themename ) );

	// Store the old value.
	$spacious_header_display_type = $spacious_options['spacious_header_display_type'];

	// Ready to update the value for saving in `themefolder[spacious_header_display_type]` table.
	$spacious_options_table                                 = get_option( $spacious_themename );
	$spacious_options_table['spacious_header_display_type'] = $spacious_header_display_type;

	// Migrate the final array to $spacious_themename table.
	if ( $spacious_header_display_type ) {
		update_option( $spacious_themename, $spacious_options_table );
	}

	// Finally, set the flag to stop executing the script on each load of page.
	update_option( 'spacious_header_display_type_migrate', 'yes' );

}

add_action( 'after_setup_theme', 'spacious_header_display_type_migrate' );

function spacious_header_menu_button( $items, $args ) {
	$button_text   = spacious_options( 'spacious_header_button_one_setting' );
	$button_link   = spacious_options( 'spacious_header_button_one_link' );
	$button_target = spacious_options( 'spacious_header_button_one_tab' );
	$button_target = $button_target ? ' target="_blank"' : '';

	if ( 'primary' === $args->theme_location && $button_link ) {

		$items .= '<li class="menu-item tg-header-button-wrap button-one">';
		$items .= '<a href="' . esc_url( $button_link ) . '"' . esc_attr( $button_target ) . '>';
		$items .= $button_text;
		$items .= '</a>';
		$items .= '</li>';

	}

	return $items;
}

add_filter( 'wp_nav_menu_items', 'spacious_header_menu_button', 10, 2 );

if ( ! function_exists( 'spacious_shift_extra_menu' ) ) :
	/**
	 * Keep menu items on one line.
	 *
	 * @param string $items The HTML list content for the menu items.
	 * @param stdClass $args An object containing wp_nav_menu() arguments.
	 *
	 * @return string HTML for more button.
	 */
	function spacious_shift_extra_menu( $items, $args ) {

		if ( 'primary' === $args->theme_location && spacious_options( 'spacious_one_line_menu_setting', 0 ) ) :

			$items .= '<li class="menu-item menu-item-has-children tg-menu-extras-wrap">';
			$items .= '<span class="submenu-expand">';
			$items .= '<i class="fa fa-ellipsis-v"></i>';
			$items .= '</span>';
			$items .= '<ul class="sub-menu" id="tg-menu-extras">';
			$items .= '</ul>';
			$items .= '</li>';

		endif;

		return $items;
	}
endif;
add_filter( 'wp_nav_menu_items', 'spacious_shift_extra_menu', 12, 2 );

/**
 * Update image attributes for retina logo.
 *
 * @see spacious_change_logo_attr()
 */
if ( ! function_exists( 'spacious_change_logo_attr' ) ) :

	function spacious_change_logo_attr( $attr, $attachment, $size ) {
		$custom_logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
		$custom_logo = isset( $custom_logo[0] ) ? $custom_logo[0] : '';

		if ( isset( $attr['class'] ) && 'custom-logo' === $attr['class'] ) {

			if ( 1 == spacious_options( 'spacious_different_retina_logo', 0 ) ) {
				$retina_logo = spacious_options( 'spacious_retina_logo_upload' );

				if ( $retina_logo ) {
					$attr['srcset'] = $custom_logo . ' 1x, ' . $retina_logo . ' 2x';
				}
			}

		}

		return $attr;
	}

endif;

add_filter( 'wp_get_attachment_image_attributes', 'spacious_change_logo_attr', 10, 3 );


/**
 * Compare user's current version of plugin.
 */
if ( ! function_exists( 'spacious_plugin_version_compare' ) ) {
	function spacious_plugin_version_compare( $plugin_slug, $version_to_compare ) {

		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		$installed_plugins = get_plugins();

		// Plugin not installed.
		if ( ! isset( $installed_plugins[ $plugin_slug ] ) ) {
			return false;
		}

		$tdi_user_version = $installed_plugins[ $plugin_slug ]['Version'];

		return version_compare( $tdi_user_version, $version_to_compare, '<' );
	}
}
