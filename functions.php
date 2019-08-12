<?php 
/**
 * Functions
 * 
 * @package Cata
 */

if ( ! function_exists( 'cata_after_setup_theme' ) ) :
	/**
	 * After Setup Theme
	 */
	function cata_after_setup_theme() {

		$html5_options = array(
			'caption',
			'comment-form',
			'comment-list',
			'gallery',
			'search-form',
		);

		add_theme_support( 'html5', $html5_options );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );

	}
endif;
add_action( 'after_setup_theme', 'cata_after_setup_theme' );

/**
 * Autoload
 * Register our autoloader.
 */
require_once get_template_directory() . '/includes/autoload.php';

/**
 * Bootstrap
 * Initialize classes we need to load.
 */
require_once get_template_directory() . '/includes/bootstrap.php';
