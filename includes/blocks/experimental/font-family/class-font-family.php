<?php
/**
 * Font Families
 *
 * @package Cata\Blocks\Experimental
 */

namespace Cata\Blocks\Experimental;

/**
 * Font Family
 */
class Font_Family {
	/**
	 * Construct
	 */
	public function __construct() {
		if ( ! self::theme_has_font_families() ) {
			return;
		}
		add_filter( 'register_block_type_args', array( __CLASS__, 'support_experimental_font_family' ), 10, 2 );
	}

	/**
	 * Support Experimental Font Families
	 *
	 * @param array $args
	 * @param string $name
	 */
	public static function support_experimental_font_family( array $args, string $name ) : array {
		if ( ! isset( $args['supports'] ) ) {
			return $args;
		}

		if ( ! isset( $args['supports']['typography'] ) ) {
			return $args;
		}

		$args['supports']['typography']['__experimentalFontFamily'] = true;

		return $args;
	}

	/**
	 * Theme Has Font Families
	 * 
	 * @return bool
	 */
	private static function theme_has_font_families() : bool {

		$settings = wp_get_global_settings();

		if ( ! is_array( $settings ) || empty( $settings ) ) {
			return false;
		}

		if ( ! isset( $settings['typography'] ) ) {
			return false;
		}

		if ( ! isset( $settings['typography']['fontFamilies'] ) ) {
			return false;
		}

		if ( ! isset( $settings['typography']['fontFamilies']['theme'] ) ) {
			return false;
		}

		if ( ! is_array( $settings['typography']['fontFamilies']['theme'] ) ) {
			return false;
		}

		return ! empty( $settings['typography']['fontFamilies']['theme'] );
	}

}
