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
		add_filter( 'register_block_type_args', array( __CLASS__, 'do_not_support_experimental_border_radius' ), 10, 2 );
	}

	/**
	 * Do Not Support Experimental Border Radius
	 * The Field Notes for WP 5.9 says you can disable settings.border.radius through theme.json,
	 * but I have not been able to make it work that way.
	 *
	 * @link https://make.wordpress.org/core/2022/01/08/updates-for-settings-styles-and-theme-json/
	 * @param array $args
	 * @param string $name
	 */
	public static function do_not_support_experimental_border_radius( array $args, string $name ) : array {		
		if ( 'core/button' !== $name ) {
			return $args;
		}

		if ( ! isset( $args['supports'] ) ) {
			return $args;
		}

		if ( ! isset( $args['supports']['__experimentalBorder'] ) ) {
			return $args;
		}

		if ( ! isset( $args['supports']['__experimentalBorder']['radius'] ) ) {
			return $args;
		}

		$args['supports']['__experimentalBorder']['radius'] = false;

		return $args;
	}
}
