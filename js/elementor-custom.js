/**
 * @description Spacious custom javascript functions
 * @author ThemeGril
 */

/*===============================
 =            Counter            =
 ===============================*/
jQuery( window ).on( 'elementor/frontend/init', function () {
	elementorFrontend.hooks.addAction( 'frontend/element_ready/widget', function ( $scope ) {

		// Counter
		if ( ( typeof jQuery.fn.waypoint !== 'undefined' ) && ( typeof jQuery.fn.countTo !== 'undefined' ) ) {
			$scope.waypoint( function ( direction ) {
				if ( 'down' === direction ) {
					$scope.find( '.counter__number' ).countTo();
				}
			}, {
				triggerOnce: true,
				offset     : '80%'
			} );
		}
	} );
} );
