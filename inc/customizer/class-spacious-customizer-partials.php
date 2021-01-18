<?php
/**
 * Spacious customizer class for theme customize partials.
 *
 * Class Spacious_Customizer_Partials
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 2.4.5
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Spacious customizer class for theme customize partials.
 *
 * Class Spacious_Customizer_Partials
 */
class Spacious_Customizer_Partials {

	/**
	 * Render the Read Next text for selective refresh partial.
	 *
	 * @return void
	 */
	public static function read_more_text_render() { ?>
		<a class="read-more" href="<?php the_permalink(); ?>"><?php echo esc_html( get_theme_mod( 'spacious_read_more_text', __( 'Read more', 'spacious' ) ) ); ?></a>
	<?php }

	public static function spacious_header_info_text() {
		if ( get_theme_mod( 'spacious_header_info_text', '' ) == '' ) {
			return;
		}

		$spacious_header_info_text = '<div class="small-info-text"><p>' . get_theme_mod( 'spacious_header_info_text', '' ) . '</p></div>';

		echo do_shortcode( $spacious_header_info_text );
	}

	public static function spacious_breadcrumb() {

		// NavXT
		if ( function_exists( 'bcn_display' ) ) {

			echo '<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">';
			echo '<span class="breadcrumb-title">' . wp_kses_post( get_theme_mod( 'spacious_custom_breadcrumb_text', __( 'You are here: ', 'spacious' ) ) ) . '</span>';
			bcn_display();
			echo '</div> <!-- .breadcrumb : NavXT -->';

		} elseif ( function_exists( 'yoast_breadcrumb' ) ) { // SEO by Yoast

			yoast_breadcrumb(
				'<div class="breadcrumb">' . '<span class="breadcrumb-title">' . wp_kses_post( get_theme_mod( 'spacious_custom_breadcrumb_text', __( 'You are here: ', 'spacious' ) ) ) . '</span>',
				'</div> <!-- .breadcrumb : Yoast -->'
			);

		}
	}

	public static function spacious_taxonomy_description() {
		?>

		<div class="taxonomy-description">
			<?php
			if ( get_theme_mod( 'spacious_term_description', 0 ) == 1 ) :
				// Show term description for category.
				$term_description = term_description();

				if ( ! empty( $term_description ) ) :
					printf( '%s', $term_description );
				endif;

			endif;
			?>
		</div>

		<?php
	}

	public static function spacious_footer_copyright() {

		$default_footer_value = get_theme_mod( 'spacious_footer_editor', __( 'Copyright &copy; ', 'spacious' ) . '[the-year] [site-link] ' . __( 'Theme by: ', 'spacious' ) . '[tg-link] ' . __( 'Powered by: ', 'spacious' ) . '[wp-link]' );

		$spacious_footer_copyright = '<div class="copyright">' . $default_footer_value . '</div>';

		echo do_shortcode( $spacious_footer_copyright );
	}

	/**
	 * Render the site title for the selective refresh partial.
	 *
	 * @return void
	 */
	public static function render_customize_partial_blogname() {
		bloginfo( 'name' );
	}

	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @return void
	 */
	public static function render_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}

}
