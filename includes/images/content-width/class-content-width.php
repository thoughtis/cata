<?php
/**
 * Content Width
 * 
 * @package Cata\Images
 */

namespace Cata\Images;

/**
 * Content Width
 */
class Content_Width {

	/**
	 * Smallest Unit
	 * 
	 * @var int $smallest_unit
	 */
	public $smallest_unit = 128;

	/**
	 * Content Width
	 * 
	 * @var int $content_width
	 */
	public $content_width = 768;

	/**
	 * Construct
	 */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'set_global_content_width' ) );
	}

	/**
	 * Set Global Content Width
	 * 
	 * @global int $content_width - used in scaling images.
	 */
	public function set_global_content_width() : void {
		global $content_width;
		$content_width = $this->content_width;
	}

	/**
	 * Get Multiplier Function
	 * 
	 * @param int $multiplier - factor of the theme's width unit we want.
	 * @return callable - function we can call to get the result of this multiplication.
	 */
	public function get_multiplier_function( int $multiplier ) {
		return function() use ( $multiplier ) {
			return $this->smallest_unit * $multiplier;
		};
	}

}
