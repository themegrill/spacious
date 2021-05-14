<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class Spacious_Upgrade_Notice extends Spacious_Notice {

	public function __construct() {
		if ( ! current_user_can( 'publish_posts' ) ) {
			return;
		}

		$dismiss_url = wp_nonce_url(
			add_query_arg( 'spacious_notice_dismiss', 'upgrade', admin_url() ),
			'spacious_upgrade_notice_dismiss_nonce',
			'_spacious_upgrade_notice_dismiss_nonce'
		);

		$temporary_dismiss_url = wp_nonce_url(
			add_query_arg( 'spacious_notice_dismiss_temporary', 'upgrade', admin_url() ),
			'spacious_upgrade_notice_dismiss_temporary_nonce',
			'_spacious_upgrade_notice_dismiss_temporary_nonce'
		);

		parent::__construct( 'upgrade', 'info', $dismiss_url, $temporary_dismiss_url );

		$this->set_notice_time();

		$this->set_temporary_dismiss_notice_time();

		$this->set_dismiss_notice();
	}

	private function set_notice_time() {
		if ( ! get_option( 'spacious_upgrade_notice_start_time' ) ) {
			update_option( 'spacious_upgrade_notice_start_time', time() );
		}
	}

	public function set_temporary_dismiss_notice_time() {
		if ( isset( $_GET['spacious_notice_dismiss_temporary'] ) && 'upgrade' === $_GET['spacious_notice_dismiss_temporary'] ) {
			update_user_meta( $this->current_user_id, 'spacious_upgrade_notice_dismiss_temporary_start_time', time() );
		}
	}

	public function set_dismiss_notice() {

		/**
		 * Do not show notice if:
		 *
		 * 1. It has not been 5 days since the theme is activated.
		 * 2. If the user has ignored the message partially for 2 days.
		 * 3. Dismiss always if clicked on 'Dismiss' button.
		 */
		if ( get_option( 'spacious_upgrade_notice_start_time' ) > strtotime( '-5 day' )
			|| get_user_meta( get_current_user_id(), 'spacious_upgrade_notice_dismiss', true )
			|| get_user_meta( get_current_user_id(), 'spacious_upgrade_notice_dismiss_temporary_start_time', true ) > strtotime( '-2 day' )
		) {
			add_filter( 'spacious_upgrade_notice_dismiss', '__return_true' );
		} else {
			add_filter( 'spacious_upgrade_notice_dismiss', '__return_false' );
		}
	}

	public function notice_markup() {
		?>
		<div class="notice notice-success spacious-notice">
			<a class="spacious-notice-dismiss notice-dismiss" href="<?php echo esc_url( $this->dismiss_url ); ?>"></a>

			<p class="notice-text">
				<?php
				$current_user = wp_get_current_user();

				printf(
					/* Translators: %1$s current user display name., %2$s this theme name., %3$s discount coupon code., %4$s discount percentage. */
					esc_html__(
						'Howdy, %1$s! You\'ve been using %2$s theme for a while now, and we hope you\'re happy with it. To access more premium features you can always upgrade to pro. All contents and settings will remain as it is after upgrading to pro, you basically start from where you left. Also, you can use the coupon code %3$s to get up to %4$s discount (limited time offer) while making the purchase. Enjoy! ',
						'spacious'
					),
					'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
					'Spacious',
					'<code class="coupon-code">TGFREEUSER</code>',
					'25%'
				);
				?>
			</p>

			<div class="links">
				<a href="<?php echo esc_url( $this->pricing_url ); ?>" class="button button-primary" target="_blank">
					<span class="dashicons dashicons-thumbs-up"></span>
					<span><?php esc_html_e( 'Upgrade to pro', 'spacious' ); ?></span>
				</a>

				<a href="<?php echo esc_url( $this->temporary_dismiss_url ); ?>" class="button button-secondary">
					<span class="dashicons dashicons-calendar"></span>
					<span><?php esc_html_e( 'Maybe later', 'spacious' ); ?></span>
				</a>

				<a href="https://themegrill.com/contact/?utm_source=spacious-dashboard-message&utm_medium=button-link&utm_campaign=pre-sales" class="button button-secondary" target="_blank">
					<span class="dashicons dashicons-info"></span>
					<span><?php esc_html_e( 'Got pre sales queries?', 'spacious' ); ?></span>
				</a>
			</div>
		</div> <!-- /spacious-notice -->
		<?php
	}
}

new Spacious_Upgrade_Notice();
