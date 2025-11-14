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
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_styles_reset_blocking' ), 5 );
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_styles_blocking' ) );
			add_action( 'wp_body_open', array( __CLASS__, 'enqueue_styles_nonblocking' ) );
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ) );
			add_filter( 'script_loader_tag', array( __CLASS__, 'use_module_type' ), 10, 3 );
			add_action( 'after_setup_theme', array( __CLASS__, 'add_editor_styles' ) );
		}

		/** 
		 * Enqueue Blocking Reset/Normalize Styles
		 */
		public static function enqueue_styles_reset_blocking() : void {
			wp_enqueue_style( 'cata-reset-blocking', get_template_directory_uri() . '/assets/dist/css/reset-blocking.css', array(), wp_get_theme( 'cata' )->get( 'Version' ), 'screen' );
		}

		/**
		 * Enqueue Blocking Styles
		 * Output them in the head.
		 */
		public static function enqueue_styles_blocking() : void {
			wp_enqueue_style( 'cata-blocking', get_template_directory_uri() . '/assets/dist/css/blocking.css', array( 'wp-block-library' ), wp_get_theme( 'cata' )->get( 'Version' ), 'screen' );
		}

		/**
		 * Enqueue Non-Blocking Styles
		 * Output them at the end of the body.
		 */
		public static function enqueue_styles_nonblocking() : void {
			wp_enqueue_style( 'cata-nonblocking', get_template_directory_uri() . '/assets/dist/css/nonblocking.css', array(), wp_get_theme( 'cata' )->get( 'Version' ), 'screen' );
		}

		/**
		 * Enqueue Scripts
		 */
		public static function enqueue_scripts() : void {
			wp_enqueue_script( 'cata-module-app', get_template_directory_uri() . '/assets/dist/js/app.js', array(), wp_get_theme( 'cata' )->get( 'Version' ), true );
		}

		/**
		 * Use Module Type
		 * 
		 * @param string $tag Provided script element.
		 * @param string $handle Identifier for the script.
		 * @param string $src URL of the script.
		 * @return string
		 */
		public static function use_module_type( string $tag, string $handle, string $src ) : string {
			if ( false === strpos( $handle, 'cata-module' ) ) {
				return $tag;
			}
			return "<script type=\"module\" src=\"{$src}\" async></script>\n";
		}

		/**
		 * Add Editor Styles
		 */
		public static function add_editor_styles(): void {
			add_theme_support( 'editor-styles' );
			add_editor_style( 'assets/dist/css/editor.css' );
		}
	}
endif;
