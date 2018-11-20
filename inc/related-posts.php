<?php $related_posts = spacious_related_posts_function(); ?>

<?php if ( $related_posts->have_posts() ): ?>

	<h4 class="related-posts-main-title">
		<i class="fa fa-thumbs-up"></i><span><?php esc_html_e( 'You May Also Like', 'spacious' ); ?></span>
	</h4>

	<div class="related-posts clearfix">

		<?php
		$count = 1;
		while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
			<?php
			$class = '';
			if ( $count % 3 == 1 ) {
				$class = "tg-one-third";
			} else if ( $count % 3 == 2 ) {
				$class = "tg-one-third tg-column-2";
			} else if ( $count % 3 == 0 ) {
				$class = "tg-one-third tg-after-two-blocks-clearfix";
			}
			?>

			<div class="<?php echo esc_attr( $class ); ?>">

				<?php if ( has_post_thumbnail() ):
					$title_attribute = get_the_title( $post->ID );
					$thumb_id        = get_post_thumbnail_id( get_the_ID() );
					$img_altr        = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
					$img_alt         = ! empty( $img_altr ) ? $img_altr : $title_attribute;
					$post_thumbnail_attr = array(
						'alt'   => esc_attr( $img_alt ),
						'title' => esc_attr( $title_attribute ),
					); ?>
					<div class="post-thumbnails">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_post_thumbnail( 'featured-blog-medium', $post_thumbnail_attr ); ?>
						</a>
					</div>
				<?php endif; ?>

				<div class="wrapper">

					<h3 class="entry-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</h3><!--/.post-title-->

					<footer class="entry-meta-bar clearfix">
						<div class="entry-meta clearfix">
							<span class="by-author author vcard"><a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span>

							<?php
							$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
							if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
								$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
							}
							$time_string = sprintf( $time_string,
								esc_attr( get_the_date( 'c' ) ),
								esc_html( get_the_date() ),
								esc_attr( get_the_modified_date( 'c' ) ),
								esc_html( get_the_modified_date() )
							);
							printf( __( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></span>', 'spacious' ),
								esc_url( get_permalink() ),
								esc_attr( get_the_time() ),
								$time_string
							); ?>
						</div>
					</footer>

				</div>

			</div><!--/.related-->
		<?php
		$count ++;
	endwhile; ?>

	</div><!--/.post-related-->
<?php endif; ?>

<?php wp_reset_query(); ?>
