<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'spacious_before_post_content' ); ?>

	<?php
	if( !is_single() ) {
	?>
	<header class="entry-header">
	<h2 class="entry-title">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
	</h2><!-- .entry-title -->
	</header>
	<?php
	}
	?>

	<?php
		if( has_post_thumbnail() ) {
			if( get_theme_mod( 'spacious_site_layout', 'box_1218px' ) == 'box_1218px' || get_theme_mod( 'spacious_site_layout', 'box_1218px' ) == 'wide_1218px' ) {
				$featured = 'featured-blog-large';
			}
			elseif( get_theme_mod( 'spacious_site_layout', 'box_1218px' ) == 'box_978px' || get_theme_mod( 'spacious_site_layout', 'box_1218px' ) == 'wide_978px' ) {
				$featured = 'featured';
			}
			$image           = '';
			$title_attribute = get_the_title( $post->ID );
			$thumb_id        = get_post_thumbnail_id( get_the_ID() );
			$img_altr        = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
			$img_alt         = ! empty( $img_altr ) ? $img_altr : $title_attribute;
			$image           .= '<figure class="post-featured-image">';
			$image           .= '<a href="' . get_permalink() . '" title="' . the_title( '', '', false ) . '">';
			$image           .= get_the_post_thumbnail( $post->ID, $featured, array(
					'title' => esc_attr( $title_attribute ),
					'alt'   => esc_attr( $img_alt ),
				) ) . '</a>';
			$image           .= '</figure>';

  			echo $image;
  		}
	?>

	<div class="entry-content clearfix">
		<?php
			the_excerpt();
		?>
	</div>

	<?php spacious_entry_meta(); ?>

	<?php
	do_action( 'spacious_after_post_content' );
   ?>
</article>
