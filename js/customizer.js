/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function ( $ ) {

	// Site title
	wp.customize( 'blogname', function ( value ) {
		value.bind( function ( to ) {
			$( '#site-title a' ).text( to );
		} );
	} );

	// Site description.
	wp.customize( 'blogdescription', function ( value ) {
		value.bind( function ( to ) {
			$( '#site-description' ).text( to );
		} );
	} );

	// Header text color
	wp.customize( 'header_textcolor', function ( value ) {
		value.bind( function ( headerTextColor ) {
			$( '#site-title a, #site-description' ).css( {
				'color': headerTextColor
			} );
		} );
	} );

	// Primary color option
	wp.customize( 'spacious[spacious_primary_color]', function ( value ) {
		value.bind( function ( primaryColor ) {
			// Store internal style for primary color
			var primaryColorStyle = '<style id="spacious-internal-primary-color"> blockquote { border-left: 3px solid ' + primaryColor + '; }' +
			'.spacious-button, input[type="reset"], input[type="button"], input[type="submit"], button { background-color: ' + primaryColor + '; }' +
			'.previous a:hover, .next a:hover { 	color: ' + primaryColor + '; }' +
			'a { color: ' + primaryColor + '; }' +
			'#site-title a:hover { color: ' + primaryColor + '; }' +
			'.main-navigation ul li.current_page_item a, .main-navigation ul li:hover > a { color: ' + primaryColor + '; }' +
			'.main-navigation ul li ul { border-top: 1px solid ' + primaryColor + '; }' +
			'.main-navigation ul li ul li a:hover, .main-navigation ul li ul li:hover > a, .main-navigation ul li.current-menu-item ul li a:hover, .main-navigation ul li:hover > .sub-toggle { color: ' + primaryColor + '; }' +
			'.main-small-navigation li:hover { background: ' + primaryColor + '; }' +
			'.main-small-navigation ul > .current_page_item, .main-small-navigation ul > .current-menu-item { background: ' + primaryColor + '; }' +
			'.main-navigation a:hover, .main-navigation ul li.current-menu-item a, .main-navigation ul li.current_page_ancestor a, .main-navigation ul li.current-menu-ancestor a, .main-navigation ul li.current_page_item a, .main-navigation ul li:hover > a  { color: ' + primaryColor + '; }' +
			'.small-menu a:hover, .small-menu ul li.current-menu-item a, .small-menu ul li.current_page_ancestor a, .small-menu ul li.current-menu-ancestor a, .small-menu ul li.current_page_item a, .small-menu ul li:hover > a { color: ' + primaryColor + '; }' +
			'#featured-slider .slider-read-more-button { background-color: ' + primaryColor + '; }' +
			'#controllers a:hover, #controllers a.active { background-color: ' + primaryColor + '; color: ' + primaryColor + '; }' +
			'.breadcrumb a:hover { color: ' + primaryColor + '; }' +
			'.tg-one-half .widget-title a:hover, .tg-one-third .widget-title a:hover, .tg-one-fourth .widget-title a:hover { color: ' + primaryColor + '; }' +
			'.pagination span ,.site-header .menu-toggle:hover{ background-color: ' + primaryColor + '; }' +
			'.pagination a span:hover { color: ' + primaryColor + '; border-color: ' + primaryColor + '; }' +
			'.widget_testimonial .testimonial-post { border-color: ' + primaryColor + ' #EAEAEA #EAEAEA #EAEAEA; }' +
			'.call-to-action-content-wrapper { border-color: #EAEAEA #EAEAEA #EAEAEA ' + primaryColor + '; }' +
			'.call-to-action-button { background-color: ' + primaryColor + '; }' +
			'#content .comments-area a.comment-permalink:hover { color: ' + primaryColor + '; }' +
			'.comments-area .comment-author-link a:hover { color: ' + primaryColor + '; }' +
			'.comments-area .comment-author-link span { background-color: ' + primaryColor + '; }' +
			'.comment .comment-reply-link:hover { color: ' + primaryColor + '; }' +
			'.nav-previous a:hover, .nav-next a:hover { color: ' + primaryColor + '; }' +
			'#wp-calendar #today { color: ' + primaryColor + '; }' +
			'.widget-title span { border-bottom: 2px solid ' + primaryColor + '; }' +
			'.footer-widgets-area a:hover { color: ' + primaryColor + ' !important; }' +
			'.footer-socket-wrapper .copyright a:hover { color: ' + primaryColor + '; }' +
			'a#back-top:before { background-color: ' + primaryColor + '; }' +
			'.read-more, .more-link { color: ' + primaryColor + '; }' +
			'.post .entry-title a:hover, .page .entry-title a:hover { color: ' + primaryColor + '; }' +
			'.post .entry-meta .read-more-link { background-color: ' + primaryColor + '; }' +
			'.post .entry-meta a:hover, .type-page .entry-meta a:hover { color: ' + primaryColor + '; }' +
			'.single #content .tags a:hover { color: ' + primaryColor + '; }' +
			'.widget_testimonial .testimonial-icon:before { color: ' + primaryColor + '; }' +
			'a#scroll-up { background-color: ' + primaryColor + '; }' +
			'.search-form span { background-color: ' + primaryColor + '; } </style>';

			// Remove previously create internal style and add new one.
			$( 'head #spacious-internal-primary-color' ).remove();
			$( 'head' ).append( primaryColorStyle );
		}
		);
	} );

})( jQuery );
