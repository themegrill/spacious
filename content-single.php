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
	<div class="entry-content clearfix">
		<?php
		if ( ( spacious_options( 'spacious_featured_image_single_post_page', 0 ) == 1 ) && has_post_thumbnail() ) {
			the_post_thumbnail( 'featured-blog-large' );
		}

		the_content();

		$spacious_tag_list = get_the_tag_list( '', '&nbsp;&nbsp;&nbsp;&nbsp;', '' );
		if ( ! empty( $spacious_tag_list ) ) {
			?>
			<div class="tags">
				<?php
				_e( 'Tagged on: ', 'spacious' );
				echo $spacious_tag_list;
				?>
			</div>
			<?php
		}

		wp_link_pages( array(
			'before'      => '<div style="clear: both;"></div><div class="pagination clearfix">' . __( 'Pages:', 'spacious' ),
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>'
		) );
		?>
	</div>

	<?php spacious_entry_meta(); ?>

	<?php
	do_action( 'spacious_after_post_content' );
	?>
</article>