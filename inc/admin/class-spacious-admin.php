<?php
/**
 * Spacious Admin Class.
 *
 * @author  ThemeGrill
 * @package spacious
 * @since   1.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Spacious_Admin' ) ) :

/**
 * Spacious_Admin Class.
 */
class Spacious_Admin {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
		add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
	}

	/**
	 * Add admin menu.
	 */
	public function admin_menu() {
		$theme = wp_get_theme( get_template() );

		$page = add_theme_page( esc_html__( 'About', 'spacious' ) . ' ' . $theme->display( 'Name' ), esc_html__( 'About', 'spacious' ) . ' ' . $theme->display( 'Name' ), 'activate_plugins', 'spacious-welcome', array( $this, 'welcome_screen' ) );
		add_action( 'admin_print_styles-' . $page, array( $this, 'enqueue_styles' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public function enqueue_styles() {
		global $spacious_version;

		wp_enqueue_style( 'spacious-welcome', get_template_directory_uri() . '/css/admin/welcome.css', array(), $spacious_version );
	}

	/**
	 * Add admin notice.
	 */
	public function admin_notice() {
		global $spacious_version, $pagenow;

		wp_enqueue_style( 'spacious-message', get_template_directory_uri() . '/css/admin/message.css', array(), $spacious_version );

		// Let's bail on theme activation.
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			update_option( 'spacious_admin_notice_welcome', 1 );

		// No option? Let run the notice wizard again..
		} elseif( ! get_option( 'spacious_admin_notice_welcome' ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
		}
	}

	/**
	 * Hide a notice if the GET variable is set.
	 */
	public static function hide_notices() {
		if ( isset( $_GET['spacious-hide-notice'] ) && isset( $_GET['_spacious_notice_nonce'] ) ) {
			if ( ! wp_verify_nonce( $_GET['_spacious_notice_nonce'], 'spacious_hide_notices_nonce' ) ) {
				wp_die( __( 'Action failed. Please refresh the page and retry.', 'spacious' ) );
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( __( 'Cheatin&#8217; huh?', 'spacious' ) );
			}

			$hide_notice = sanitize_text_field( $_GET['spacious-hide-notice'] );
			update_option( 'spacious_admin_notice_' . $hide_notice, 1 );
		}
	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice() {
		?>
		<div id="message" class="updated spacious-message">
			<a class="spacious-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'spacious-hide-notice', 'welcome' ) ), 'spacious_hide_notices_nonce', '_spacious_notice_nonce' ) ); ?>"><?php _e( 'Dismiss', 'spacious' ); ?></a>
			<p><?php printf( esc_html__( 'Welcome! Thank you for choosing Spacious! To fully take advantage of the best our theme can offer please make sure you visit our %swelcome page%s.', 'spacious' ), '<a href="' . esc_url( admin_url( 'themes.php?page=spacious-welcome' ) ) . '">', '</a>' ); ?></p>
			<p class="submit">
				<a class="button-secondary" href="<?php echo esc_url( admin_url( 'themes.php?page=spacious-welcome' ) ); ?>"><?php esc_html_e( 'Get started with Spacious', 'spacious' ); ?></a>
			</p>
		</div>
		<?php
	}

	/**
	 * Intro text/links shown to all about pages.
	 *
	 * @access private
	 */
	private function intro() {
		global $spacious_version;

		$theme = wp_get_theme( get_template() );

		// Drop minor version if 0
		$major_version = substr( $spacious_version, 0, 3 );
		?>
		<div class="spacious-theme-info">
			<h1>
				<?php esc_html_e('About', 'spacious'); ?>
				<?php echo $theme->display( 'Name' ); ?>
				<?php printf( '%s', $major_version ); ?>
			</h1>

			<div class="welcome-description-wrap">
				<div class="about-text"><?php echo $theme->display( 'Description' ); ?></div>

				<div class="spacious-screenshot">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" />
				</div>
			</div>
		</div>

		<p class="spacious-actions">
			<a href="<?php echo esc_url( 'http://themegrill.com/themes/spacious/' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Info', 'spacious' ); ?></a>

			<a href="<?php echo esc_url( 'http://demo.themegrill.com/spacious/' ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'View Demo', 'spacious' ); ?></a>

			<a href="<?php echo esc_url( 'http://themegrill.com/themes/spacious-pro/' ); ?>" class="button button-primary docs" target="_blank"><?php esc_html_e( 'View PRO version', 'spacious' ); ?></a>

			<a href="<?php echo esc_url( 'https://wordpress.org/support/theme/spacious/reviews?rate=5#new-post' ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'Rate this theme', 'spacious' ); ?></a>
		</p>

		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php if ( empty( $_GET['tab'] ) && $_GET['page'] == 'spacious-welcome' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'spacious-welcome' ), 'themes.php' ) ) ); ?>">
				<?php echo $theme->display( 'Name' ); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'supported_plugins' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'spacious-welcome', 'tab' => 'supported_plugins' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Supported Plugins', 'spacious' ); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'free_vs_pro' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'spacious-welcome', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Free Vs Pro', 'spacious' ); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'changelog' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'spacious-welcome', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Changelog', 'spacious' ); ?>
			</a>
		</h2>
		<?php
	}

	/**
	 * Welcome screen page.
	 */
	public function welcome_screen() {
		$current_tab = empty( $_GET['tab'] ) ? 'about' : sanitize_title( $_GET['tab'] );

		// Look for a {$current_tab}_screen method.
		if ( is_callable( array( $this, $current_tab . '_screen' ) ) ) {
			return $this->{ $current_tab . '_screen' }();
		}

		// Fallback to about screen.
		return $this->about_screen();
	}

	/**
	 * Output the about screen.
	 */
	public function about_screen() {
		$theme = wp_get_theme( get_template() );
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<div class="changelog point-releases">
				<div class="under-the-hood two-col">
					<div class="col">
						<h3><?php esc_html_e( 'Theme Customizer', 'spacious' ); ?></h3>
						<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'spacious' ) ?></p>
						<p><a href="<?php echo admin_url( 'customize.php' ); ?>" class="button button-secondary"><?php esc_html_e( 'Customize', 'spacious' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Documentation', 'spacious' ); ?></h3>
						<p><?php esc_html_e( 'Please view our documentation page to setup the theme.', 'spacious' ) ?></p>
						<p><a href="<?php echo esc_url( 'http://themegrill.com/theme-instruction/spacious/' ); ?>" class="button button-secondary"><?php esc_html_e( 'Documentation', 'spacious' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Got theme support question?', 'spacious' ); ?></h3>
						<p><?php esc_html_e( 'Please put it in our dedicated support forum.', 'spacious' ) ?></p>
						<p><a href="<?php echo esc_url( 'http://themegrill.com/support-forum/' ); ?>" class="button button-secondary"><?php esc_html_e( 'Support Forum', 'spacious' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Need more features?', 'spacious' ); ?></h3>
						<p><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'spacious' ) ?></p>
						<p><a href="<?php echo esc_url( 'http://themegrill.com/themes/spacious-pro/' ); ?>" class="button button-secondary"><?php esc_html_e( 'View Pro', 'spacious' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Got sales related question?', 'spacious' ); ?></h3>
						<p><?php esc_html_e( 'Please send it via our sales contact page.', 'spacious' ) ?></p>
						<p><a href="<?php echo esc_url( 'http://themegrill.com/contact/' ); ?>" class="button button-secondary"><?php esc_html_e( 'Contact Page', 'spacious' ); ?></a></p>
					</div>

					<div class="col">
						<h3>
							<?php
							esc_html_e( 'Translate', 'spacious' );
							echo ' ' . $theme->display( 'Name' );
							?>
						</h3>
						<p><?php esc_html_e( 'Click below to translate this theme into your own language.', 'spacious' ) ?></p>
						<p>
							<a href="<?php echo esc_url( 'http://translate.wordpress.org/projects/wp-themes/spacious' ); ?>" class="button button-secondary">
								<?php
								esc_html_e( 'Translate', 'spacious' );
								echo ' ' . $theme->display( 'Name' );
								?>
							</a>
						</p>
					</div>
				</div>
			</div>

			<div class="return-to-dashboard spacious">
				<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
					<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
						<?php is_multisite() ? esc_html_e( 'Return to Updates', 'spacious' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'spacious' ); ?>
					</a> |
				<?php endif; ?>
				<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'spacious' ) : esc_html_e( 'Go to Dashboard', 'spacious' ); ?></a>
			</div>
		</div>
		<?php
	}

	/**
	 * Output the changelog screen.
	 */
	public function changelog_screen() {
		global $wp_filesystem;

		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php esc_html_e( 'View changelog below:', 'spacious' ); ?></p>

			<?php
				$changelog_file = apply_filters( 'spacious_changelog_file', get_template_directory() . '/readme.txt' );

				// Check if the changelog file exists and is readable.
				if ( $changelog_file && is_readable( $changelog_file ) ) {
					WP_Filesystem();
					$changelog = $wp_filesystem->get_contents( $changelog_file );
					$changelog_list = $this->parse_changelog( $changelog );

					echo wp_kses_post( $changelog_list );
				}
			?>
		</div>
		<?php
	}

	/**
	 * Parse changelog from readme file.
	 * @param  string $content
	 * @return string
	 */
	private function parse_changelog( $content ) {
		$matches   = null;
		$regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
		$changelog = '';

		if ( preg_match( $regexp, $content, $matches ) ) {
			$changes = explode( '\r\n', trim( $matches[1] ) );

			$changelog .= '<pre class="changelog">';

			foreach ( $changes as $index => $line ) {
				$changelog .= wp_kses_post( preg_replace( '~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
			}

			$changelog .= '</pre>';
		}

		return wp_kses_post( $changelog );
	}

	/**
	 * Output the supported plugins screen.
	 */
	public function supported_plugins_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php esc_html_e( 'This theme recommends following plugins:', 'spacious' ); ?></p>
			<ol>
				<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/social-icons/' ); ?>" target="_blank"><?php esc_html_e( 'Social Icons', 'spacious' ); ?></a>
					<?php esc_html_e(' by ThemeGrill', 'spacious'); ?>
				</li>
				<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/easy-social-sharing/' ); ?>" target="_blank"><?php esc_html_e( 'Easy Social Sharing', 'spacious' ); ?></a>
					<?php esc_html_e(' by ThemeGrill', 'spacious'); ?>
				</li>
				<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/contact-form-7/' ); ?>" target="_blank"><?php esc_html_e( 'Contact Form 7', 'spacious' ); ?></a></li>
				<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/wp-pagenavi/' ); ?>" target="_blank"><?php esc_html_e( 'WP-PageNavi', 'spacious' ); ?></a></li>
				<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/breadcrumb-navxt/' ); ?>" target="_blank"><?php esc_html_e( 'Breadcrumb NavXT', 'spacious' ); ?></a></li>
				<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/woocommerce/' ); ?>" target="_blank"><?php esc_html_e( 'WooCommerce', 'spacious' ); ?></a></li>
				<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/polylang/' ); ?>" target="_blank"><?php esc_html_e( 'Polylang', 'spacious' ); ?></a>
					<?php esc_html_e('Fully Compatible in Pro Version', 'spacious'); ?>
				</li>
				<li><a href="<?php echo esc_url( 'https://wpml.org/' ); ?>" target="_blank"><?php esc_html_e( 'WPML', 'spacious' ); ?></a>
					<?php esc_html_e('Fully Compatible in Pro Version', 'spacious'); ?>
				</li>
			</ol>

		</div>
		<?php
	}

	/**
	 * Output the free vs pro screen.
	 */
	public function free_vs_pro_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'spacious' ); ?></p>

			<table>
				<thead>
					<tr>
						<th class="table-feature-title"><h3><?php esc_html_e('Features', 'spacious'); ?></h3></th>
						<th><h3><?php esc_html_e('Spacious', 'spacious'); ?></h3></th>
						<th><h3><?php esc_html_e('Spacious Pro', 'spacious'); ?></h3></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><h3><?php esc_html_e('Slider', 'spacious'); ?></h3></td>
						<td><?php esc_html_e('5', 'spacious'); ?></td>
						<td><?php esc_html_e('Unlimited Slides', 'spacious'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Slider Settings', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><?php esc_html_e('Slides type, duration & delay time', 'spacious'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Google Fonts Option', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><?php esc_html_e('600+', 'spacious'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Font Size options', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Color Palette', 'spacious'); ?></h3></td>
						<td><?php esc_html_e('Primary Color Option', 'spacious'); ?></td>
						<td><?php esc_html_e('Multiple Color Options', 'spacious'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Additional Top Header', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><?php esc_html_e('Social Icons + Menu + Header text option', 'spacious'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Social Icons', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Boxed & Wide layout option', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Light & Dark Color skin', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Woocommerce Compatible', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Woocommerce Page Layouts', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Translation Ready', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('WPML Compatible', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Polylang Compatible', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Breadcrumb NavXT Compatible', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('BreadCrumb Custom Text', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Author Bio', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Footer Copyright Editor', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Footer Widgets Column', 'spacious'); ?></h3></td>
						<td><?php esc_html_e('One Column', 'spacious'); ?></td>
						<td><?php esc_html_e('1,2,3,4 Columns', 'spacious'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Demo Content', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Support', 'spacious'); ?></h3></td>
						<td><?php esc_html_e('Forum', 'spacious'); ?></td>
						<td><?php esc_html_e('Forum + Emails/Support Ticket', 'spacious'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Services widget', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Call to Action widget', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Featured Single page widget', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Featured widget (Recent Work/Portfolio)', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Testimonial', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Featured Posts', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Our Clients', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td class="btn-wrapper">
							<a href="<?php echo esc_url( apply_filters( 'spacious_pro_theme_url', 'http://themegrill.com/themes/spacious-pro/' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'View Pro', 'spacious' ); ?></a>
						</td>
					</tr>
				</tbody>
			</table>

		</div>
		<?php
	}
}

endif;

return new Spacious_Admin();
