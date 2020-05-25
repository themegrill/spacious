<?php
/**
 * Register customizer panels and sections.
 *
 * @package spacious
 */

/**
 * Section: Spacious Pro Upsell.
 */

$wp_customize->add_section(
	new Spacious_Customize_Section(
		$wp_customize,
		'spacious_customize_upsell_section',
		array(
			'title'    => esc_html__( 'View Pro Version', 'spacious' ),
			'priority' => 5,
		)
	)
);

