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
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'dequeue_wp_block_styles' ) );
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_styles_blocking' ) );
			add_action( 'wp_body_open', array( __CLASS__, 'enqueue_styles_nonblocking' ) );
		}

		/**
		 * Dequeue WP Block Styles
		 * We'll use our own.
		 */
		public static function dequeue_wp_block_styles() {
			wp_dequeue_style( 'wp-block-library' );
			wp_deregister_style( 'wp-block-library' );

			wp_enqueue_style( 'cata-wp-block-library', get_template_directory_uri() . '/assets/dist/css/wp-block-library.css', array(), wp_get_theme( 'cata' )->get( 'Version' ), 'screen' );
		}

		/**
		 * Enqueue Blocking Styles
		 * Output them in the head.
		 */
		public static function enqueue_styles_blocking() : void {
			wp_enqueue_style( 'cata-blocking', get_template_directory_uri() . '/assets/dist/css/blocking.css', array(), wp_get_theme( 'cata' )->get( 'Version' ), 'screen' );
		}

		/**
		 * Enqueue Non-Blocking Styles
		 * Output them at the end of the body.
		 */
		public static function enqueue_styles_nonblocking() : void {
			wp_enqueue_style( 'cata-nonblocking', get_template_directory_uri() . '/assets/dist/css/nonblocking.css', array(), wp_get_theme( 'cata' )->get( 'Version' ), 'screen' );
		}

	}
endif;
