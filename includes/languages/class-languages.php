<?php
/**
 * Languages
 *
 * @package Cata
 */

namespace Cata;

if ( ! class_exists( 'Cata\Languages' ) ) :

	/**
	 * Languages
	 */
	class Languages {

		/**
		 * Construct
		 */
		public function __construct() {
			add_action( 'after_setup_theme', array( __CLASS__, 'load_theme_textdomain' ) );
		}

		/**
		 * Load Theme Text Domain
		 */
		public static function load_theme_textdomain() : void {
			load_theme_textdomain( 'cata', get_template_directory() . '/languages' );
		}

	}

endif;
