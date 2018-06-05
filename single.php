<?php
/**
 * Theme Single Post Section for our theme.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
get_header(); ?>

	<?php do_action( 'spacious_before_body_content' ); ?>

	<div id="primary">
		<div id="content" class="clearfix">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php get_template_part( 'navigation', 'archive' ); ?>

				<?php if ( spacious_options( 'spacious_related_posts_activate', 0 ) == 1 ) {
				get_template_part( 'inc/related-posts' );
				}
				?>

				<?php
				if ( spacious_options( 'spacious_author_bio', 0 ) == 1 ) :
					if ( get_the_author_meta( 'description' ) ) : ?>
						<div class="author-box clearfix">
							<div class="author-img"><?php echo get_avatar( get_the_author_meta( 'user_email' ), '100' ); ?></div>
							<div class="author-description-wrapper">
								<h4 class="author-name"><?php the_author_meta( 'display_name' ); ?></h4>
								<p class="author-description"><?php the_author_meta( 'description' ); ?></p>
							</div>
						</div>
					<?php endif;
				endif;
				?>

				<?php
					do_action( 'spacious_before_comments_template' );
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
	      		do_action ( 'spacious_after_comments_template' );
				?>

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

	<?php spacious_sidebar_select(); ?>

	<?php do_action( 'spacious_after_body_content' ); ?>

<?php get_footer(); ?>
