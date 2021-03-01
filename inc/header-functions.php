<?php
/**
 * Contains all the fucntions and components related to header part.
 *
 * @package           ThemeGrill
 * @subpackage        Spacious
 * @since             Spacious 1.0
 */

if ( ! function_exists( 'spacious_social_links' ) ) :

	/**
	 * This function is for social links display on header
	 *
	 * Get links through Theme Options
	 */
	function spacious_social_links() {

		$spacious_social_links = array(
			'spacious_social_facebook'  => 'Facebook',
			'spacious_social_twitter'   => 'Twitter',
			'spacious_social_instagram' => 'Instagram',
			'spacious_social_linkedin'  => 'LinkedIn',
		);
		?>

		<div class="social-links clearfix">
			<ul>
				<?php
				$spacious_links_output = '';

				foreach ( $spacious_social_links as $key => $value ) {
					$link = get_theme_mod( $key, '' );
					if ( ! empty( $link ) ) {
						if ( get_theme_mod( $key . 'new_tab', '0' ) == '1' ) {
							$new_tab = 'target="_blank"';
						} else {
							$new_tab = '';
						}

						$spacious_links_output .= '<li class="spacious-' . strtolower( $value ) . '"><a href="' . esc_url( $link ) . '" ' . $new_tab . '></a></li>';
					}
				}

				echo $spacious_links_output;
				?>
			</ul>
		</div><!-- .social-links -->
		<?php
	}

endif;


if ( ! function_exists( 'spacious_header_info_text' ) ) :

	/**
	 * Shows the small info text on top header part
	 */
	function spacious_header_info_text() {
		if ( get_theme_mod( 'spacious_header_info_text', '' ) == '' ) {
			return;
		}

		$spacious_header_info_text = get_theme_mod( 'spacious_header_info_text', '' );

		echo do_shortcode( $spacious_header_info_text );
	}

endif;

/*	 * ************************************* WooCommerce cart icon ************************************** */
if ( ! function_exists( 'spacious_cart_icon' ) ) :

	/**
	 * Display cart icon on menu bar.
	 *
	 * show cart icon if activated from customizer
	 */
	function spacious_cart_icon() {
		if ( ( get_theme_mod( 'spacious_cart_icon', 0 ) == 1 ) && class_exists( 'woocommerce' ) ) :
			?>
			<div class="cart-wrapper">
				<div class="spacious-woocommerce-cart-views">

					<!-- Show cart icon with total cart item -->
					<?php $cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : WC()->cart->get_cart_url(); ?>

					<a href="<?php echo esc_url( $cart_url ); ?>" class="wcmenucart-contents">
						<i class="fa fa-shopping-cart"></i>
						<span class="cart-value"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() ); ?></span>
					</a>

					<!-- Show total cart price -->
					<div class="spacious-woocommerce-cart-wrap">
						<div class="spacious-woocommerce-cart"><?php esc_html_e( 'Total', 'spacious' ); ?></div>
						<div class="cart-total"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></div>
					</div>
				</div>

				<!-- WooCommerce Cart Widget -->
				<?php the_widget( 'WC_Widget_Cart', '' ); ?>

			</div> <!-- /.cart-wrapper -->
		<?php
		endif;
	}

endif;

/****************************************************************************************/
// Filter the get_header_image_tag() for supporting the older way of displaying the header image
function spacious_header_image_markup( $html, $header, $attr ) {
	$output       = '';
	$header_image = get_header_image();

	if ( ! empty( $header_image ) ) {
		$output .= '<img src="' . esc_url( $header_image ) . '" class="header-image" width="' . get_custom_header()->width . '" height="' . get_custom_header()->height . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '">';
	}

	return $output;
}

function spacious_header_image_markup_filter() {
	add_filter( 'get_header_image_tag', 'spacious_header_image_markup', 10, 3 );
}

add_action( 'spacious_header_image_markup_render', 'spacious_header_image_markup_filter' );

/****************************************************************************************/

if ( ! function_exists( 'spacious_render_header_image' ) ) :
	/**
	 * Shows the small info text on top header part
	 */
	function spacious_render_header_image() {
		if ( function_exists( 'the_custom_header_markup' ) ) {
			do_action( 'spacious_header_image_markup_render' );
			the_custom_header_markup();
		} else {
			$header_image = get_header_image();
			if ( ! empty( $header_image ) ) { ?>
				<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				<?php
			}
		}
	}
endif;

/****************************************************************************************/

if ( ! function_exists( 'spacious_featured_image_slider' ) ) :
	/**
	 * display featured post slider
	 */
	function spacious_featured_image_slider() {
		global $post;
		?>
		<section id="featured-slider">
			<div class="slider-cycle">
				<?php
				for ( $i = 1; $i <= 5; $i++ ) {
					$spacious_slider_title       = get_theme_mod( 'spacious_slider_title' . $i, '' );
					$spacious_slider_text        = get_theme_mod( 'spacious_slider_text' . $i, '' );
					$spacious_slider_image       = get_theme_mod( 'spacious_slider_image' . $i, '' );
					$spacious_slider_button_text = get_theme_mod( 'spacious_slider_button_text' . $i, __( 'Read more', 'spacious' ) );
					$spacious_slider_link        = get_theme_mod( 'spacious_slider_link' . $i, '#' );
					$attachment_post_id          = attachment_url_to_postid( $spacious_slider_image );
					$image_attributes            = wp_get_attachment_image_src( $attachment_post_id, 'full' );
					if ( ! empty( $spacious_header_title ) || ! empty( $spacious_slider_text ) || ! empty( $spacious_slider_image ) ) {
						if ( $i == 1 ) {
							$classes = "slides displayblock";
						} else {
							$classes = "slides displaynone";
						}
						?>
						<div class="<?php echo $classes; ?>">
							<figure>
								<?php $img_altr = get_post_meta( $attachment_post_id, '_wp_attachment_image_alt', true );
								$img_alt        = ! empty( $img_altr ) ? $img_altr : $spacious_slider_title; ?>

								<?php if ( ! empty ( $image_attributes ) ) { ?>
									<img width="<?php echo esc_attr( $image_attributes[1] ); ?>" height="<?php echo esc_attr( $image_attributes[2] ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" src="<?php echo esc_url( $spacious_slider_image ); ?>">
								<?php } else { ?>
									<img alt="<?php echo esc_attr( $img_alt ); ?>" src="<?php echo esc_url( $spacious_slider_image ); ?>">
								<?php } ?>

							</figure>
							<div class="entry-container">
								<?php if ( ! empty( $spacious_slider_title ) || ! empty( $spacious_slider_text ) ) { ?>
									<div class="entry-description-container">
										<?php if ( ! empty( $spacious_slider_title ) ) { ?>
											<div class="slider-title-head"><h3 class="entry-title">
													<a href="<?php echo esc_url( $spacious_slider_link ); ?>" title="<?php echo esc_attr( $spacious_slider_title ); ?>"><span><?php echo esc_html( $spacious_slider_title ); ?></span></a>
												</h3></div>
											<?php
										}
										if ( ! empty( $spacious_slider_text ) ) {
											?>
											<div class="entry-content">
												<p><?php echo esc_textarea( $spacious_slider_text ); ?></p></div>
											<?php
										}
										?>
									</div>
								<?php } ?>
								<div class="clearfix"></div>
								<?php if ( ! empty( $spacious_slider_button_text ) ) { ?>
									<a class="slider-read-more-button" href="<?php echo esc_url( $spacious_slider_link ); ?>" title="<?php echo esc_attr( $spacious_slider_title ); ?>"><?php echo esc_html( $spacious_slider_button_text ); ?></a>
								<?php } ?>
							</div>
						</div>
						<?php
					}
				}
				?>
				<nav id="controllers" class="clearfix"></nav>
			</div>
		</section>

		<?php
	}
endif;

/****************************************************************************************/

if ( ! function_exists( 'spacious_header_title' ) ) :
	/**
	 * Show the title in header
	 */
	function spacious_header_title() {
		if ( is_archive() ) {
			if ( is_category() ) :
				$spacious_header_title = single_cat_title( '', false );

			elseif ( is_tag() ) :
				$spacious_header_title = single_tag_title( '', false );

			elseif ( is_author() ) :
				/* Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				*/
				the_post();
				$spacious_header_title = sprintf( __( 'Author: %s', 'spacious' ), '<span class="vcard">' . get_the_author() . '</span>' );
				/* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();

			elseif ( is_day() ) :
				$spacious_header_title = sprintf( __( 'Day: %s', 'spacious' ), '<span>' . get_the_date() . '</span>' );

			elseif ( is_month() ) :
				$spacious_header_title = sprintf( __( 'Month: %s', 'spacious' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

			elseif ( is_year() ) :
				$spacious_header_title = sprintf( __( 'Year: %s', 'spacious' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

			elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
				$spacious_header_title = __( 'Asides', 'spacious' );

			elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
				$spacious_header_title = __( 'Images', 'spacious' );

			elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
				$spacious_header_title = __( 'Videos', 'spacious' );

			elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
				$spacious_header_title = __( 'Quotes', 'spacious' );

			elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
				$spacious_header_title = __( 'Links', 'spacious' );

			elseif ( is_plugin_active( 'woocommerce/woocommerce.php' ) && function_exists( 'is_woocommerce' ) && is_woocommerce() ) :
				$spacious_header_title = woocommerce_page_title( false );

			else :
				$spacious_header_title = __( 'Archives', 'spacious' );

			endif;
		} elseif ( is_404() ) {
			$spacious_header_title = __( 'Page NOT Found', 'spacious' );
		} elseif ( is_search() ) {
			$spacious_header_title = __( 'Search Results', 'spacious' );
		} elseif ( is_page() ) {
			$spacious_header_title = get_the_title();
		} elseif ( is_single() ) {
			$spacious_header_title = get_the_title();
		} elseif ( is_home() ) {
			$queried_id            = get_option( 'page_for_posts' );
			$spacious_header_title = get_the_title( $queried_id );
		} else {
			$spacious_header_title = '';
		}

		return $spacious_header_title;

	}
endif;

/****************************************************************************************/

if ( ! function_exists( 'spacious_breadcrumb' ) ) :
	/**
	 * Display breadcrumb on header.
	 *
	 * If the page is home or front page, slider is displayed.
	 * In other pages, breadcrumb will display if breadcrumb NavXT plugin exists.
	 */
	function spacious_breadcrumb() {
		if ( function_exists( 'bcn_display' ) ) {
			echo '<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">';
			echo '<span class="breadcrumb-title">' . __( 'You are here: ', 'spacious' ) . '</span>';
			bcn_display();
			echo '</div> <!-- .breadcrumb : NavXT -->';

		} elseif ( function_exists( 'yoast_breadcrumb' ) ) { // SEO by Yoast
			yoast_breadcrumb(
				'<div class="breadcrumb">' . '<span class="breadcrumb-title">' . wp_kses_post( get_theme_mod( 'spacious_custom_breadcrumb_text', __( 'You are here: ', 'spacious' ) ) ) . '</span>',
				'</div> <!-- .breadcrumb : Yoast -->'
			);
		}
	}
endif;

/*	 * ************************************************************************************* */
if ( ! function_exists( 'spacious_main_nav' ) ) :
	function spacious_main_nav() {
		// For header menu button enabled option.
		$class                  = '';
		$responsive_menu_enable = get_theme_mod( 'spacious_new_menu', '1' );
		$header_button_link_1   = get_theme_mod( 'spacious_header_button_one_link' );
		if ( $header_button_link_1 ) {
			$class = 'spacious-header-button-enabled';
		}
		?>

		<nav id="site-navigation" class="main-navigation clearfix  <?php echo esc_attr( $class ); ?> <?php echo esc_attr( get_theme_mod( 'spacious_one_line_menu_setting' )) ? 'tg-extra-menus' : ''; ?>" role="navigation">
			<p class="menu-toggle">
				<span class="<?php echo esc_attr( $responsive_menu_enable == '1' ? 'screen-reader-text' : '' ); ?>"><?php _e( 'Menu', 'spacious' ); ?></span>
			</p>
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array(
					'theme_location'  => 'primary',
					'container_class' => 'menu-primary-container',
				) );
			} else {
				wp_page_menu();
			}
			?>
		</nav>

		<?php
	}
endif;
