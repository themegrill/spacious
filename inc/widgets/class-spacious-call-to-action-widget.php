<?php
/**
 * Featured call to action widget.
 */

class spacious_call_to_action_widget extends WP_Widget {
	function __construct() {
		$widget_ops  = array(
			'classname'                   => 'widget_call_to_action',
			'description'                 => __( 'Use this widget to show the call to action section.', 'spacious' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = __( 'TG: Call To Action Widget', 'spacious' ), $widget_ops, $control_ops );
	}

	function form( $instance ) {
		$spacious_defaults[ 'text_main' ]       = '';
		$spacious_defaults[ 'text_additional' ] = '';
		$spacious_defaults[ 'button_text' ]     = '';
		$spacious_defaults[ 'button_url' ]      = '';
		$instance                               = wp_parse_args( (array) $instance, $spacious_defaults );
		$text_main                              = esc_textarea( $instance[ 'text_main' ] );
		$text_additional                        = esc_textarea( $instance[ 'text_additional' ] );
		$button_text                            = esc_attr( $instance[ 'button_text' ] );
		$button_url                             = esc_url( $instance[ 'button_url' ] );
		?>


		<?php _e( 'Call to Action Main Text', 'spacious' ); ?>
		<textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id( 'text_main' ); ?>" name="<?php echo $this->get_field_name( 'text_main' ); ?>"><?php echo $text_main; ?></textarea>
		<?php _e( 'Call to Action Additional Text', 'spacious' ); ?>
		<textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id( 'text_additional' ); ?>" name="<?php echo $this->get_field_name( 'text_additional' ); ?>"><?php echo $text_additional; ?></textarea>
		<p>
			<label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Button Text:', 'spacious' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo $button_text; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'button_url' ); ?>"><?php _e( 'Button Redirect Link:', 'spacious' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'button_url' ); ?>" name="<?php echo $this->get_field_name( 'button_url' ); ?>" type="text" value="<?php echo $button_url; ?>"/>
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance[ 'text_main' ] = $new_instance[ 'text_main' ];
		} else {
			$instance[ 'text_main' ] = stripslashes( wp_filter_post_kses( addslashes( $new_instance[ 'text_main' ] ) ) );
		} // wp_filter_post_kses() expects slashed

		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance[ 'text_additional' ] = $new_instance[ 'text_additional' ];
		} else {
			$instance[ 'text_additional' ] = stripslashes( wp_filter_post_kses( addslashes( $new_instance[ 'text_additional' ] ) ) );
		} // wp_filter_post_kses() expects slashed

		$instance[ 'button_text' ] = strip_tags( $new_instance[ 'button_text' ] );
		$instance[ 'button_url' ]  = esc_url_raw( $new_instance[ 'button_url' ] );

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$text_main       = empty( $instance[ 'text_main' ] ) ? '' : $instance[ 'text_main' ];
		$text_additional = empty( $instance[ 'text_additional' ] ) ? '' : $instance[ 'text_additional' ];
		$button_text     = isset( $instance[ 'button_text' ] ) ? $instance[ 'button_text' ] : '';
		$button_url      = isset( $instance[ 'button_url' ] ) ? $instance[ 'button_url' ] : '#';

		echo $before_widget;
		?>
		<div class="call-to-action-content-wrapper clearfix">
			<div class="call-to-action-content">
				<?php
				if ( ! empty( $text_main ) ) {
					?>
					<h3><?php echo esc_html( $text_main ); ?></h3>
					<?php
				}
				if ( ! empty( $text_additional ) ) {
					?>
					<p><?php echo esc_html( $text_additional ); ?></p>
					<?php
				}
				?>
			</div>
			<?php
			if ( ! empty( $button_text ) ) {
				?>
				<a class="call-to-action-button" href="<?php echo $button_url; ?>" title="<?php echo esc_attr( $button_text ); ?>"><?php echo esc_html( $button_text ); ?></a>
				<?php
			}
			?>
		</div>
		<?php
		echo $after_widget;
	}
}
