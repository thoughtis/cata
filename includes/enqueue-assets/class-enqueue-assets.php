<?php 
/**
 * Enqueue Assets
 * 
 * @package Cata
 */

namespace Cata;

if ( ! class_exists( 'Cata\Enqueue_Assets' ) ) :
	/**
	 * Enqueue
	 */
	class Enqueue_Assets {

		/**
		 * Construct
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_theme_styles' ) );
		}

		/**
		 * Enqueue Theme Styles
		 */
		public static function enqueue_theme_styles() : void {
			wp_enqueue_style( 'cata-style-critical', get_template_directory_uri() . '/assets/dist/css/critical.css', array(), wp_get_theme()->get( 'Version' ) );
		}

	}
endif;
