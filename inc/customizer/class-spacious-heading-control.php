<?php
/**
 * Customizer Control: spacious-heading.
 *
 * @package     Spacious theme
 * @subpackage  Controls
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Range control
 */
class Spacious_Heading_Control extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'spacious-heading';

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
	 *
	 * @see WP_Customize_Control::print_template()
	 *
	 * @access protected
	 */
	protected function content_template() {
		?>
		<h4 class="spacious-customizer-heading">{{{ data.label }}}</h4>
		<div class="description">{{{ data.description }}}</div>
		<?php
	}
}
