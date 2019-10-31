<?php 
/**
 * Nav Menus
 * 
 * @package Cata
 * @since   0.1.0
 */

namespace Cata;

if ( ! class_exists( 'Cata\Nav_Menus' ) ) :

	/**
	 * Nav Menus
	 */
	class Nav_Menus {

		/**
		 * Construct
		 */
		public function __construct() {
			add_action( 'after_setup_theme', array( __CLASS__, 'register_nav_menus' ) );
		}

		/**
		 * Register Nav Menus
		 */
		public static function register_nav_menus() : void {
			
			$nav_menu_options = array(
				'header-nav' => esc_html__( 'Primary Navigation', 'cata' ),
			);
			
			register_nav_menus( $nav_menu_options );

		}

	}
	
endif;
