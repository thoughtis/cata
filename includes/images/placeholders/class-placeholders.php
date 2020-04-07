<?php
/**
 * Placeholders
 * 
 * @package Cata\Images
 */

namespace Cata\Images;

use Jetpack_Lazy_Images;
use WP_Post;

/**
 * Placeholders
 */
class Placeholders {
	/**
	 * Construct
	 */
	public function __construct() {

		if ( is_admin() || wp_doing_ajax() ) {
			return;
		}

		if ( is_feed() || is_preview() ) {
			return;
		}

		if ( ! apply_filters( 'lazyload_is_enabled', true ) ) {
			return;
		}

		// Priority 20 since Jetpack Settings changes setup_filters to priority 10.
		add_action( 'wp_body_open', array( __CLASS__, 'change_jetpack_attribute_priority' ), 20 );

		// Image being rendered using wp_get_attachment_image.
		// Woocommerce blocks, post thumbnails, etc...
		add_filter( 'wp_get_attachment_image_attributes', array( __CLASS__, 'apply_placeholder_attachment' ), PHP_INT_MAX, 3 );
		
		// Images in HTML with width and height attributes.
		// Classic editor often includes width and height.
		add_filter( 'jetpack_lazy_images_new_attributes', array( __CLASS__, 'apply_placeholder_classic_editor' ), 10, 1 );

		// Images in HTML without width and height attributes.
		// Block editor often omits width and height.
		// If you manually set it, the image is caught be the previous filter.
		add_filter( 'jetpack_lazy_images_new_attributes', array( __CLASS__, 'apply_placeholder_block_editor' ), 20, 1 );

		// Check data-id and class attributes for an attachment id.
		add_filter( 'cata_get_attachment_id_from_attributes', array( __CLASS__, 'get_attachment_id_from_data_attribute' ), 10, 2 );
		add_filter( 'cata_get_attachment_id_from_attributes', array( __CLASS__, 'get_attachment_id_from_class' ), 20, 2 );

	}

	/**
	 * Apply Placeholder Using Attachment
	 * 
	 * @param  array   $attributes - attributes for an img element.
	 * @param  WP_Post $attachment - attachment we're displaying.
	 * @param  mixed   $size - size at which we're displaying that attachment.
	 * @return array $attributes - possibly updated attributes.
	 */
	public static function apply_placeholder_attachment( array $attributes, WP_Post $attachment, $size ) : array {

		$image = wp_get_attachment_image_src( $attachment->ID, $size );

		if ( ! $image ) {
			return $attributes;
		}

		// don't placeholder if there's nothing to replace it.
		if ( ! isset( $attributes['data-lazy-src'] ) ) {
			return $attributes;
		}

		$attributes['srcset'] = self::get_svg_placeholder( absint( $image[1] ), absint( $image[2] ), '#e5e5e7' );
		
		return $attributes;

	}

	/**
	 * Apply Placeholder Block Editor
	 * Find the ID of the attachment we're displaying.
	 * Get its width and height from the attachment meta.
	 * 
	 * @param array $attributes - attributes for an img element.
	 * @return array $attributes - possibly updated.
	 */
	public static function apply_placeholder_block_editor( array $attributes ) : array {
		if ( isset( $attributes['width'] ) && isset( $attributes['height'] ) ) {
			return $attributes;
		}

		$attachment_id = apply_filters( 'cata_get_attachment_id_from_attributes', 0, $attributes );

		if ( 0 === $attachment_id ) {
			return $attributes;
		}

		$meta = wp_get_attachment_metadata( $attachment_id );
		
		if ( ! is_array( $meta ) ) {
			return $attributes;
		}

		if ( ! isset( $meta['height'] ) || ! isset( $meta['width'] ) ) {
			return $attributes;
		}

		$attributes['srcset'] = self::get_svg_placeholder( absint( $meta['width'] ), absint( $meta['height'] ), '#e5e5e7' );

		return $attributes;
	}

	/**
	 * Get Attachment ID from Data Attribute
	 * 
	 * @param int   $attachment_id - best id we've been able to find for the attachment we're displaying.
	 * @param array $attributes - attributes for an img element.
	 * @return int $attachment_id - possibly updated value.
	 */
	public static function get_attachment_id_from_data_attribute( int $attachment_id, array $attributes ) : int {
		if ( isset( $attributes['data-id'] ) ) {
			$attachment_id = absint( $attributes['data-id'] );
		}
		return $attachment_id;
	}

	/**
	 * Get Attachment ID from Class
	 * 
	 * @param int   $attachment_id - best id we've been able to find for the attachment we're displaying.
	 * @param array $attributes - attributes for an img element.
	 * @return int $attachment_id - possibly updated value.
	 */
	public static function get_attachment_id_from_class( int $attachment_id, array $attributes ) : int {
		if ( 0 !== $attachment_id ) {
			return $attachment_id;
		}

		$classes = explode( ' ', $attributes['class'] );

		$classes = array_values(
			array_filter(
				$classes,
				function( $class ) {
					return 1 === preg_match( '/^(wp-image-)/', $class );
				}
			)
		);

		if ( empty( $classes ) ) {
			return $attachment_id;
		}

		$class = current( $classes );

		$class_parts = explode( '-', $class );

		return absint( end( $class_parts ) );
	}

	/**
	 * Apply Placeholder Classic Editor
	 * 
	 * @param array $attributes - attributes for an img element.
	 * @return array $attributes - possibly updated.
	 */
	public static function apply_placeholder_classic_editor( array $attributes ) : array {
		if ( ! isset( $attributes['width'] ) || ! isset( $attributes['height'] ) ) {
			return $attributes;
		}
	
		$attributes['srcset'] = self::get_svg_placeholder( absint( $attributes['width'] ), absint( $attributes['height'] ), '#e5e5e7' );

		return $attributes;
	}

	/**
	 * Get SVG Placeholder
	 * 
	 * @param int    $width - width of the image we're placeholding.
	 * @param int    $height - height of the image we're placeholding.
	 * @param string $hex_color - a color to use in this SVG.
	 * @return string - data encoded SVG in correct aspect ratio.
	 */
	public static function get_svg_placeholder( int $width, int $height, string $hex_color ) : string {
		$str = '<svg width="%1$d" height="%2$d" version="1.1" xmlns="http://www.w3.org/2000/svg"><rect width="%1$d" height="%2$d" fill="%3$s"></rect></svg>';
		$svg = rawurlencode( sprintf( $str, $width, $height, $hex_color ) );
		return "data:image/svg+xml;charset=UTF-8,${svg}";
	}

	/**
	 * Change Jetpack Attribute Priority
	 * Lower the priority of Jetpack's image attributes from PHP_INT_MAX,
	 * so we can filter afterward using the attachment data.
	 */
	public static function change_jetpack_attribute_priority() : void {

		remove_filter( 'wp_get_attachment_image_attributes', array( 'Jetpack_Lazy_Images', 'process_image_attributes' ), PHP_INT_MAX );

		add_filter( 'wp_get_attachment_image_attributes', array( 'Jetpack_Lazy_Images', 'process_image_attributes' ), ( PHP_INT_MAX - 1 ) );

	}

}
