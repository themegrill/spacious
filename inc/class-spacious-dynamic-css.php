<?php
/**
 * Spacious dynamic CSS generation file for theme options.
 *
 * Class Spacious_Dynamic_CSS
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 1.9.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Spacious dynamic CSS generation file for theme options.
 *
 * Class Spacious_Dynamic_CSS
 */
class Spacious_Dynamic_CSS {

	/**
	 * Return dynamic CSS output.
	 *
	 * @param string $dynamic_css Dynamic CSS.
	 * @param string $dynamic_css_filtered Dynamic CSS Filters.
	 *
	 * @return string Generated CSS.
	 */
	public static function render_output( $dynamic_css, $dynamic_css_filtered = '' ) {

		/**
		 * Variable declarations.
		 */

		$primary_color         = get_theme_mod( 'spacious_primary_color', '#0FBE7C' );
		$primary_opacity       = spacious_hex2rgb( $primary_color );
		$primary_dark          = spacious_darkcolor( $primary_color, -50 );

		/**
		 * Typography options.
		 */
		$spacious_content_font = array(
			'font-family' => 'Lato',
			'font-weight' => 'regular',
		);

		$spacious_titles_font = array(
			'font-family' => 'Lato',
			'font-weight' => 'regular',
		);


		$base_typography                                     = get_theme_mod( 'spacious_content_font_typography', $spacious_content_font );
		$heading_typography                                  = get_theme_mod( 'spacious_titles_font_typography', $spacious_titles_font );

		// Generate dynamic CSS.
		$parse_css = '';

		// For primary color option.
		$primary_color_css = array(
			'.previous a:hover, .next a:hover, a, #site-title a:hover, .main-navigation ul li.current_page_item a, .main-navigation ul li:hover > a, .main-navigation ul li ul li a:hover, .main-navigation ul li ul li:hover > a, .main-navigation ul li.current-menu-item ul li a:hover, .main-navigation ul li:hover > .sub-toggle, .main-navigation a:hover, .main-navigation ul li.current-menu-item a, .main-navigation ul li.current_page_ancestor a, .main-navigation ul li.current-menu-ancestor a, .main-navigation ul li.current_page_item a, .main-navigation ul li:hover > a, .small-menu a:hover, .small-menu ul li.current-menu-item a, .small-menu ul li.current_page_ancestor a, .small-menu ul li.current-menu-ancestor a, .small-menu ul li.current_page_item a, .small-menu ul li:hover > a, .breadcrumb a:hover, .tg-one-half .widget-title a:hover, .tg-one-third .widget-title a:hover, .tg-one-fourth .widget-title a:hover, .pagination a span:hover, #content .comments-area a.comment-permalink:hover, .comments-area .comment-author-link a:hover, .comment .comment-reply-link:hover, .nav-previous a:hover, .nav-next a:hover, #wp-calendar #today, .footer-widgets-area a:hover, .footer-socket-wrapper .copyright a:hover, .read-more, .more-link, .post .entry-title a:hover, .page .entry-title a:hover, .post .entry-meta a:hover, .type-page .entry-meta a:hover, .single #content .tags a:hover, .widget_testimonial .testimonial-icon:before, .header-action .search-wrapper:hover .fa' => array(
				'color' => esc_html( $primary_color ),
			),
			'.spacious-button, input[type="reset"], input[type="button"], input[type="submit"], button, #featured-slider .slider-read-more-button, #controllers a:hover, #controllers a.active, .pagination span ,.site-header .menu-toggle:hover, .call-to-action-button, .comments-area .comment-author-link span, a#back-top:before, .post .entry-meta .read-more-link, a#scroll-up, .search-form span, .main-navigation .tg-header-button-wrap.button-one a' => array(
				'background-color' => esc_html( $primary_color ),
			),
			'.main-small-navigation li:hover, .main-small-navigation ul > .current_page_item, .main-small-navigation ul > .current-menu-item, .spacious-woocommerce-cart-views .cart-value' => array(
				'background' => esc_html( $primary_color ),
			),
			'.main-navigation ul li ul, .widget_testimonial .testimonial-post' => array(
				'border-top-color' => esc_html( $primary_color ),
			),
			'blockquote, .call-to-action-content-wrapper' => array(
				'border-left-color' => esc_html( $primary_color ),
			),
			'.site-header .menu-toggle:hover.entry-meta a.read-more:hover,#featured-slider .slider-read-more-button:hover,.call-to-action-button:hover,.entry-meta .read-more-link:hover,.spacious-button:hover, input[type="reset"]:hover, input[type="button"]:hover, input[type="submit"]:hover, button:hover' => array(
				'background' => esc_html( $primary_dark ),
			),
			'.pagination a span:hover, .main-navigation .tg-header-button-wrap.button-one a' => array(
				'border-color' => esc_html( $primary_color ),
			),
			'.widget-title span' => array(
				'border-bottom-color' => esc_html( $primary_color ),
			),
			'.widget_service_block a.more-link:hover, .widget_featured_single_post a.read-more:hover,#secondary a:hover,logged-in-as:hover  a,.single-page p a:hover' => array(
				'color' => esc_html( $primary_dark ),
			),
			'.main-navigation .tg-header-button-wrap.button-one a:hover' => array(
				'border-color' => esc_html( $primary_dark ) ,
			),
			'.main-navigation .tg-header-button-wrap.button-one a:hover' => array(
				'background-color' => esc_html( $primary_dark ),
			),
		);

		$parse_css .= spacious_parse_css( '#0FBE7C', $primary_color, $primary_color_css );

		/**
		 * Typography options.
		 */
		// Base typography.
		$parse_css .= spacious_parse_typography_css(
			$spacious_content_font,
			$base_typography,
			'body, button, input, select, textarea, p, .entry-meta, .read-more, .more-link, .widget_testimonial .testimonial-author, #featured-slider .slider-read-more-button'
		);

		// Heading typography.
		$parse_css .= spacious_parse_typography_css(
			$spacious_titles_font,
			$heading_typography,
			'h1, h2, h3, h4, h5, h6'
		);

		$parse_css .= $dynamic_css;

		return apply_filters( 'spacious_theme_dynamic_css', $parse_css );

	}

}
