<?php
/**
 * Spacious Admin Class.
 *
 * @author  ThemeGrill
 * @package spacious
 * @since   1.3.8
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class Spacious_Admin
 */
class Spacious_Admin {

	/**
	 * Spacious_Admin constructor.
	 */
	public function __construct() {
		add_action( 'wp_loaded', array( $this, 'admin_notice' ), 20 );
		add_action( 'wp_loaded', array( $this, 'hide_notices' ), 15 );
		add_action( 'wp_ajax_import_button', array( $this, 'tg_ajax_import_button_handler' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'tg_ajax_enqueue_scripts' ) );
	}

	/**
	 * Localize array for import button AJAX request.
	 */
	public function tg_ajax_enqueue_scripts() {

		wp_enqueue_script( 'spacious-plugin-install-helper', get_template_directory_uri() . '/inc/admin/js/plugin-handle.js', array( 'jquery' ), 1, true );

		$translation_array = array(
			'uri'      => esc_url( admin_url( '/themes.php?page=demo-importer&browse=all&spacious-hide-notice=welcome' ) ),
			'btn_text' => esc_html__( 'Processing...', 'spacious' ),
			'nonce'    => wp_create_nonce( 'spacious_demo_import_nonce' ),
		);

		wp_localize_script( 'spacious-plugin-install-helper', 'spacious_redirect_demo_page', $translation_array );

	}

	/**
	 * Handle the AJAX process while import or get started button clicked.
	 */
	public function tg_ajax_import_button_handler() {

		check_ajax_referer( 'spacious_demo_import_nonce', 'security' );

		$state = '';

		if ( class_exists( 'themegrill_demo_importer' ) ) {
			$state = 'activated';
		} elseif ( file_exists( WP_PLUGIN_DIR . '/themegrill-demo-importer/themegrill-demo-importer.php' ) ) {
			$state = 'installed';
		}

		if ( 'activated' === $state ) {
			$response['redirect'] = admin_url( '/themes.php?page=demo-importer&browse=all&spacious-hide-notice=welcome' );
		} elseif ( 'installed' === $state ) {
			$response['redirect'] = admin_url( '/themes.php?page=demo-importer&browse=all&spacious-hide-notice=welcome' );
			if ( current_user_can( 'activate_plugin' ) ) {
				$result = activate_plugin( 'themegrill-demo-importer/themegrill-demo-importer.php' );

				if ( is_wp_error( $result ) ) {
					$response['errorCode']    = $result->get_error_code();
					$response['errorMessage'] = $result->get_error_message();
				}
			}
		} else {
			wp_enqueue_style( 'plugin-install' );
			wp_enqueue_script( 'plugin-install' );
			$response['redirect'] = admin_url( '/themes.php?page=demo-importer&browse=all&spacious-hide-notice=welcome' );
			/**
			 * Install Plugin.
			 */
			include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
			include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

			$api = plugins_api( 'plugin_information', array(
				'slug'   => sanitize_key( wp_unslash( 'themegrill-demo-importer' ) ),
				'fields' => array(
					'sections' => false,
				),
			) );

			$skin     = new WP_Ajax_Upgrader_Skin();
			$upgrader = new Plugin_Upgrader( $skin );
			$result   = $upgrader->install( $api->download_link );
			if ( $result ) {
				$response['installed'] = 'succeed';
			} else {
				$response['installed'] = 'failed';
			}

			// Activate plugin.
			if ( current_user_can( 'activate_plugin' ) ) {
				$result = activate_plugin( 'themegrill-demo-importer/themegrill-demo-importer.php' );

				if ( is_wp_error( $result ) ) {
					$response['errorCode']    = $result->get_error_code();
					$response['errorMessage'] = $result->get_error_message();
				}
			}
		}

		wp_send_json( $response );

		exit();

	}

	/**
	 * Add admin notice.
	 */
	public function admin_notice() {
		wp_enqueue_style( 'spacious-message', get_template_directory_uri() . '/css/admin/message.css', array(), SPACIOUS_THEME_VERSION );

		// Let's bail on theme activation.
		$notice_nag = get_option( 'spacious_admin_notice_welcome' );
		if ( ! $notice_nag ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
		}
	}

	/**
	 * Hide a notice if the GET variable is set.
	 */
	public static function hide_notices() {

		if ( isset( $_GET['spacious-hide-notice'] ) && isset( $_GET['_spacious_notice_nonce'] ) ) { // WPCS: input var ok.
			if ( ! wp_verify_nonce( wp_unslash( $_GET['_spacious_notice_nonce'] ), 'spacious_hide_notices_nonce' ) ) { // phpcs:ignore WordPress.VIP.ValidatedSanitizedInput.InputNotSanitized
				wp_die( __( 'Action failed. Please refresh the page and retry.', 'spacious' ) ); // WPCS: xss ok.
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( __( 'Cheatin&#8217; huh?', 'spacious' ) ); // WPCS: xss ok.
			}

			$hide_notice = sanitize_text_field( wp_unslash( $_GET['spacious-hide-notice'] ) );
			update_option( 'spacious_admin_notice_' . $hide_notice, 1 );

			// Hide.
			if ( 'welcome' === $_GET['spacious-hide-notice'] ) {
				update_option( 'spacious_admin_notice_' . $hide_notice, 1 );
			} else { // Show.
				delete_option( 'spacious_admin_notice_' . $hide_notice );
			}
		}

	}

	/**
	 * Return or echo `Get started/Import button` HTML.
	 *
	 * @param bool   $return    Return or echo.
	 * @param string $slug      Plugin slug to install.
	 * @param string $text      Text string for button.
	 * @param string $css_class CSS class list for button link.
	 *
	 */
	public static function import_button_html( $return = false, $slug = 'themegrill-demo-importer', $text, $css_class = 'btn-get-started button button-primary button-hero' ) {

		if ( true === $return ) {
			return '<a class="' . esc_attr( $css_class ) . '"
		   href="#" data-name="' . esc_attr( $slug ) . '" data-slug="' . esc_attr( $slug ) . '" aria-label="' . esc_attr__( 'Get started with Spacious', 'spacious' ) . '">' . esc_html( $text ) . '</a>';
		} else {
			echo '<a class="' . esc_attr( $css_class ) . '"
					href="#" data-name="' . esc_attr( $slug ) . '" data-slug="' . esc_attr( $slug ) . '" aria-label="' . esc_attr__( 'Get started with Spacious', 'spacious' ) . '">' . esc_html( $text ) . '</a>';
		}

	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice() {
		?>

		<div id="message" class="updated notice-info spacious-message">
			<a class="spacious-message-close notice-dismiss"
			   href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'spacious-hide-notice', 'welcome' ) ), 'spacious_hide_notices_nonce', '_spacious_notice_nonce' ) ); ?>">
				<?php esc_html_e( 'Dismiss', 'spacious' ); ?>
			</a>
			<div class="spacious-message-wrapper">
				<img class="spacious-screenshot" src="<?php echo get_template_directory_uri(); ?>/screenshot.jpg" alt="<?php esc_html_e( 'Spacious', 'spacious' ); ?>" /><?php // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped, Squiz.PHP.EmbeddedPhp.SpacingBeforeClose ?>

				<div class="spacious-getting-started-notice">
					<h2>
						<?php
						printf(
						/* translators: 1: welcome page link starting html tag, 2: welcome page link ending html tag. */
							esc_html__( 'Welcome! Thank you for choosing Spacious! To fully take advantage of the best our theme can offer, please make sure you visit our %1$swelcome page%2$s.', 'spacious' ), '<a href="' . esc_url( admin_url( 'themes.php?page=spacious-options' ) ) . '">', '</a>' );
						?>
					</h2>

					<p class="plugin-install-notice"><?php esc_html_e( 'Clicking the button below will install and activate the ThemeGrill demo importer plugin.', 'spacious' ); ?></p>

					<?php self::import_button_html( false, '', esc_html__( 'Get started with Spacious', 'spacious' ) ); ?>
				</div>
			</div>
		</div>
		<?php
	}

}

$admin = new Spacious_Admin();
