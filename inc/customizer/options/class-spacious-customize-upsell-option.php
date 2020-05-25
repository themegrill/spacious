<?php
/**
 * Archive/ blog layout.
 *
 * @package     spacious
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================== POST/PAGE/BLOG > ARCHIVE/ BLOG ==========================================*/
if ( ! class_exists( 'Spacious_Customize_Upsell_Option' ) ) :

	/**
	 * Archive/Blog option.
	 */
	class Spacious_Customize_Upsell_Option extends Spacious_Customize_Base_Option {

		/**
		 * Arguments for options.
		 *
		 * @return array
		 */
		public function elements() {

			return array(

				'spacious_upsell'        => array(
					'setting' => array(),
					'control' => array(
						'type'     => 'upsell',
						'priority' => 10,
						'section'  => 'spacious_customize_upsell_section',
					),
				)


			);

		}

	}

	new Spacious_Customize_Upsell_Option();

endif;
