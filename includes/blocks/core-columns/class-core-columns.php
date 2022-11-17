<?php
/**
 * Core Columns
 *
 * @package Cata\Blocks
 */

namespace Cata\Blocks;

/**
 * Core Columns
 */
class Core_Columns {

	const CLASS_PATTERN = '/(class="wp-block-columns[^"]*)/';

	/**
	 * Construct
	 */
	public function __construct() {
		add_filter( 'render_block', array( __CLASS__, 'add_unit_class' ), 10, 2 );
		add_filter( 'register_block_type_args', array( __CLASS__, 'do_not_support_experimental_layout' ), 10, 2 );
	}

	/**
	 * Add Unit Class
	 *
	 * @param string $content
	 * @param array $block
	 */
	public static function add_unit_class( string $content, array $block ) : string {

		if ( 'core/columns' !== $block['blockName'] ) {
			return $content;
		}

		$units_all_relative = self::all_units_are_relative( $block );

		if ( null === $units_all_relative ) {
			return $content;
		}

		$class = $units_all_relative ? 'has-relative-units' : 'has-static-units';

		$new = preg_replace( self::CLASS_PATTERN, '${1} ' . $class, $content, 1 );

		return $new;
	}

	/**
	 * All Units Are Relative
	 * 
	 * @param array $block
	 * @return null|bool
	 */
	private static function all_units_are_relative( array $block ) : ?bool {

		// cannot be known.
		if ( ! isset( $block['innerBlocks'] ) || ! is_array( $block['innerBlocks'] ) ) {
			return null;
		}

		return array_reduce(
			$block['innerBlocks'],
			function( bool $previous, array $current ) : bool {
				// already found an answer.
				if ( true !== $previous ) {
					return $previous;
				}
				// no attributes.
				if ( ! isset( $current['attrs'] ) ) {
					return null;
				}
				// no width.
				if ( ! isset( $current['attrs']['width'] ) ) {
					return $previous;
				}
				// width is empty.
				if ( empty( $current['attrs']['width'] ) ) {
					return $previous;
				}
				// whether percentage symbol is last character in width.
				return '%' === substr( $current['attrs']['width'], -1 );
			},
			true
		);

	}

	/**
	 * Do Not Support Experimental Layout
	 *
	 * @param array $args
	 * @param string $name
	 * @return array $args
	 */
	public static function do_not_support_experimental_layout( array $args, string $name ) : array {
		if ( 'core/columns' !== $name ) {
			return $args;
		}
		if ( ! isset( $args['supports'] ) || ! isset( $args['supports']['__experimentalLayout'] ) ) {
			return $args;
		}
		return array_merge(
			$args,
			array(
				'supports' => array_merge(
					$args['supports'],
					array(
						'__experimentalLayout' => false
					)
				)
			)
		);
	}
}

