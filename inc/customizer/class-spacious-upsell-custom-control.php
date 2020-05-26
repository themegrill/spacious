<?php

class Spacious_Upsell_Custom_Control extends WP_Customize_Control {

	public $type = "spacious_upsell_control";

	public function render_content() {
		?>
		<div class="zakra-upsell-wrapper">
			<ul class="upsell-features">
				<h3 class="upsell-heading"><?php esc_html_e( 'More Awesome Features', 'zakra' ); ?></h3>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( 'Advanced Header Options', 'zakra' ); ?>
				</li>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( 'Flexible Menu Designs', 'zakra' ); ?>
				</li>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( 'Grid, Masonry, Thumbnail Blog', 'zakra' ); ?>
				</li>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( '10+ Footer Layouts', 'zakra' ); ?>
				</li>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( '100+ Customizer Options', 'zakra' ); ?>
				</li>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( '30+ Page Settings', 'zakra' ); ?>
				</li>
			</ul>

			<div class="launch-offer">
				<?php
				printf(
				/* translators: %1$s discount coupon code., %2$s discount percentage */
					esc_html__( 'Use the coupon code %1$s to get %2$s discount (limited time offer). Enjoy!', 'zakra' ),
					'<span class="coupon-code">save10</span>',
					'10%'
				);
				?>
			</div>
		</div>
		<?php
	}

}
