<?php
/**
 * Lazy Images
 * 
 * @package Cata\Images;
 */

namespace Cata\Images;

use Jetpack_Lazy_Images;

/**
 * Lazy Images
 */
class Lazy_Images {
	/**
	 * Construct
	 */
	public function __construct() {
		add_action( 'wp_head', array( __CLASS__, 'update_lazy_image_actions' ) );
	}

	/**
	 * Update Lazy Image Actions
	 * Setup Lazy Images later to avoid it being removed by action on admin_bar_menu.
	 * 
	 * @link https://github.com/Automattic/jetpack/issues/15354
	 */
	public static function update_lazy_image_actions() : void {
		$lazy_images = Jetpack_Lazy_Images::instance();
		remove_action( 'wp_head', array( $lazy_images, 'setup_filters' ), 9999 );
		add_action( 'wp_body_open', array( $lazy_images, 'setup_filters' ) );
	}

}
