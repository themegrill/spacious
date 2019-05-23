<?php

/**
 * Class Spacious_Typography_Control
 *
 * Extending `WP_Customize_Control` to include Spacious typography options.
 */
class Spacious_Typography_Control extends WP_Customize_Control {

	// Assign the type of control to be rendered.
	public $type = 'spacious-typography-options';

	/**
	 * Function to display typography select options in customize options.
	 */
	public function render_content() {
		$this_value = $this->value();
		?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

		<select class="spacious-typography-select" <?php $this->link(); ?>>

			<?php
			// Get Standard font options
			if ( $std_fonts = spacious_standard_fonts_array() ) { ?>
				<optgroup label="<?php esc_html_e( 'Standard Fonts', 'spacious' ); ?>">
					<?php
					// Loop through font options and add to select
					foreach ( $std_fonts as $font => $value ) { ?>
						<option value="<?php echo esc_html( $font ); ?>" <?php selected( $font, $this_value ); ?>><?php echo esc_html( $value ); ?></option>
					<?php } ?>
				</optgroup>
			<?php }
			?>

			<?php
			// Google font options
			if ( $google_fonts = spacious_google_fonts() ) { ?>
				<optgroup label="<?php esc_html_e( 'Google Fonts', 'spacious' ); ?>">
					<?php
					// Loop through font options and add to select
					foreach ( $google_fonts as $font ) { ?>
						<option value="<?php echo esc_html( $font ); ?>" <?php selected( $font, $this_value ); ?>><?php echo esc_html( $font ); ?></option>
					<?php } ?>
				</optgroup>
			<?php } ?>

		</select>

		<?php
	}
}
