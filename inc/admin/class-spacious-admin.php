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
		add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
	}

	/**
	 * Add admin menu.
	 */
	public function admin_menu() {
		$page = add_theme_page( __( 'Welcome to Spacious', 'spacious' ), __( 'Spacious', 'spacious' ), 'activate_plugins', 'spacious-welcome', array( $this, 'welcome_screen' ) );
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
		global $pagenow;

		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
		}
	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice() {
		?>
		<div class="updated notice is-dismissible">
			<p><?php echo sprintf( esc_html__( 'Welcome! Thank you for choosing Spacious! To fully take advantage of the best our theme can offer please make sure you visit our %swelcome page%s.', 'spacious' ), '<a href="' . esc_url( admin_url( 'themes.php?page=spacious-welcome' ) ) . '">', '</a>' ); ?></p>
			<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=spacious-welcome' ) ); ?>" class="button" style="text-decoration: none;"><?php _e( 'Get started with Spacious', 'spacious' ); ?></a></p>
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
			<div class="welcome-description-wrap">
				<h1><?php printf( __( 'Welcome to Spacious %s', 'spacious' ), $major_version ); ?></h1>

				<div class="about-text"><?php echo $theme->display( 'Description' ); ?></div>
			</div>
		
			<div class="spacious-screenshot">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" />
			</div>
		</div>

		<p class="spacious-actions">
			<a href="<?php echo admin_url( 'customize.php' ); ?>" class="button button-primary"><?php _e( 'Customize', 'spacious' ); ?></a>

			<a href="<?php echo esc_url( apply_filters( 'spacious_pro_theme_url', 'http://themegrill.com/themes/spacious-pro/' ) ); ?>" class="button button-secondary docs" target="_blank"><?php _e( 'View Pro', 'spacious' ); ?></a>
		</p>

		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php if ( empty( $_GET['tab'] ) && $_GET['page'] == 'spacious-welcome' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'spacious-welcome' ), 'themes.php' ) ) ); ?>">
				<?php _e( "Spacious", 'spacious' ); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'changelog' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'spacious-welcome', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>">
				<?php _e( 'Changelog', 'spacious' ); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'supported_plugins' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'spacious-welcome', 'tab' => 'supported_plugins' ), 'themes.php' ) ) ); ?>">
				<?php _e( 'Supported Plugins', 'spacious' ); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'free_vs_pro' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'spacious-welcome', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>">
				<?php _e( 'Free Vs Pro', 'spacious' ); ?>
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
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<div class="changelog point-releases">
				<div class="under-the-hood two-col">
					<div class="col">
						<h3><?php echo esc_html_e( 'Theme Customizer', 'spacious' ); ?></h3>
						<p><?php esc_html_e( 'Spacious supports all of the settings of the theme using the Customizer options. So, start customizing this theme using the customize section.', 'spacious' ) ?></p>
						<p><a href="<?php echo admin_url( 'customize.php' ); ?>" class="button button-primary"><?php _e( 'Customize', 'spacious' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php echo esc_html_e( 'Theme Documentation', 'spacious' ); ?></h3>
						<p><?php esc_html_e( 'Need any help in making your site look like our demo? You can visit our documentation page and set up your site like our demo.', 'spacious' ) ?></p>
						<p><a href="<?php echo esc_url( 'http://themegrill.com/theme-instruction/spacious/' ); ?>" class="button button-secondary"><?php _e( 'Documentation', 'spacious' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php echo esc_html_e( 'Need any support?', 'spacious' ); ?></h3>
						<p><?php esc_html_e( 'You could not setup your site and require any help regarding the theme issues? Then, we are here to help you to set it up properly.', 'spacious' ) ?></p>
						<p><a href="<?php echo esc_url( 'http://themegrill.com/support-forum/' ); ?>" class="button button-secondary"><?php _e( 'Support Forum', 'spacious' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php echo esc_html_e( 'Need more exciting features', 'spacious' ); ?></h3>
						<p><?php esc_html_e( 'You are fully satisfied with the free theme and need more features in the theme. Then, the pro version of this theme will provide you with more flexible options.', 'spacious' ) ?></p>
						<p><a href="<?php echo esc_url( 'http://themegrill.com/themes/spacious-pro/' ); ?>" class="button button-secondary"><?php _e( 'View Pro', 'spacious' ); ?></a></p>
					</div>
				</div>
			</div>

			<div class="return-to-dashboard spacious">
				<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
					<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
						<?php is_multisite() ? _e( 'Return to Updates' ) : _e( 'Return to Dashboard &rarr; Updates' ); ?>
					</a> |
				<?php endif; ?>
				<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? _e( 'Go to Dashboard &rarr; Home' ) : _e( 'Go to Dashboard' ); ?></a>
			</div>
		</div>
		<?php
	}

	/**
	 * Output the changelog screen.
	 */
	public function changelog_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php esc_html_e( 'Our theme is constanly updated with more bug fixes and new feature addition. You can see all of the changes done in this theme from below.', 'spacious' ); ?></p>

			<?php
			WP_Filesystem();
			global $wp_filesystem;
			$spacious_changelog = $wp_filesystem->get_contents( get_template_directory().'/changelog.txt' );
			$spacious_changelog_lines = explode(PHP_EOL, $spacious_changelog);
			foreach($spacious_changelog_lines as $spacious_changelog_line) {
				echo nl2br(esc_html($spacious_changelog_line));
				echo '<br />';
			}
			?>

		</div>
		<?php
	}

	/**
	 * Output the supported plugins screen.
	 */
	public function supported_plugins_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php _e( 'This theme supports many plugins which are available in the WordPress plugin directory.', 'spacious' ); ?></p>
			<ol>
				<li><?php printf(__('<a href="%s" target="_blank">Contact Form 7</a>', 'spacious'), esc_url('https://wordpress.org/plugins/contact-form-7/')); ?></li>
				<li><?php printf(__('<a href="%s" target="_blank">WP-PageNavi</a>', 'spacious'), esc_url('https://wordpress.org/plugins/wp-pagenavi/')); ?></li>
				<li><?php printf(__('<a href="%s" target="_blank">Breadcrumb NavXT</a>', 'spacious'), esc_url('https://wordpress.org/plugins/breadcrumb-navxt/')); ?></li>
				<li><?php printf(__('<a href="%s" target="_blank">WooCommerce</a>', 'spacious'), esc_url('https://wordpress.org/plugins/woocommerce/')); ?></li>
				<li><?php printf(__('<a href="%s" target="_blank">Polylang</a> &amp; <a href="%s" target="_blank">WPML</a> - Avaiable in Pro Version', 'spacious'), esc_url('https://wordpress.org/plugins/polylang/'), esc_url('https://wpml.org/')); ?></li>
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

			<p class="about-description"><?php _e( 'There are many features available in this theme already, although many more features are available in the pro version of this theme. The list can be found as below for their differences.', 'spacious' ); ?></p>

			<table>
				<thead>
					<tr>
						<th></th>
						<th><h3><?php esc_html_e('Spacious', 'spacious'); ?></h3></th>
						<th><h3><?php esc_html_e('Spacious Pro', 'spacious'); ?></h3></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><h3><?php esc_html_e('Slider', 'spacious'); ?></h3></td>
						<td><?php esc_html_e('4', 'spacious'); ?></td>
						<td><?php esc_html_e('Unlimited Slides', 'spacious'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Google Fonts Option', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><?php esc_html_e('600+', 'spacious'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Font Size options', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></td>
						<td><span class="dashicons dashicons-yes"></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Primary Color', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></td>
						<td><span class="dashicons dashicons-yes"></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Multiple Color Options', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></td>
						<td><?php esc_html_e('35+ color options', 'spacious'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Additional Top Header', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></td>
						<td><?php esc_html_e('Social Icons + Menu + Header text option', 'spacious'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Social Icons', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></td>
						<td><span class="dashicons dashicons-yes"></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Boxed & Wide layout option', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></td>
						<td><span class="dashicons dashicons-yes"></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Light & Dark Color skin', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></td>
						<td><span class="dashicons dashicons-yes"></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Woocommerce Compatible', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></td>
						<td><span class="dashicons dashicons-yes"></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Translation Ready', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></td>
						<td><span class="dashicons dashicons-yes"></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('WPML Compatible', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></td>
						<td><span class="dashicons dashicons-yes"></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Polylang Compatible', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></td>
						<td><span class="dashicons dashicons-yes"></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Breadcrumb NavXT Compatible', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></td>
						<td><span class="dashicons dashicons-yes"></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Footer Copyright Editor', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></td>
						<td><span class="dashicons dashicons-yes"></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Support', 'spacious'); ?></h3></td>
						<td><?php esc_html_e('Forum', 'spacious'); ?></td>
						<td><?php esc_html_e('Forum + Emails/Support Ticket', 'spacious'); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Services widget', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></td>
						<td><span class="dashicons dashicons-yes"></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Call to Action widget', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></td>
						<td><span class="dashicons dashicons-yes"></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Featured Singe page widget', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></td>
						<td><span class="dashicons dashicons-yes"></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Featured widget (Recent Work/Portfolio)', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></td>
						<td><span class="dashicons dashicons-yes"></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Testimonial', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></td>
						<td><span class="dashicons dashicons-yes"></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Featured Posts', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></td>
						<td><span class="dashicons dashicons-yes"></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('TG: Our Clients', 'spacious'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></td>
						<td><span class="dashicons dashicons-yes"></td>
					</tr>
				</tbody>
			</table>

		</div>
		<?php
	}
}

endif;

return new Spacious_Admin();
