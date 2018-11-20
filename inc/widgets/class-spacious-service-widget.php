<?php
/**
 * Featured service widget to show pages.
 */

class spacious_service_widget extends WP_Widget {
	function __construct() {
		$widget_ops  = array(
			'classname'                   => 'widget_service_block',
			'description'                 => __( 'Display some pages as services. Best for Business Top or Bottom sidebar.', 'spacious' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = __( 'TG: Services', 'spacious' ), $widget_ops, $control_ops );
	}

	function form( $instance ) {
		for ( $i = 0; $i < 6; $i ++ ) {
			$var              = 'page_id' . $i;
			$defaults[ $var ] = '';
		}
		$instance = wp_parse_args( (array) $instance, $defaults );
		for ( $i = 0; $i < 6; $i ++ ) {
			$var = 'page_id' . $i;
			$var = absint( $instance[ $var ] );
		}
		?>
		<?php for ( $i = 0; $i < 6; $i ++ ) { ?>
			<p>
				<label for="<?php echo $this->get_field_id( key( $defaults ) ); ?>"><?php _e( 'Page', 'spacious' ); ?>
					:</label>
				<?php wp_dropdown_pages( array( 'show_option_none' => ' ', 'name' => $this->get_field_name( key( $defaults ) ), 'selected' => $instance[ key( $defaults ) ] ) ); ?>
			</p>
			<?php
			next( $defaults );// forwards the key of $defaults array
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		for ( $i = 0; $i < 6; $i ++ ) {
			$var              = 'page_id' . $i;
			$instance[ $var ] = absint( $new_instance[ $var ] );
		}

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$page_array = array();
		for ( $i = 0; $i < 6; $i ++ ) {
			$var     = 'page_id' . $i;
			$page_id = isset( $instance[ $var ] ) ? $instance[ $var ] : '';

			if ( ! empty( $page_id ) ) {
				array_push( $page_array, $page_id );
			}// Push the page id in the array
		}
		$get_featured_pages = new WP_Query( array(
			'posts_per_page' => - 1,
			'post_type'      => array( 'page' ),
			'post__in'       => $page_array,
			'orderby'        => 'post__in',
		) );
		echo $before_widget; ?>
		<?php
		$j = 1;
		while ( $get_featured_pages->have_posts() ):$get_featured_pages->the_post();
			$page_title = get_the_title();
			if ( $j % 2 == 1 && $j > 1 ) {
				$service_class = "tg-one-third";
			} else if ( $j % 3 == 1 && $j > 1 ) {
				$service_class = "tg-one-third tg-after-three-blocks-clearfix";
			} else {
				$service_class = "tg-one-third";
			}
			?>
			<div class="<?php echo $service_class; ?>">
				<?php
				if ( has_post_thumbnail() ) {
					$title_attribute = get_the_title( $post->ID );
					$thumb_id  = get_post_thumbnail_id( get_the_ID() );
					$img_altr  = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
					$img_alt   = ! empty( $img_altr ) ? $img_altr : $title_attribute;
					echo '<div class="service-image">' . get_the_post_thumbnail( $post->ID, 'featured', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $img_alt ) ) ) . '</div>';
				}
				?>
				<?php echo $before_title; ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php echo $page_title; ?></a><?php echo $after_title; ?>
				<?php the_excerpt(); ?>
				<div class="more-link-wrap">
					<a class="more-link" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'spacious' ); ?></a>
				</div>
			</div>
			<?php $j ++; ?>
		<?php endwhile;
		// Reset Post Data
		wp_reset_query();
		?>
		<?php
		echo $after_widget;
	}
}
