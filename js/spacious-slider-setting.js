/**
 * Slider Setting
 *
 * Contains all the slider settings for the featured post/page slider.
 */
jQuery(window).on('load',function() {
	jQuery( '.slider-cycle' ).cycle({
	fx: 'fade',
	timeout: 4000,
	speed: 1000,
	slides: '> div',
	pager: '> #controllers',
	pagerActiveClass: 'active',
	pagerTemplate: '<a></a>',
	pauseOnHover: true,
	autoHeight: 'container',
	swipe: true,
	swipeFx: 'scrollHorz',
	log: false
	});
});
