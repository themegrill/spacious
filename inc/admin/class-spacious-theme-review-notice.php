<?php
/**
 * Spacious Theme Review Notice Class.
 *
 * @author  ThemeGrill
 * @package Spacious
 * @since   1.6.3
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Class to display the theme review notice for this theme after certain period.
 *
 * Class Spacious_Theme_Review_Notice
 */
class Spacious_Theme_Review_Notice {

	/**
	 * Constructor function to include the required functionality for the class.
	 *
	 * Spacious_Theme_Review_Notice constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'review_reset' ) );
		add_action( 'after_setup_theme', array( $this, 'review_notice' ) );
		add_action( 'admin_notices', array( $this, 'review_notice_markup' ), 0 );
		add_action( 'admin_init', array( $this, 'spacious_ignore_theme_review_notice' ), 0 );
		add_action( 'admin_init', array( $this, 'spacious_ignore_theme_review_notice_partially' ), 0 );
		add_action( 'switch_theme', array( $this, 'review_notice_data_remove' ) );
	}

	public function review_reset() {

		if ( 'completed' !== get_option( 'spacious_theme_review_notice_reset' ) ) {

			$this->review_notice_data_remove();

			update_option( 'spacious_theme_review_notice_reset', 'completed' );
		}
	}

	/**
	 * Set the required option value as needed for theme review notice.
	 */
	public function review_notice() {

		// Set the installed time in `spacious_theme_installed_time` option table.
		if ( ! get_option( 'spacious_theme_installed_time' ) ) {
			update_option( 'spacious_theme_installed_time', time() );
		}
	}

	/**
	 * Show HTML markup if conditions meet.
	 */
	public function review_notice_markup() {

		$user_id                  = get_current_user_id();
		$ignored_notice           = get_user_meta( $user_id, 'spacious_ignore_theme_review_notice', true );
		$ignored_notice_partially = get_user_meta( $user_id, 'nag_spacious_ignore_theme_review_notice_partially', true );
		$dismiss_url              = wp_nonce_url(
			add_query_arg( 'nag_spacious_ignore_theme_review_notice', 0 ),
			'spacious_ignore_theme_review_notice_nonce',
			'_spacious_ignore_theme_review_notice_nonce'
		);
		$temporary_dismiss_url    = wp_nonce_url(
			add_query_arg( 'nag_spacious_ignore_theme_review_notice_partially', 0 ),
			'spacious_ignore_theme_review_notice_partially_nonce',
			'_spacious_ignore_theme_review_notice_nonce'
		);

		if ( ! current_user_can( 'edit_posts' ) ) {
			return;
		}

		/**
		 * Return from notice display if:
		 *
		 * 1. The theme installed is less than 14 days ago.
		 * 2. If the user has ignored the message partially for 14 days.
		 * 3. Dismiss always if clicked on 'I Already Did' button.
		 */
		if ( ( get_option( 'spacious_theme_installed_time' ) > strtotime( '-14 day' ) ) || ( $ignored_notice_partially > strtotime( '-14 day' ) ) || ( $ignored_notice ) ) {
			return;
		}
		?>

		<div class="notice notice-success spacious-notice theme-review-notice" style="position:relative;">
			<div class="spacious-message__content">
				<div class="spacious-message__image">
					<img class="spacious-logo--png" src="<?php echo esc_url( get_template_directory_uri() . '/inc/admin/images/spacious-logo-square.png' ); ?>" alt="<?php esc_attr_e( 'Spacious', 'spacious' ); ?>" />
				</div>
				<div class="spacious-message__text">
					<h3><?php echo esc_html( 'HAKUNA MATATA!' ); ?></h3>
					<p>(
					<?php
						printf(
							/* translators: %s: Smile icon */
							esc_html__( 'The above word is just to draw your attention. %s', 'spacious' ),
							'<span class="dashicons dashicons-smiley smile-icon"></span>'
						);
					?>
					)</p>
					<p>
						<?php
							printf(
								/* translators: %1$s: Opening of strong tag, %2$s: Theme's Name, %3$s: Closing of strong tag  */
								esc_html__( 'Hope you are having a nice experience with %1$s %2$s %3$s theme. Please provide this theme a nice review.', 'spacious' ),
								'<strong>',
								esc_html( wp_get_theme( get_template() ) ),
								'</strong>'
							);
						?>
					</p>
					<strong>
						<?php esc_html_e( 'What benefit would you have?', 'spacious' ); ?>
					</strong>
					<p>
						<?php
							printf(
								/* translators: %s: Smiley icon */
								esc_html__( 'Basically, it would encourage us to release updates regularly with new features & bug fixes so that you can keep on using the theme without any issues and also to provide free support like we have been doing. %s', 'spacious' ),
								'<span class="dashicons dashicons-smiley smile-icon"></span>'
							);
						?>
					</p>
					<div class="links">
						<a href="https://wordpress.org/support/theme/spacious/reviews/?filter=5#new-post" class="btn button-primary" target="_blank">
							<span class="dashicons dashicons-external"></span>
							<span><?php esc_html_e( 'Sure, I\'d love to!', 'spacious' ); ?></span>
						</a>
						<a href="<?php echo esc_url( $dismiss_url ); ?>" class="btn button-secondary">
							<span class="dashicons dashicons-smiley"></span>
							<span><?php esc_html_e( 'I already did!', 'spacious' ); ?></span>
						</a>
						<a href="<?php echo esc_url( $temporary_dismiss_url ); ?>" class="btn button-secondary">
							<span class="dashicons dashicons-calendar"></span>
							<span><?php esc_html_e( 'Maybe later', 'spacious' ); ?></span>
						</a>
						<a href="<?php echo esc_url( 'https://wordpress.org/support/theme/spacious/' ); ?>" class="btn button-secondary" target="_blank">
							<span class="dashicons dashicons-testimonial"></span>
							<span><?php esc_html_e( 'I have a query', 'spacious' ); ?></span>
						</a>
					</div><!-- /.links -->
				</div> <!-- /.spacious-message__text -->
				<a class="notice-dismiss" style="text-decoration:none;" href="<?php echo esc_url( $dismiss_url ); ?>"></a>
			</div><!-- /.spacious-message__content -->
		</div>

		<?php
	}

	/**
	 * Function to remove the theme review notice permanently as requested by the user.
	 */
	public function spacious_ignore_theme_review_notice() {

		/* If user clicks to ignore the notice, add that to their user meta */
		if ( isset( $_GET['nag_spacious_ignore_theme_review_notice'] ) && isset( $_GET['_spacious_ignore_theme_review_notice_nonce'] ) ) {

			if ( ! wp_verify_nonce( wp_unslash( $_GET['_spacious_ignore_theme_review_notice_nonce'] ), 'spacious_ignore_theme_review_notice_nonce' ) ) {
				wp_die( esc_html__( 'Action failed. Please refresh the page and retry.', 'spacious' ) );
			}

			if ( '0' === $_GET['nag_spacious_ignore_theme_review_notice'] ) {
				add_user_meta( get_current_user_id(), 'spacious_ignore_theme_review_notice', 'true', true );
			}
		}
	}

	/**
	 * Function to remove the theme review notice partially as requested by the user.
	 */
	public function spacious_ignore_theme_review_notice_partially() {

		/* If user clicks to ignore the notice, add that to their user meta */
		if ( isset( $_GET['nag_spacious_ignore_theme_review_notice_partially'] ) && isset( $_GET['_spacious_ignore_theme_review_notice_nonce'] ) ) {

			if ( ! wp_verify_nonce( wp_unslash( $_GET['_spacious_ignore_theme_review_notice_nonce'] ), 'spacious_ignore_theme_review_notice_partially_nonce' ) ) {
				wp_die( esc_html__( 'Action failed. Please refresh the page and retry.', 'spacious' ) );
			}

			if ( '0' === $_GET['nag_spacious_ignore_theme_review_notice_partially'] ) {
				update_user_meta( get_current_user_id(), 'nag_spacious_ignore_theme_review_notice_partially', time() );
			}
		}
	}

	/**
	 * Remove the data set after the theme has been switched to other theme.
	 */
	public function review_notice_data_remove() {

		$get_all_users        = get_users();
		$theme_installed_time = get_option( 'spacious_theme_installed_time' );

		// Delete options data.
		if ( $theme_installed_time ) {
			delete_option( 'spacious_theme_installed_time' );
		}

		// Delete user meta data for theme review notice.
		foreach ( $get_all_users as $user ) {
			$ignored_notice           = get_user_meta( $user->ID, 'spacious_ignore_theme_review_notice', true );
			$ignored_notice_partially = get_user_meta( $user->ID, 'nag_spacious_ignore_theme_review_notice_partially', true );

			// Delete permanent notice remove data.
			if ( $ignored_notice ) {
				delete_user_meta( $user->ID, 'spacious_ignore_theme_review_notice' );
			}

			// Delete partial notice remove data.
			if ( $ignored_notice_partially ) {
				delete_user_meta( $user->ID, 'nag_spacious_ignore_theme_review_notice_partially' );
			}
		}
	}
}

new Spacious_Theme_Review_Notice();
