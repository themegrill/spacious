<?php
/**
 * The Sidebar containing the footer widget areas.
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 1.0
 */

/**
 * The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
if ( ! is_active_sidebar( 'spacious_footer_sidebar_one' ) &&
     ! is_active_sidebar( 'spacious_footer_sidebar_two' ) &&
     ! is_active_sidebar( 'spacious_footer_sidebar_three' ) &&
     ! is_active_sidebar( 'spacious_footer_sidebar_four' ) ) {
	return;
}

if ( get_theme_mod( 'spacious_footer_widget_column_select_type', 'four' ) == 'one' ) {
	$footer_column_one   = 'tg-column-full';
	$footer_column_two   = '';
	$footer_column_three = '';
	$footer_column_four  = '';
} elseif ( get_theme_mod( 'spacious_footer_widget_column_select_type', 'four' ) == 'two' ) {
	$footer_column_one   = 'tg-one-half';
	$footer_column_two   = 'tg-one-half tg-one-half-last';
	$footer_column_three = '';
	$footer_column_four  = '';
} elseif ( get_theme_mod( 'spacious_footer_widget_column_select_type', 'four' ) == 'three' ) {
	$footer_column_one   = 'tg-one-third';
	$footer_column_two   = 'tg-one-third tg-column-2';
	$footer_column_three = 'tg-one-third tg-after-two-blocks-clearfix';
	$footer_column_four  = '';
} elseif ( get_theme_mod( 'spacious_footer_widget_column_select_type', 'four' ) == 'four' ) {
	$footer_column_one   = 'tg-one-fourth tg-column-1';
	$footer_column_two   = 'tg-one-fourth tg-column-2';
	$footer_column_three = 'tg-one-fourth tg-after-two-blocks-clearfix tg-column-3';
	$footer_column_four  = 'tg-one-fourth tg-one-fourth-last tg-column-4';
}
?>
<div class="footer-widgets-wrapper">
	<div class="inner-wrap">
		<div class="footer-widgets-area clearfix">
			<div class="<?php echo $footer_column_one; ?>">
				<?php
				// Calling the footer sidebar if it exists.
				if ( ! dynamic_sidebar( 'spacious_footer_sidebar_one' ) ):
				endif;
				?>
			</div>
			<?php if ( $footer_column_two != '' ) { ?>
				<div class="<?php echo $footer_column_two; ?>">
					<?php
					// Calling the footer sidebar if it exists.
					if ( ! dynamic_sidebar( 'spacious_footer_sidebar_two' ) ):
					endif;
					?>
				</div>
			<?php } ?>
			<?php if ( $footer_column_three != '' ) { ?>
				<div class="<?php echo $footer_column_three; ?>">
					<?php
					// Calling the footer sidebar if it exists.
					if ( ! dynamic_sidebar( 'spacious_footer_sidebar_three' ) ):
					endif;
					?>
				</div>
			<?php } ?>
			<?php if ( $footer_column_four != '' ) { ?>
				<div class="<?php echo $footer_column_four; ?>">
					<?php
					// Calling the footer sidebar if it exists.
					if ( ! dynamic_sidebar( 'spacious_footer_sidebar_four' ) ):
					endif;
					?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
