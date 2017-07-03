<?php
/**
 * Contains all the functions related to sidebar and widget.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */

add_action( 'widgets_init', 'spacious_widgets_init');
/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function spacious_widgets_init() {

	// Registering main right sidebar
	register_sidebar( array(
		'name' 				=> esc_html__( 'Right Sidebar', 'spacious' ),
		'id' 					=> 'spacious_right_sidebar',
		'description'   	=> esc_html__( 'Shows widgets at Right side.', 'spacious' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );

	// Registering main left sidebar
	register_sidebar( array(
		'name' 				=> esc_html__( 'Left Sidebar', 'spacious' ),
		'id' 					=> 'spacious_left_sidebar',
		'description'   	=> esc_html__( 'Shows widgets at Left side.', 'spacious' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );

	// Registering Header sidebar
	register_sidebar( array(
		'name' 				=> esc_html__( 'Header Sidebar', 'spacious' ),
		'id' 					=> 'spacious_header_sidebar',
		'description'   	=> esc_html__( 'Shows widgets in header section just above the main navigation menu.', 'spacious' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title">',
		'after_title'   	=> '</h3>'
	) );

	// Registering Business Page template top section sidebar
	register_sidebar( array(
		'name' 				=> esc_html__( 'Business Top Sidebar', 'spacious' ),
		'id' 					=> 'spacious_business_page_top_section_sidebar',
		'description'   	=> esc_html__( 'Shows widgets on Business Page Template Top Section.', 'spacious' ).' '.__( 'Suitable widget: TG: Services, TG: Call To Action Widget, TG: Featured Widget', 'spacious' ),
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  	=> '</section>',
		'before_title'  	=> '<h3 class="widget-title">',
		'after_title'   	=> '</h3>'
	) );

	// Registering Business Page template middle section left half sidebar
	register_sidebar( array(
		'name' 				=> esc_html__( 'Business Middle Left Sidebar', 'spacious' ),
		'id' 					=> 'spacious_business_page_middle_section_left_half_sidebar',
		'description'   	=> esc_html__( 'Shows widgets on Business Page Template Middle Section Left Half.', 'spacious' ).' '.__( 'Suitable widget: TG: Testimonial, TG: Featured Single Page', 'spacious' ),
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  	=> '</section>',
		'before_title'  	=> '<h3 class="widget-title">',
		'after_title'   	=> '</h3>'
	) );

	// Registering Business Page template middle section right half sidebar
	register_sidebar( array(
		'name' 				=> esc_html__( 'Business Middle Right Sidebar', 'spacious' ),
		'id' 					=> 'spacious_business_page_middle_section_right_half_sidebar',
		'description'   	=> esc_html__( 'Shows widgets on Business Page Template Middle Section Right Half.', 'spacious' ).' '.__( 'Suitable widget: TG: Testimonial, TG: Featured Single Page', 'spacious' ),
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  	=> '</section>',
		'before_title'  	=> '<h3 class="widget-title">',
		'after_title'   	=> '</h3>'
	) );


	// Registering Business Page template bottom section sidebar
	register_sidebar( array(
		'name' 				=> esc_html__( 'Business Bottom Sidebar', 'spacious' ),
		'id' 					=> 'spacious_business_page_bottom_section_sidebar',
		'description'   	=> esc_html__( 'Shows widgets on Business Page Template Bottom Section.', 'spacious' ).' '.__( 'Suitable widget: TG: Services, TG: Call To Action Widget, TG: Featured Widget', 'spacious' ),
		'before_widget' 	=> '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  	=> '</section>',
		'before_title'  	=> '<h3 class="widget-title">',
		'after_title'   	=> '</h3>'
	) );

	// Registering contact Page sidebar
	register_sidebar( array(
		'name' 				=> esc_html__( 'Contact Page Sidebar', 'spacious' ),
		'id' 					=> 'spacious_contact_page_sidebar',
		'description'   	=> esc_html__( 'Shows widgets on Contact Page Template.', 'spacious' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );

	// Registering Error 404 Page sidebar
	register_sidebar( array(
		'name' 				=> esc_html__( 'Error 404 Page Sidebar', 'spacious' ),
		'id' 					=> 'spacious_error_404_page_sidebar',
		'description'   	=> esc_html__( 'Shows widgets on Error 404 page.', 'spacious' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );

	// Registering footer sidebar one
	register_sidebar( array(
		'name' 				=> esc_html__( 'Footer Sidebar One', 'spacious' ),
		'id' 					=> 'spacious_footer_sidebar_one',
		'description'   	=> esc_html__( 'Shows widgets at footer sidebar one.', 'spacious' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );

	// Registering footer sidebar two
	register_sidebar( array(
		'name' 				=> esc_html__( 'Footer Sidebar Two', 'spacious' ),
		'id' 					=> 'spacious_footer_sidebar_two',
		'description'   	=> esc_html__( 'Shows widgets at footer sidebar two.', 'spacious' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );

	// Registering footer sidebar three
	register_sidebar( array(
		'name' 				=> esc_html__( 'Footer Sidebar Three', 'spacious' ),
		'id' 					=> 'spacious_footer_sidebar_three',
		'description'   	=> esc_html__( 'Shows widgets at footer sidebar three.', 'spacious' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );

	// Registering footer sidebar four
	register_sidebar( array(
		'name' 				=> esc_html__( 'Footer Sidebar Four', 'spacious' ),
		'id' 					=> 'spacious_footer_sidebar_four',
		'description'   	=> esc_html__( 'Shows widgets at footer sidebar four.', 'spacious' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );

	// Registering widgets
	register_widget( "spacious_featured_single_page_widget" );
	register_widget( "spacious_service_widget" );
	register_widget( "spacious_call_to_action_widget" );
	register_widget( "spacious_testimonial_widget" );
	register_widget( "spacious_recent_work_widget" );
}

/****************************************************************************************/

/**
 * Featured Single page widget.
 *
 */
 class spacious_featured_single_page_widget extends WP_Widget {
 	function __construct() {
 		$widget_ops = array( 'classname' => 'widget_featured_single_post', 'description' => __( 'Display Featured Single Page', 'spacious' ) );
		$control_ops = array( 'width' => 200, 'height' =>250 );
		parent::__construct( false, $name='TG: Featured Single Page', $widget_ops, $control_ops);
 	}

 	function form( $instance ) {
 		$instance = wp_parse_args( (array) $instance, array( 'page_id' => '', 'title' => '', 'disable_feature_image' => 0, 'image_position' => 'above' ) );
		$title = esc_attr( $instance[ 'title' ] );
		$page_id = absint( $instance[ 'page_id' ] );
		$disable_feature_image = $instance['disable_feature_image'] ? 'checked="checked"' : '';
		$image_position = $instance[ 'image_position' ];
		_e( 'Suitable for Home Top Sidebar, Home Bottom Left Sidebar and Side Sidbar.', 'spacious' );
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'spacious' ); ?></label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p><?php _e( 'Displays the title of the Page if title input is empty.', 'spacious' ); ?></p>

		<p>
			<label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _e( 'Page', 'spacious' ); ?>:</label>
			<?php wp_dropdown_pages( array( 'name' => $this->get_field_name( 'page_id' ), 'selected' => $instance['page_id'] ) ); ?>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $disable_feature_image; ?> id="<?php echo $this->get_field_id('disable_feature_image'); ?>" name="<?php echo $this->get_field_name('disable_feature_image'); ?>" /> <label for="<?php echo $this->get_field_id('disable_feature_image'); ?>"><?php _e( 'Remove Featured image', 'spacious' ); ?></label>
		</p>

	    <?php if( $image_position == 'above' ) { ?>
		<p>
		    <input type="radio" id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" value="above" style="" checked /><?php _e( 'Show Image Before Title', 'spacious' );?><br />
		    <input type="radio" id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" value="below" style="" /><?php _e( 'Show Image After Title', 'spacious' );?><br />
		</p>
		<?php } else { ?>
		<p>
		    <input type="radio" id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" value="above" style="" /><?php _e( 'Show Image Before Title', 'spacious' );?><br />
		    <input type="radio" id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" value="below" style="" checked /><?php _e( 'Show Image After Title', 'spacious' );?><br />
		</p>
		<?php } ?>

	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'page_id' ] = absint( $new_instance[ 'page_id' ] );
		$instance[ 'disable_feature_image' ] = isset( $new_instance[ 'disable_feature_image' ] ) ? 1 : 0;
		$instance[ 'image_position' ] = $new_instance[ 'image_position' ];

		return $instance;
	}

	function widget( $args, $instance ) {
 		extract( $args );
 		extract( $instance );
 		global $post;
 		$title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
 		$page_id = isset( $instance[ 'page_id' ] ) ? $instance[ 'page_id' ] : '';
 		$disable_feature_image = !empty( $instance[ 'disable_feature_image' ] ) ? 'true' : 'false';
 		$image_position = isset( $instance[ 'image_position' ] ) ? $instance[ 'image_position' ] : 'above' ;

 		if( $page_id ) {
 			$the_query = new WP_Query( 'page_id='.$page_id );
 			while( $the_query->have_posts() ):$the_query->the_post();
 				$page_name = get_the_title();

	 		$output = $before_widget;
	 		if( $image_position == "below" ) {
	 			if( $title ): $output .= $before_title.'<a href="' . get_permalink() . '" title="'.$title.'">'. $title .'</a>'.$after_title;
	 			else: $output .= $before_title.'<a href="' . get_permalink() . '" title="'.$page_name.'">'. $page_name .'</a>'.$after_title;
	 			endif;
	 		}
	 		if( has_post_thumbnail() && $disable_feature_image != "true" ) {
	 			$output.= '<div class="service-image">'.get_the_post_thumbnail( $post->ID, 'featured', array( 'title' => esc_attr( $page_name ), 'alt' => esc_attr( $page_name ) ) ).'</div>';
	 		}

	 		if( $image_position == "above" ) {
		 		if( $title ): $output .= $before_title.'<a href="' . get_permalink() . '" title="'.$title.'">'. $title .'</a>'.$after_title;
	 			else: $output .= $before_title.'<a href="' . get_permalink() . '" title="'.$page_name.'">'. $page_name .'</a>'.$after_title;
	 			endif;
		 	}
			$output .= '<p>'.get_the_excerpt().'</p>';
			$output .= '<a class="read-more" href="'. get_permalink() .'">'.__( 'Read more', 'spacious' ).'</a>';
	 		$output .= $after_widget;
	 		endwhile;
	 		// Reset Post Data
	 		wp_reset_postdata();
	 		echo $output;
 		}

 	}
}

/****************************************************************************************/

/**
 * Featured service widget to show pages.
 */
class spacious_service_widget extends WP_Widget {
 	function __construct() {
 		$widget_ops = array( 'classname' => 'widget_service_block', 'description' => __( 'Display some pages as services. Best for Business Top or Bottom sidebar.', 'spacious' ) );
		$control_ops = array( 'width' => 200, 'height' =>250 );
		parent::__construct( false, $name = __( 'TG: Services', 'spacious' ), $widget_ops, $control_ops);
 	}

 	function form( $instance ) {
 		for ( $i=0; $i<6; $i++ ) {
 			$var = 'page_id'.$i;
 			$defaults[$var] = '';
 		}
 		$instance = wp_parse_args( (array) $instance, $defaults );
 		for ( $i=0; $i<6; $i++ ) {
 			$var = 'page_id'.$i;
 			$var = absint( $instance[ $var ] );
		}
	?>
		<?php for( $i=0; $i<6; $i++) { ?>
			<p>
				<label for="<?php echo $this->get_field_id( key($defaults) ); ?>"><?php _e( 'Page', 'spacious' ); ?>:</label>
				<?php wp_dropdown_pages( array( 'show_option_none' =>' ','name' => $this->get_field_name( key($defaults) ), 'selected' => $instance[key($defaults)] ) ); ?>
			</p>
		<?php
		next( $defaults );// forwards the key of $defaults array
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		for( $i=0; $i<6; $i++ ) {
			$var = 'page_id'.$i;
			$instance[ $var] = absint( $new_instance[ $var ] );
		}

		return $instance;
	}

	function widget( $args, $instance ) {
 		extract( $args );
 		extract( $instance );

 		global $post;
 		$page_array = array();
 		for( $i=0; $i<6; $i++ ) {
 			$var = 'page_id'.$i;
 			$page_id = isset( $instance[ $var ] ) ? $instance[ $var ] : '';

 			if( !empty( $page_id ) )
 				array_push( $page_array, $page_id );// Push the page id in the array
 		}
		$get_featured_pages = new WP_Query( array(
			'posts_per_page' 			=> -1,
			'post_type'					=>  array( 'page' ),
			'post__in'		 			=> $page_array,
			'orderby' 		 			=> 'post__in'
		) );
		echo $before_widget; ?>
			<?php
			$j = 1;
 			while( $get_featured_pages->have_posts() ):$get_featured_pages->the_post();
				$page_title = get_the_title();
				if( $j % 2 == 1 && $j > 1 ) {
					$service_class = "tg-one-third";
				}
				elseif ( $j % 3 == 1 && $j > 1 ) {
					$service_class = "tg-one-third tg-after-three-blocks-clearfix";
				}
				else {
					$service_class = "tg-one-third";
				}
				?>
				<div class="<?php echo $service_class; ?>">
					<?php
					if ( has_post_thumbnail() ) {
						echo'<div class="service-image">'.get_the_post_thumbnail( $post->ID, 'featured' ).'</div>';
					}
					?>
					<?php echo $before_title; ?><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php echo $page_title; ?></a><?php echo $after_title; ?>
					<?php the_excerpt(); ?>
					<div class="more-link-wrap">
						<a class="more-link" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php _e( 'Read more','spacious' ); ?></a>
					</div>
				</div>
				<?php $j++; ?>
			<?php endwhile;
	 		// Reset Post Data
 			wp_reset_query();
 			?>
		<?php
		echo $after_widget;
 	}
 }

/**************************************************************************************/

/**
 * Featured call to action widget.
 */
class spacious_call_to_action_widget extends WP_Widget {
 	function __construct() {
 		$widget_ops = array( 'classname' => 'widget_call_to_action', 'description' => __( 'Use this widget to show the call to action section.', 'spacious' ) );
		$control_ops = array( 'width' => 200, 'height' =>250 );
		parent::__construct( false, $name = __( 'TG: Call To Action Widget', 'spacious' ), $widget_ops, $control_ops);
 	}

 	function form( $instance ) {
 		$spacious_defaults[ 'text_main' ] = '';
 		$spacious_defaults[ 'text_additional' ] = '';
 		$spacious_defaults[ 'button_text' ] = '';
 		$spacious_defaults[ 'button_url' ] = '';
 		$instance = wp_parse_args( (array) $instance, $spacious_defaults );
		$text_main = esc_textarea( $instance[ 'text_main' ] );
		$text_additional = esc_textarea( $instance[ 'text_additional' ] );
		$button_text = esc_attr( $instance[ 'button_text' ] );
		$button_url = esc_url( $instance[ 'button_url' ] );
		?>


		<?php _e( 'Call to Action Main Text','spacious' ); ?>
		<textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id('text_main'); ?>" name="<?php echo $this->get_field_name('text_main'); ?>"><?php echo $text_main; ?></textarea>
		<?php _e( 'Call to Action Additional Text','spacious' ); ?>
		<textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id('text_additional'); ?>" name="<?php echo $this->get_field_name('text_additional'); ?>"><?php echo $text_additional; ?></textarea>
		<p>
			<label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e( 'Button Text:', 'spacious' ); ?></label>
			<input id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo $button_text; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('button_url'); ?>"><?php _e( 'Button Redirect Link:', 'spacious' ); ?></label>
			<input id="<?php echo $this->get_field_id('button_url'); ?>" name="<?php echo $this->get_field_name('button_url'); ?>" type="text" value="<?php echo $button_url; ?>" />
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		if ( current_user_can('unfiltered_html') )
			$instance['text_main'] =  $new_instance['text_main'];
		else
			$instance['text_main'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text_main']) ) ); // wp_filter_post_kses() expects slashed

		if ( current_user_can('unfiltered_html') )
			$instance['text_additional'] =  $new_instance['text_additional'];
		else
			$instance['text_additional'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text_additional']) ) ); // wp_filter_post_kses() expects slashed

		$instance[ 'button_text' ] = strip_tags( $new_instance[ 'button_text' ] );
		$instance[ 'button_url' ] = esc_url_raw( $new_instance[ 'button_url' ] );

		return $instance;
	}

	function widget( $args, $instance ) {
 		extract( $args );
 		extract( $instance );

 		global $post;
 		$text_main = empty( $instance['text_main'] ) ? '' : $instance['text_main'];
 		$text_additional = empty( $instance['text_additional'] ) ? '' : $instance['text_additional'];
 		$button_text = isset( $instance[ 'button_text' ] ) ? $instance[ 'button_text' ] : '';
 		$button_url = isset( $instance[ 'button_url' ] ) ? $instance[ 'button_url' ] : '#';

		echo $before_widget;
		?>
			<div class="call-to-action-content-wrapper clearfix">
				<div class="call-to-action-content">
					<?php
					if( !empty( $text_main ) ) {
					?>
					<h3><?php echo esc_html( $text_main ); ?></h3>
					<?php
					}
					if( !empty( $text_additional ) ) {
					?>
					<p><?php echo esc_html( $text_additional ); ?></p>
					<?php
					}
					?>
				</div>
				<?php
				if( !empty( $button_text ) ) {
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

/**************************************************************************************/

 /**
 * Testimonial widget
 */
class spacious_testimonial_widget extends WP_Widget {

	function __construct() {
 		$widget_ops = array( 'classname' => 'widget_testimonial', 'description' => __( 'Display Testimonial', 'spacious' ) );
		$control_ops = array( 'width' => 200, 'height' =>250 );
		parent::__construct( false, $name = __( 'TG: Testimonial', 'spacious' ), $widget_ops, $control_ops);
 	}

	function widget( $args, $instance ) {
		extract($args);

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		$name = apply_filters( 'widget_name', empty( $instance['name'] ) ? '' : $instance['name'], $instance, $this->id_base );
		$byline = apply_filters( 'widget_byline', empty( $instance['byline'] ) ? '' : $instance['byline'], $instance, $this->id_base );

		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title. esc_html( $title ) . $after_title; } ?>
		<div class="testimonial-icon"></div>
		<div class="testimonial-post"><?php echo '<p>'.esc_textarea( $text ).'</p>'; ?></div>
		<div class="testimonial-author">
			<span><?php echo esc_html( $name ); ?></span>
			<?php echo esc_html( $byline ); ?>
		</div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['name'] = strip_tags($new_instance['name']);
		$instance['byline'] = strip_tags($new_instance['byline']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'name' =>'', 'byline'=>'' ) );
		$title = strip_tags($instance['title']);
		$name = strip_tags($instance['name']);
		$byline = strip_tags($instance['byline']);
		$text = esc_textarea($instance['text']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'spacious' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<?php _e( 'Testimonial Description','spacious'); ?>
		<textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

		<p><label for="<?php echo $this->get_field_id('name'); ?>"><?php _e( 'Name:', 'spacious' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" type="text" value="<?php echo esc_attr($name); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('byline'); ?>"><?php _e( 'Byline:', 'spacious' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('byline'); ?>" name="<?php echo $this->get_field_name('byline'); ?>" type="text" value="<?php echo esc_attr($byline); ?>" /></p>

<?php
	}
}

/**************************************************************************************/

/**
 * Featured recent work widget to show pages.
 */
 class spacious_recent_work_widget extends WP_Widget {
 	function __construct() {
 		$widget_ops = array( 'classname' => 'widget_recent_work', 'description' => __( 'Show your some pages as recent work. Best for Business Top or Bottom sidebar.', 'spacious' ) );
		$control_ops = array( 'width' => 200, 'height' =>250 );
		parent::__construct( false, $name = __( 'TG: Featured Widget', 'spacious' ), $widget_ops, $control_ops);
 	}

 	function form( $instance ) {
 		for ( $i=0; $i<3; $i++ ) {
 			$var = 'page_id'.$i;
 			$defaults[$var] = '';
 		}
 		$att_defaults = $defaults;
 		$att_defaults['title'] = '';
 		$att_defaults['text'] = '';
 		$instance = wp_parse_args( (array) $instance, $att_defaults );
 		for ( $i=0; $i<3; $i++ ) {
 			$var = 'page_id'.$i;
 			$var = absint( $instance[ $var ] );
		}
		$title = esc_attr( $instance[ 'title' ] );
		$text = esc_textarea($instance['text']);
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'spacious' ); ?></label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<?php _e( 'Description','spacious' ); ?>
		<textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
		<?php
		for( $i=0; $i<3; $i++) {
			?>
			<p>
				<label for="<?php echo $this->get_field_id( key($defaults) ); ?>"><?php _e( 'Page', 'spacious' ); ?>:</label>
				<?php wp_dropdown_pages( array( 'show_option_none' =>' ','name' => $this->get_field_name( key($defaults) ), 'selected' => $instance[key($defaults)] ) ); ?>
			</p>
		<?php
		next( $defaults );// forwards the key of $defaults array
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		for( $i=0; $i<3; $i++ ) {
			$var = 'page_id'.$i;
			$instance[ $var] = absint( $new_instance[ $var ] );
		}
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);

		return $instance;
	}

	function widget( $args, $instance ) {
 		extract( $args );
 		extract( $instance );

 		global $post;
 		$title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
 		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
 		$page_array = array();
 		for( $i=0; $i<3; $i++ ) {
 			$var = 'page_id'.$i;
 			$page_id = isset( $instance[ $var ] ) ? $instance[ $var ] : '';

 			if( !empty( $page_id ) )
 				array_push( $page_array, $page_id );// Push the page id in the array
 		}
		$get_featured_pages = new WP_Query( array(
			'posts_per_page' 			=> -1,
			'post_type'					=>  array( 'page' ),
			'post__in'		 			=> $page_array,
			'orderby' 		 			=> 'post__in'
		) );
		echo $before_widget;
		?>
			<div class="tg-one-fourth tg-column-1">
				<?php
				if ( !empty( $title ) ) { echo $before_title . esc_html( $title ) . $after_title; } ?>
				<p><?php echo esc_textarea( $text ); ?></p>
			</div>
				<?php
	 			$i=2;
	 			while( $get_featured_pages->have_posts() ):$get_featured_pages->the_post();
	 				if ( $i % 4 == 0 ) { $class = 'tg-one-fourth tg-one-fourth-last'.' tg-column-'.$i; }
	 				elseif( $i % 3 == 0 ) { $class= 'tg-one-fourth tg-after-two-blocks-clearfix'.' tg-column-'.$i; }
	 				else { $class = 'tg-one-fourth'.' tg-column-'.$i; }
					$page_title = get_the_title();
					?>
					<div class="<?php echo $class; ?>">
						<?php
						if ( has_post_thumbnail( ) ) {
							echo '<div class="service-image"><a title="'.get_the_title().'" href="'.get_permalink().'">'.get_the_post_thumbnail( $post->ID,'featured-blog-medium').'</a></div>';
						}
						?>
					</div>
				<?php
					$i++;
				endwhile;
		 		// Reset Post Data
	 			wp_reset_query();
	 			?>
		<?php echo $after_widget;
 		}
 	}

/**************************************************************************************/
?>
