<?php
/**
 * Theme Footer Section for our theme.
 *
 * Displays all of the footer section and closing of the #main div.
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 1.0
 */

/**
* Functions hooked into spacious_action_main_end action.
*
* @hooked spacious_main_inner_wrap_end - 5
* @hooked spacious_main_end - 10
*/
do_action( 'spacious_action_main_end' );

/**
 * Hook: spacious_before_footer
 */
do_action( 'spacious_before_footer' );


/**
 * Functions hooked into spacious_action_footer_start action.
 *
 * @hooked spacious_footer_wrapper_start
 */
do_action( 'spacious_action_footer_start' );

/**
 * Functions hooked into spacious_action_footer_content action.
 *
 * @hooked spacious_footer_content
 */
do_action( 'spacious_action_footer_content' );

/**
 * Functions hooked into spacious_action_footer_end action.
 *
 * @hooked spacious_footer_wrapper_end
 */
do_action( 'spacious_action_footer_end' );

/**
 * Functions hooked into spacious_action_after_footer action.
 *
 * @hooked spacious_after_footer - 5
 * @hooked spacious_footer_page_end - 15
 */
do_action( 'spacious_action_after_footer' );

wp_footer(); ?>

</body>
</html>
