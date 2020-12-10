<?php
/**
 * Spacious dynamic CSS generation file for theme options.
 *
 * Class Spacious_Dynamic_CSS
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 3.0.0
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
			'.previous a:hover, .next a:hover, a, #site-title a:hover,.widget_fun_facts .counter-icon,.team-title a:hover, .main-navigation ul li.current_page_item a, .main-navigation ul li:hover > a, .main-navigation ul li ul li a:hover, .main-navigation ul li ul li:hover > a,
			.main-navigation ul li.current-menu-item ul li a:hover, .main-navigation a:hover, .main-navigation ul li.current-menu-item a, .main-navigation ul li.current_page_ancestor a,
			.main-navigation ul li.current-menu-ancestor a, .main-navigation ul li.current_page_item a,
			.main-navigation ul li:hover > a, .small-menu a:hover, .small-menu ul li.current-menu-item a, .small-menu ul li.current_page_ancestor a,
			.small-menu ul li.current-menu-ancestor a, .small-menu ul li.current_page_item a,
			.small-menu ul li:hover > a, .widget_service_block a.more-link:hover, .widget_featured_single_post a.read-more:hover,
			#secondary a:hover,logged-in-as:hover  a, .breadcrumb a:hover, .tg-one-half .widget-title a:hover, .tg-one-third .widget-title a:hover,
			.tg-one-fourth .widget-title a:hover, .pagination a span:hover, #content .comments-area a.comment-permalink:hover, .comments-area .comment-author-link a:hover, .comment .comment-reply-link:hover, .nav-previous a:hover, .nav-next a:hover, #wp-calendar #today, .footer-socket-wrapper .copyright a:hover, .read-more, .more-link, .post .entry-title a:hover, .page .entry-title a:hover, .entry-meta a:hover, .type-page .entry-meta a:hover, .single #content .tags a:hover , .widget_testimonial .testimonial-icon:before, .widget_featured_posts .tg-one-half .entry-title a:hover, .main-small-navigation li:hover > .sub-toggle, .main-navigation ul li.tg-header-button-wrap.button-two a, .main-navigation ul li.tg-header-button-wrap.button-two a:hover, .woocommerce.woocommerce-add-to-cart-style-2 ul.products li.product .button, .header-action .search-wrapper:hover .fa, .woocommerce .star-rating span::before, .main-navigation ul li:hover > .sub-toggle' => array(
				'color' => esc_html( $primary_color ),
			),
			'.spacious-button, input[type="reset"], input[type="button"], input[type="submit"], button,.spacious-woocommerce-cart-views .cart-value, #featured-slider .slider-read-more-button, .slider-cycle .cycle-prev, .slider-cycle .cycle-next, #progress, .widget_our_clients .clients-cycle-prev, .widget_our_clients .clients-cycle-next, #controllers a:hover, #controllers a.active, .pagination span,.site-header .menu-toggle:hover,#team-controllers a.active,	#team-controllers a:hover, .call-to-action-button, .call-to-action-button, .comments-area .comment-author-link spanm,.team-social-icon a:hover, a#back-top:before, .entry-meta .read-more-link, a#scroll-up, #search-form span, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button,	.woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button,	.woocommerce-page #respond input#submit, .woocommerce-page #content input.button, .woocommerce a.button:hover,.woocommerce button.button:hover, .woocommerce input.button:hover,.woocommerce #respond input#submit:hover, .woocommerce #content input.button:hover,.woocommerce-page a.button:hover, .woocommerce-page button.button:hover,.woocommerce-page input.button:hover,	.woocommerce-page #respond input#submit:hover, .woocommerce-page #content input.button:hover, #content .wp-pagenavi .current, #content .wp-pagenavi a:hover,.main-small-navigation .sub-toggle, .main-navigation ul li.tg-header-button-wrap.button-one a, .elementor .team-five-carousel.team-style-five .swiper-button-next, .elementor .team-five-carousel.team-style-five .swiper-button-prev, .elementor .main-block-wrapper .swiper-button-next, .elementor .main-block-wrapper .swiper-button-prev, .woocommerce-product .main-product-wrapper .product-container .product-cycle-prev, .woocommerce-product .main-product-wrapper .product-container .product-cycle-next' => array(
				'background-color' => esc_html( $primary_color ),
			),
			'.main-small-navigation li:hover, .main-small-navigation ul > .current_page_item, .main-small-navigation ul > .current-menu-item, .widget_testimonial .testimonial-cycle-prev, .widget_testimonial .testimonial-cycle-next, .woocommerce-product .main-product-wrapper .product-wrapper .woocommerce-image-wrapper-two .hovered-cart-wishlist .add-to-wishlist:hover, .woocommerce-product .main-product-wrapper .product-wrapper .woocommerce-image-wrapper-two .hovered-cart-wishlist .add-to-cart:hover, .woocommerce-product .main-product-wrapper .product-wrapper .product-outer-wrapper .woocommerce-image-wrapper-one .add-to-cart a:hover' => array(
				'background' => esc_html( $primary_color ),
			),
			'.main-navigation ul li ul, .widget_testimonial .testimonial-post' => array(
				'border-top-color' => esc_html( $primary_color ),
			),
			'blockquote, .call-to-action-content-wrapper' => array(
				'border-left-color' => esc_html( $primary_color ),
			),
			'.site-header .menu-toggle:hover.entry-meta a.read-more:hover,
			#featured-slider .slider-read-more-button:hover, .slider-cycle .cycle-prev:hover, .slider-cycle .cycle-next:hover,
			.call-to-action-button:hover,.entry-meta .read-more-link:hover,.spacious-button:hover, input[type="reset"]:hover,
			input[type="button"]:hover, input[type="submit"]:hover, button:hover, .main-navigation ul li.tg-header-button-wrap.button-one a:hover, .main-navigation ul li.tg-header-button-wrap.button-two a:hover' => array(
				'background' => esc_html( $primary_dark ),
			),
			'.pagination a span:hover, .widget_testimonial .testimonial-post, .team-social-icon a:hover, .single #content .tags a:hover,.previous a:hover, .next a:hover, .main-navigation ul li.tg-header-button-wrap.button-one a, .main-navigation ul li.tg-header-button-wrap.button-one a, .main-navigation ul li.tg-header-button-wrap.button-two a, .woocommerce.woocommerce-add-to-cart-style-2 ul.products li.product .button, .woocommerce-product .main-product-wrapper .product-wrapper .woocommerce-image-wrapper-two .hovered-cart-wishlist .add-to-wishlist, .woocommerce-product .main-product-wrapper .product-wrapper .woocommerce-image-wrapper-two .hovered-cart-wishlist .add-to-cart' => array(
				'border-color' => esc_html( $primary_color ),
			),
			'.widget-title span' => array(
				'border-bottom-color' => esc_html( $primary_color ),
			),
			'.footer-widgets-area a:hover' => array(
				'color' => esc_html( $primary_color ) . '!important',
			),
			'.footer-search-form' => array(
				'color' => spacious_hex2rgb( esc_html( $primary_color ) ),
			),
			'.header-toggle-wrapper .header-toggle' => array(
				'border-right-color' => esc_html( $primary_color ),
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
			'body, button, input, select, textarea, p, .entry-meta, .read-more, .more-link, .widget_testimonial .testimonial-author, #featured-slider .slider-read-more-button',
		);

		// Heading typography.
		$parse_css .= spacious_parse_typography_css(
			$spacious_titles_font,
			$heading_typography,
			'h1, h2, h3, h4, h5, h6',
		);

		// Add the custom CSS rendered dynamically, which is static.
		$parse_css .= self::render_custom_output();


		$parse_css .= $dynamic_css;

		return apply_filters( 'spacious_theme_dynamic_css', $parse_css );

	}

}
