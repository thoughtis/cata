<?php 
/**
 * Enqueue Assets
 * 
 * @package Cata
 * @since   0.1.0
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
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_styles_blocking' ) );
			add_action( 'wp_body_open', array( __CLASS__, 'enqueue_styles_nonblocking' ) );
		}

		/**
		 * Enqueue Blocking Styles
		 * Output them in the head.
		 */
		public static function enqueue_styles_blocking() : void {
			wp_enqueue_style( 'cata-blocking', get_template_directory_uri() . '/assets/dist/css/blocking.css', array(), wp_get_theme()->get( 'Version' ), 'screen' );
		}

		/**
		 * Enqueue Non-Blocking Styles
		 * Output them at the end of the body.
		 */
		public static function enqueue_styles_nonblocking() : void {
			wp_enqueue_style( 'cata-nonblocking', get_template_directory_uri() . '/assets/dist/css/nonblocking.css', array(), wp_get_theme()->get( 'Version' ), 'screen' );
		}

	}
endif;
