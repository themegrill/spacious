<?php
/**
 * Elementor compatibility.
 *
 * @package Spacious
 */

// Filter the rendering of the default WordPress widgets
add_filter( 'elementor/widgets/wordpress/widget_args', 'spacious_elementor_widget_render_filter' );

/**
 * Render the default WordPress widget settings, ie, divs
 *
 * @param $args the widget id
 *
 * @return array register sidebar divs
 *
 * @since 1.0.0
 */

function spacious_elementor_widget_render_filter( $args ) {
	return
		array(
			'before_widget' => '<aside class="widget ' . spacious_widget_class_names( $args['widget_id'] ) . '">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		);
}

/**
 * Render the widget classes for Elementor plugin compatibility
 *
 * @param $widgets_id the widgets of the id
 *
 * @return mixed the widget classes of the id passed
 *
 * @since 1.0.0
 */
function spacious_widget_class_names( $widgets_id ) {

	$widgets_id = str_replace( 'wp-widget-', '', $widgets_id );

	$classes = spacious_widgets_classes();

	$return_value = isset( $classes[ $widgets_id ] ) ? $classes[ $widgets_id ] : '';

	return $return_value;
}

/**
 * Return all the arrays of widgets classes and classnames of same respectively
 *
 * @return array the array of widget classnames and its respective classes
 *
 * @since 1.0.0
 */
function spacious_widgets_classes() {

	return
		array(
			'spacious_featured_single_page_widget' => 'widget_featured_single_post',
			'spacious_service_widget'              => 'widget_service_block',
			'spacious_call_to_action_widget'       => 'widget_call_to_action',
			'spacious_testimonial_widget'          => 'widget_testimonial',
			'spacious_recent_work_widget'          => 'widget_recent_work',
		);
}
