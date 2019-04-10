<?php

class Spacious_Editor_Custom_Control extends WP_Customize_Control {

	public $type = "spacious_editor_control";

	public function render_content() {
		static $i = 1;
		?>
		<script type="text/javascript">
			( function ( $ ) {
				wp.customizerCtrlEditor = {
					init : function () {

						$( window ).load( function () {

							$( 'textarea.wp-editor-area' ).each( function () {
								var tArea  = $( this ),
								    id     = tArea.attr( 'id' ),
								    name   = tArea.attr( 'name' ),
								    input  = $( 'input[data-customize-setting-link="' + name + '"]' ),
								    editor = tinyMCE.get( id ),
								    setChange,
								    content;

								if ( editor ) {
									editor.on( 'change', function ( e ) {
										editor.save();
										content = editor.getContent();
										clearTimeout( setChange );
										setChange = setTimeout( function () {
											input.val( content ).trigger( 'change' );
										}, 500 );
									} );
								}

								tArea.css( {
									visibility : 'visible'
								} ).on( 'keyup', function () {
									content = tArea.val();
									clearTimeout( setChange );
									setChange = setTimeout( function () {
										input.val( content ).trigger( 'change' );
									}, 500 );
								} );
							} );
						} );
					}
				};
				wp.customizerCtrlEditor.init();
			} )( jQuery );
		</script>
		<style type="text/css">
			.wp-full-overlay {
				z-index: unset !important;
			}
		</style>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>">
		</label>
		<?php
		$settings = array(
			'textarea_name' => $this->id,
			'teeny'         => true,
		);
		$new_id   = str_replace( array( '[', ']' ), '', $this->id );
		wp_editor( htmlspecialchars_decode( $this->value() ), $new_id, $settings );

		if ( $i == 1 ) {
			do_action( 'admin_print_footer_scripts' );
		}
		$i ++;
		?>
		<?php
	}

}
