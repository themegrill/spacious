<?php

class Spacious_Upsell_Custom_Control extends WP_Customize_Control {

	public $type = "spacious-upsell-control";

	public function enqueue() {
		wp_enqueue_style( 'spacious-customizer', get_template_directory_uri() . '/css/admin/customizer.css', array(), SPACIOUS_THEME_VERSION   );
	}

	public function render_content() {
		?>
		<div class="spacious-upsell-wrapper">
			<ul class="upsell-features">
				<h3 class="upsell-heading"><?php esc_html_e( 'More Awesome Features', 'spacious' ); ?></h3>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( 'Advanced Header Options', 'spacious' ); ?>
				</li>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( 'Flexible Menu Designs', 'spacious' ); ?>
				</li>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( 'Grid, Masonry, Thumbnail Blog', 'spacious' ); ?>
				</li>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( '10+ Footer Layouts', 'spacious' ); ?>
				</li>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( '100+ Customizer Options', 'spacious' ); ?>
				</li>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( 'Advanced Page Settings', 'spacious' ); ?>
				</li>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( '17+ Starter Demos', 'spacious' ); ?>
				</li>
			</ul>

			<div class="launch-offer">
				<?php
				printf(
				/* translators: %1$s discount coupon code., %2$s discount percentage */
					esc_html__( 'Use the coupon code %1$s to get %2$s discount (limited time offer). Enjoy!', 'spacious' ),
					'<span class="coupon-code">save10</span>',
					'10%'
				);
				?>
			</div>
		</div> <!-- /.spacious-upsell-wrapper -->

		<a class="upsell-cta" target="_blank"
		   href="<?php echo esc_url( 'https://themegrill.com/spacious-pricing/?utm_source=spacious-customizer&utm_medium=view-pricing-link&utm_campaign=upgrade' ); ?>"><?php esc_html_e( 'View Pricing', 'spacious' ); ?></a>
		<?php
	}

}
