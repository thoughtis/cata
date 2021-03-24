<?php
/**
 * Core Button
 *
 * @package Cata\Blocks
 */

namespace Cata\Blocks;

/**
 * Core Button
 */
class Core_Button {
	/**
	 * Construct
	 */
	public function __construct() {
		add_filter( 'register_block_type_args', array( __CLASS__, 'set_default_border_radius' ), 10, 2 );
	}

	/**
	 * Set Default Border Radius
	 * 
	 * @param array $args
	 * @param string $name
	 */
	public static function set_default_border_radius( array $args, string $name ) : array {
		if ( 'core/button' !== $name ) {
			return $args;
		}

		if ( ! isset( $args['attributes'] ) ) {
			return $args;
		}

		if ( ! isset( $args['attributes']['borderRadius'] ) ) {
			return $args;
		}

		$args['attributes']['borderRadius']['default'] = 3;

		return $args;
	}
}
