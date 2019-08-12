<?php 
/**
 * Sidebar
 * 
 * @package Cata
 */

namespace Cata;

if ( ! class_exists( 'Cata\Sidebar' ) ) :
	/**
	 * Sidebar
	 */
	class Sidebar {

		/**
		 * Construct
		 */
		public function __construct() {
			add_action( 'widgets_init', array( __CLASS__, 'register_sidebar' ) );
		}

		/**
		 * Register Sidebar
		 */
		public static function register_sidebar() : void {

			$sidebar_options = array(
				'name'          => esc_html__( 'Sidebar', 'cata' ),
				'id'            => 'cata-sidebar',
				'description'   => esc_html__( 'Add widgets here.', 'cata' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget__title">',
				'after_title'   => '</h3>',
			);

			register_sidebar( $sidebar_options );

		}

	}

endif;
