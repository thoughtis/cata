<?php 
/**
 * Block Image Size Setter
 * 
 * @package Cata\Images\Block_Image_Sizes
 * @since 0.3.0
 */

namespace Cata\Images\Block_Image_Sizes;

/**
 * Setter
 */
class Setter {

	/**
	 * Getter
	 * 
	 * @var Getter $getter
	 */
	public $getter;

	/**
	 * Construct
	 * 
	 * @param Getter $getter - instance of Getter class.
	 */
	public function __construct( Getter $getter ) {

		$this->getter = $getter;

		add_filter( 'render_block', array( $this, 'set_image_sizes_in_block' ), 10, 2 );

	}

	/**
	 * Add Image Sizes to Block
	 * 
	 * @param  string $block_content - provided html content of block.
	 * @param  array  $block - array representation of block.
	 * @return string $block_content - updated html content of block.
	 */
	public function set_image_sizes_in_block( string $block_content, array $block ) : string {

		if ( ! preg_match_all( '/<img [^>]+>/', $block_content, $matches ) ) {
			return $block_content;
		}

		if ( ! $this->should_set_image_sizes_in_block( $block ) ) {
			return $block_content;
		}

		foreach ( $matches[0] as $image ) {

			$block_content = str_replace( $image, $this->set_image_sizes( $image, $block ), $block_content );
			
		}

		return $block_content;

	}

	/**
	 * Should Add Image Sizes to Block
	 * 
	 * @param  array $block - array representation of block.
	 * @return bool  $block_uses_image_sizes - whether or not this block utilizes responsive image sizes.
	 */
	public function should_set_image_sizes_in_block( array $block ) : bool {

		$block_names = $this->getter->get_block_names();
		
		$block_uses_image_sizes = in_array( $block['blockName'], $block_names, true );

		return apply_filters( 'cata_should_set_image_sizes_in_block', $block_uses_image_sizes );

	}

	/**
	 * Add Sizes to Image
	 * 
	 * @param  string $image - provided img tag.
	 * @param  array  $block - array representation of block.
	 * @return string $image - updated img tag.
	 */
	public function set_image_sizes( string $image, array $block ) : string {

		$sizes = $this->getter->get_block_image_sizes( $image, $block );

		if ( '' !== $sizes ) {

			$attr  = sprintf( ' sizes="%s"', esc_attr( $sizes ) );
			$image = preg_replace( '/<img ([^>]+?)[\/ ]*>/', '<img $1' . $attr . ' />', $image );

		}

		return apply_filters( 'cata_set_image_sizes', $image, $block );

	}

}
