<?php
/**
 * Dynamic classes for this theme.
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'spacious_header_display_type_class' ) ) :

/**
* Function to return the classname for header option layout class.
*
* @return string CSS classname.
*/
function spacious_header_display_type_class() {

	$spacious_header_display_type = get_theme_mod( 'spacious_header_display_type', 'one' );
	if ( $spacious_header_display_type === 'one' ) {
		$header_class = 'spacious-header-display-one';
	} elseif ( $spacious_header_display_type === 'four' ) {
		$header_class = 'spacious-header-display-four';
	}

return $header_class;

}

endif;

