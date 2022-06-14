<?php
/**
 * Lazy Images
 * 
 * @package Cata\Images;
 */

namespace Cata\Images;

use Automattic\Jetpack\Jetpack_Lazy_Images;

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
	 *
	 * Using an action on `the_post` causes setup_filters to run multiple times per page,
	 * which breaks out placeholders. Using `wp_body_open` ensures it happens only once.
	 */
	public static function update_lazy_image_actions() : void {
		$lazy_images = Jetpack_Lazy_Images::instance();
		remove_action( 'the_post', array( $lazy_images, 'setup_filters' ), 9999 );
		add_action( 'wp_body_open', array( $lazy_images, 'setup_filters' ) );
	}

}
