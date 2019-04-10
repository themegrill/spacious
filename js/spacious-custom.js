jQuery( document ).ready( function () {
	jQuery( '#scroll-up' ).hide();
	jQuery( function () {
		jQuery( window ).scroll( function () {
			if ( jQuery( this ).scrollTop() > 1000 ) {
				jQuery( '#scroll-up').fadeIn();
			} else {
				jQuery( '#scroll-up' ).fadeOut();
			}
		});
		jQuery( 'a#scroll-up' ).click( function () {
			jQuery( 'body, html' ).animate({
				scrollTop: 0
			}, 800 );
			return false;
		});
	});

	/**
	 * Responsive menu with toggle
	 */
	 jQuery('.better-responsive-menu .menu-primary-container .menu-item-has-children').
	 append('<span class="sub-toggle"> <span class="fa fa-caret-right"></span> </span>');

	 jQuery('.better-responsive-menu .menu-primary-container .sub-toggle').click(function() {
		jQuery(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
		jQuery(this).children('.sub-toggle .fa').first().toggleClass('fa-caret-down fa-caret-right');
	});

	/**
	 * Search
	 */
	var hideSearchForm = function() {
		jQuery( '.header-search-form' ).removeClass( 'show' );
	};

	// On Search icon click.
	jQuery( '#header-right-section .search, .bottom-menu .search' ).click( function () {
		jQuery( this ).next( '.header-search-form' ).toggleClass( 'show' );

		// focus after some time to fix conflict with toggleClass
		setTimeout( function () {
			jQuery( '.header-search-form.show input' ).focus();
		}, 200 );

		// For esc key press.
		jQuery( document ).on( 'keyup', function ( e ) {

			// on esc key press.
			if ( 27 === e.keyCode ) {
				// if search box is opened
				if ( jQuery( '.header-search-form' ).hasClass( 'show' ) ) {
					hideSearchForm();
				}

			}
		} );

		jQuery( document ).on( 'click.outEvent', function( e ) {
			if ( e.target.closest( '.search-wrapper' )  ) {
				return;
			}

			hideSearchForm();

			// Unbind current click event.
			jQuery( document ).off( 'click.outEvent' );
		} );

	} );
});

/**
 * Slider Setting
 *
 * Contains all the slider settings for the featured post/page slider.
 */
jQuery(window).on('load',function() {
	if ( typeof jQuery.fn.cycle !== 'undefined' ) {
		jQuery( '.slider-cycle' ).cycle( {
			fx               : 'fade',
			timeout          : 4000,
			speed            : 1000,
			slides           : '> div',
			pager            : '> #controllers',
			pagerActiveClass : 'active',
			pagerTemplate    : '<a></a>',
			pauseOnHover     : true,
			autoHeight       : 'container',
			swipe            : true,
			swipeFx          : 'scrollHorz',
			log              : false
		} );
	}
});

