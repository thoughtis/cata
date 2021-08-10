<?php
/**
 * Core Group
 *
 * @package Cata\Blocks
 */

namespace Cata\Blocks;

/**
 * Core Group
 */
class Core_Group {
	/**
	 * Construct
	 */
	public function __construct() {
		add_filter( 'register_block_type_args', array( __CLASS__, 'do_not_support_experimental_layout' ), 10, 2 );
	}

	/**
	 * Do Not Support Experimental Layout
	 * Enable this feature if this issue is addressed.
	 *
	 * @link https://core.trac.wordpress.org/ticket/53748
	 * @param array $args
	 * @param string $name
	 */
	public static function do_not_support_experimental_layout( array $args, string $name ) : array {
		if ( 'core/group' !== $name ) {
			return $args;
		}

		if ( ! isset( $args['supports'] ) || ! isset( $args['supports']['__experimentalLayout'] ) ) {
			return $args;
		}

		$args['supports']['__experimentalLayout'] = false;

		return $args;
	}
}
