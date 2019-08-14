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
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_lazy_load_css' ) );
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'localize_lazy_load_css' ) );
		}

		/**
		 * Enqueue Theme Styles
		 */
		public static function enqueue_theme_styles() : void {
			wp_enqueue_style( 'cata-style-critical', get_template_directory_uri() . '/assets/dist/css/critical.css', array(), wp_get_theme()->get( 'Version' ), 'screen' );
		}

		/**
		 * Enqueue Lazy Load CSS
		 */
		public static function enqueue_lazy_load_css() : void {
			wp_enqueue_script( 'cata-lazy-load-css', get_template_directory_uri() . '/assets/dist/js/lazy-load-css.js', array(), wp_get_theme()->get( 'Version' ), 'true' );
		}

		/**
		 * Localize Lazy Load CSS
		 */
		public static function localize_lazy_load_css() : void {

			$presentational_css_with_version_number = add_query_arg(
				array(
					'v' => wp_get_theme()->get( 'Version' ), 
				),
				get_template_directory_uri() . '/assets/dist/css/presentational.css'
			);

			$default_lazy_css_files = array(
				array(
					'href'  => $presentational_css_with_version_number,
					'media' => 'screen',
				),
			);

			$lazy_css_files = apply_filters( 'cata_lazy_load_css_files', $default_lazy_css_files );

			wp_localize_script( 'cata-lazy-load-css', 'cataLazyCSSFiles', $lazy_css_files );

		}

	}
endif;
