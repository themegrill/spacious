<?php
/**
 * Customize Upsellcontrol class.
 *
 * @package spacious
 *
 * @see     WP_Customize_Control
 * @access  public
 */

/**
 * Class Spacious_Customize_Upsell_Control
 */
class Spacious_Customize_Upsell_Control extends WP_Customize_Control {

	/**
	 * Customize control type.
	 *
	 * @access public
	 * @var    string
	 */
	public $type = 'spacious-upsell';

	/**
	 * Spacious_Customize_Upsell_Control constructor.
	 *
	 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string               $id      An specific ID of the section.
	 * @param array                $args    Section arguments.
	 */
	public function __construct( WP_Customize_Manager $manager, $id, array $args = array() ) {

		parent::__construct( $manager, $id, $args );

	}

	/**
	 * Enqueues scripts
	 */
	public function enqueue() {
		parent::enqueue();
	}

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see    WP_Customize_Control::to_json()
	 * @access public
	 * @return void
	 */
	public function to_json() {

		parent::to_json();

	}

	/**
	 * Renders the Underscore template for this control.
	 *
	 * @see    WP_Customize_Control::print_template()
	 * @access protected
	 * @return void
	 */
	protected function content_template() {
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

	/**
	 * Render content is still called, so be sure to override it with an empty function in your subclass as well.
	 */
	protected function render_content() {

	}

}
