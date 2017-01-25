<?php
/**
 * Template Name: Business Template
 *
 * Displays the Business Template of the theme.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
get_header(); ?>

<div id="content" class="clearfix">

	<?php
	if( is_active_sidebar( 'spacious_business_page_top_section_sidebar' ) ) {
		// Calling the business page top section sidebar if it exists.
		if ( !dynamic_sidebar( 'spacious_business_page_top_section_sidebar' ) ):
		endif;
	}

	if( is_active_sidebar( 'spacious_business_page_middle_section_left_half_sidebar' ) || is_active_sidebar( 'spacious_business_page_middle_section_right_half_sidebar' )) {
	?>
	<!-- <div class="clearfix"> -->
		<div class="tg-one-half">
			<?php
			// Calling the business page middle section left half sidebar if it exists.
			if ( !dynamic_sidebar( 'spacious_business_page_middle_section_left_half_sidebar' ) ):
			endif;
			?>
		</div>
		<div class="tg-one-half tg-one-half-last">
			<?php
			// Calling the business page middle section right half sidebar if it exists.
			if ( !dynamic_sidebar( 'spacious_business_page_middle_section_right_half_sidebar' ) ):
			endif;
			?>
		</div>
	<div class="clearfix"></div>
	<?php
	}

	if( is_active_sidebar( 'spacious_business_page_bottom_section_sidebar' ) ) {
		// Calling the business page bottom section sidebar if it exists.
		if ( !dynamic_sidebar( 'spacious_business_page_bottom_section_sidebar' ) ):
		endif;
	}
	?>

	</div>

<?php get_footer(); ?>
