<?php
/**
 * Testimonial widget
 */

class spacious_testimonial_widget extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'                   => 'widget_testimonial',
			'description'                 => __( 'Display Testimonial', 'spacious' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = __( 'TG: Testimonial', 'spacious' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title  = apply_filters( 'widget_title', empty( $instance[ 'title' ] ) ? '' : $instance[ 'title' ], $instance, $this->id_base );
		$text   = apply_filters( 'widget_text', empty( $instance[ 'text' ] ) ? '' : $instance[ 'text' ], $instance );
		$name   = apply_filters( 'widget_name', empty( $instance[ 'name' ] ) ? '' : $instance[ 'name' ], $instance, $this->id_base );
		$byline = apply_filters( 'widget_byline', empty( $instance[ 'byline' ] ) ? '' : $instance[ 'byline' ], $instance, $this->id_base );

		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . esc_html( $title ) . $after_title;
		} ?>
		<div class="testimonial-icon"></div>
		<div class="testimonial-post"><?php echo '<p>' . esc_textarea( $text ) . '</p>'; ?></div>
		<div class="testimonial-author">
			<span><?php echo esc_html( $name ); ?></span>
			<?php echo esc_html( $byline ); ?>
		</div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance             = $old_instance;
		$instance[ 'title' ]  = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'name' ]   = strip_tags( $new_instance[ 'name' ] );
		$instance[ 'byline' ] = strip_tags( $new_instance[ 'byline' ] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance[ 'text' ] = $new_instance[ 'text' ];
		} else {
			$instance[ 'text' ] = stripslashes( wp_filter_post_kses( addslashes( $new_instance[ 'text' ] ) ) );
		} // wp_filter_post_kses() expects slashed
		$instance[ 'filter' ] = isset( $new_instance[ 'filter' ] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'name' => '', 'byline' => '' ) );
		$title    = strip_tags( $instance[ 'title' ] );
		$name     = strip_tags( $instance[ 'name' ] );
		$byline   = strip_tags( $instance[ 'byline' ] );
		$text     = esc_textarea( $instance[ 'text' ] );
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'spacious' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"/>
		</p>
		<?php _e( 'Testimonial Description', 'spacious' ); ?>
		<textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $text; ?></textarea>

		<p><label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e( 'Name:', 'spacious' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>"/>
		</p>

		<p><label for="<?php echo $this->get_field_id( 'byline' ); ?>"><?php _e( 'Byline:', 'spacious' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'byline' ); ?>" name="<?php echo $this->get_field_name( 'byline' ); ?>" type="text" value="<?php echo esc_attr( $byline ); ?>"/>
		</p>

		<?php
	}
}
