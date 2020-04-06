<?php
/**
 * Block Image Size Getter
 * 
 * @package Cata\Images\Block_Image_Sizes
 * @since 0.3.0
 */

namespace Cata\Images\Block_Image_Sizes;

/**
 * Getter
 */
class Getter {

	/**
	 * Default
	 * 
	 * @var string $default
	 */
	public $default = '(max-width:768px) 92.5vw, 768px';

	/**
	 * Construct
	 * 
	 * @param string $default - override default sizes values.
	 */
	public function __construct( string $default = '' ) {

		if ( '' !== $default ) {
			$this->default = $default;
		}

		add_filter( 'cata_get_block_image_sizes_core/image', array( $this, 'core_image' ), 10, 3 );
		add_filter( 'cata_get_block_image_sizes_core/media-text', array( $this, 'core_media_text' ), 10, 3 );

	}

	/**
	 * Get Block Image Sizes
	 * 
	 * @param  string $image - an img tag.
	 * @param  array  $block - array representation of block.
	 * @return string $sizes - what to put in the img sizes attribute.
	 */
	public function get_block_image_sizes( string $image, array $block ) : string {

		return apply_filters( "cata_get_block_image_sizes_{$block['blockName']}", $this->default, $image, $block );

	}

	/**
	 * Get Block Names
	 * 
	 * @return array - name of blocks that should have image sizes applied to them.
	 */
	public function get_block_names() {

		$default_block_names = array(
			'core/image',
			'core/media-text',
		); 

		return apply_filters( 'cata_get_block_names', $default_block_names ); 

	}

	/**
	 * WP Block - Core Image
	 * 
	 * @param  string $sizes - default sizes attribute value.
	 * @param  string $image - img tag as string.
	 * @param  array  $block - array representation of block.
	 * @return string $sizes - updated sizes attribute value.
	 */
	public function core_image( string $sizes, string $image, array $block ) : string {

		if ( ! isset( $block['attrs']['align'] ) ) {
			return $this->default;
		}

		if ( 'wide' === $block['attrs']['align'] ) {
			$sizes = '(max-width:1280px) 92.5vw, 1280px';
		} elseif ( 'full' === $block['attrs']['align'] ) {
			$sizes = '(max-width:1536px) 100vw, 1536px';
		}

		return $sizes;

	}

	/**
	 * WP Block - Core Media-Text
	 * We cannot ascertain the value of the align property for any setting
	 * other than full. Assumed to be at least alignwide.
	 * 
	 * @link https://github.com/WordPress/gutenberg/issues/15476 
	 * @param  string $sizes - default sizes attribute value.
	 * @param  string $image - img tag as string.
	 * @param  array  $block - array representation of block.
	 * @return string $sizes - updated sizes attribute value.
	 */
	public function core_media_text( string $sizes, string $image, array $block ) {
		
		$sizes = '50vw';

		if ( isset( $block['innerHTML'] ) && false !== strpos( $block['innerHTML'], 'is-stacked-on-mobile' ) ) {
			$sizes = $this->default;
		}

		return $sizes;

	}

}
