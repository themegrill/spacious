/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */
( function () {
	var container, button, menu, links, i, len;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByClassName( 'menu-toggle' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	if ( - 1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function () {
		if ( - 1 !== container.className.indexOf( 'main-small-navigation' ) ) {
			container.className = container.className.replace( 'main-small-navigation', 'main-navigation' );
		} else {
			container.className = container.className.replace( 'main-navigation', 'main-small-navigation' );
		}
	};

	// Get all the link elements within the menu.
	links = menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {
			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}
} )();

// Show Submenu on click on touch enabled deviced
( function () {
	var container;
	container = document.getElementById( 'site-navigation' );

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function ( container ) {
		var touchStartFn, i,
		    parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( ( 'ontouchstart' in window ) && ( window.matchMedia( "( min-width: 768px ) " ).matches ) ) {
			touchStartFn = function ( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++ i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++ i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );
} )();

/**
 * Fix: Menu out of view port
 */
( function () {

	var subMenu;

	jQuery( '.main-navigation ul li.menu-item-has-children a, .main-navigation ul li.page_item_has_children a' ).on( {

		'mouseover touchstart' : function () {

			function isElementInViewport( subMenu ) {

				if ( 'function' === typeof jQuery && subMenu instanceof jQuery ) {
					subMenu = subMenu[0];
				}

				// In case browser doesn't support getBoundingClientRect function.
				if ( 'function' === typeof subMenu.getBoundingClientRect ) {

					var rect = subMenu.getBoundingClientRect();

					if ( rect.right + 2 > ( window.innerWidth || document.documentElement.clientWidth ) ) {
						return 'spacious-menu--left'; // menu goes out of viewport from right.
					} else if ( rect.left < 0 ) {
						return 'spacious-menu--right'; // menu goes out of viewport from left.
					} else {
						return false;
					}
				}
			}

			subMenu = jQuery( this ).next( '.sub-menu, .children' );

			// If menu item has submenu
			if ( subMenu.length > 0 ) {

				var viewportClass = isElementInViewport( subMenu );

				if ( false !== viewportClass ) {
					subMenu.addClass( viewportClass );
				}
			}

		}

	} );

} )();

/**
 * Keep menu items on one line.
 */
(
	function () {

		jQuery( document ).ready( function () {
			// Get required elements.
			var mainWrapper           = document.querySelector( '#header-text-nav-container .inner-wrap' ),
			    branding              = document.getElementById( 'header-left-section' ),
			    headerAction          = document.querySelector( '.header-action' ),
			    navigation            = document.getElementById( 'site-navigation' ),
			    mainWidth             = mainWrapper ? mainWrapper.offsetWidth : 0,
			    brandWidth            = branding ? branding.offsetWidth : 0,
			    navWidth              = navigation ? navigation.offsetWidth : 0,
			    headerActionWidth     = headerAction ? headerAction.offsetWidth: 0,
			    isExtra               = ( brandWidth + navWidth + headerActionWidth ) > mainWidth,
			    more                  = navigation ? navigation.getElementsByClassName( 'tg-menu-extras-wrap' )[0] : '',
			    headerDisplayTypeFour = document.getElementsByClassName( 'spacious-header-display-four' )[0];

			// Check for header style 4.
			if ( headerDisplayTypeFour ) {
				isExtra = ( navWidth + headerActionWidth ) >= mainWidth;
			}

			// Return if no excess menu items.
			if ( ! navigation.classList.contains( 'tg-extra-menus' ) ) {
				return;
			}

			function Dimension( el ) {
				var elWidth;
				if ( document.all ) {// IE.
					elWidth = el.currentStyle.width + parseInt( el.currentStyle.marginLeft, 10 ) + parseInt( el.currentStyle.marginRight, 10 ) + parseInt( el.currentStyle.paddingLeft, 10 ) + parseInt( el.currentStyle.paddingRight, 10 );
				} else {
					elWidth = parseInt( document.defaultView.getComputedStyle( el, '' ).getPropertyValue( 'width' ) ) + parseInt( document.defaultView.getComputedStyle( el, '' ).getPropertyValue( 'margin-left' ) ) + parseInt( document.defaultView.getComputedStyle( el, '' ).getPropertyValue( 'margin-right' ) );
				}

				return elWidth;
			}

			// If menu excesses.
			if ( ! isExtra ) {
				more.parentNode.removeChild( more );
			} else {
				var widthToBe, buttons, buttonWidth, moreWidth;

				widthToBe = mainWidth - headerActionWidth;

				if ( ! headerDisplayTypeFour ) {
					widthToBe = widthToBe - brandWidth;
				}

				buttons      = navigation.getElementsByClassName( 'tg-header-button-wrap' )[0];
				buttonWidth  = buttons ? Dimension( buttons ) : 0;
				moreWidth    = more ? Dimension( more ) : 0;
				newNavWidth  = widthToBe - ( buttonWidth + moreWidth );

				navigation.style.visibility = 'none';
				navigation.style.width      = newNavWidth + 'px';

				// Returns first children of a node.
				function getChildNodes( node ) {
					var children = [];

					for ( var child in node.childNodes ) {
						if ( typeof node !== 'undefined' ) {
							if ( 1 === node.childNodes[child].nodeType ) {
								children.push( node.childNodes[child] );
							}
						}
					}

					return children;
				}

				var navUl = navigation.getElementsByClassName( 'nav-menu' )[0],
				    navLi = getChildNodes( navUl ); // Get lis.

				function offset( el ) {
					var rect       = el.getBoundingClientRect(),
					    scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
					    scrollTop  = window.pageYOffset || document.documentElement.scrollTop;

					return { top : rect.top + scrollTop, left : rect.left + scrollLeft }
				}

				var extraLi = [];

				for ( var liCount = 0; liCount < navLi.length; liCount ++ ) {
					var initialPos, li, posTop;

					li     = navLi[liCount];
					posTop = offset( li ).top;

					if ( 0 === liCount ) {
						initialPos = posTop;
					}

					if ( posTop > initialPos ) {
						if ( ! li.classList.contains( 'header-action' ) && ! li.classList.contains( 'tg-menu-extras-wrap' ) && ! li.classList.contains( 'tg-header-button-wrap' ) ) {
							extraLi.push( li );
						}
					}
				}

				var newNavWidth = newNavWidth + ( buttonWidth + moreWidth ),
				    extraWrap   = document.getElementById( 'tg-menu-extras' );

				if ( ! headerDisplayTypeFour ) {
					newNavWidth = newNavWidth - 30;
				}

				navigation.style.width = newNavWidth + 'px';

				if ( null !== extraWrap ) {
					extraLi.forEach( function ( item, index, arr ) {
						extraWrap.appendChild( item );
					} );
				}

			}
		} );

	}()
);
