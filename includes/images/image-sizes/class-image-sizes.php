<?php
/**
 * Image Sizes
 * 
 * @package Cata\Images
 * @since 0.3.0
 */

namespace Cata\Images;

/**
 * Image Sizes
 */
class Image_Sizes {

	/**
	 * Content Width
	 * 
	 * @var Content_Width $content_width
	 */
	private $content_width;

	/**
	 * Construct
	 * 
	 * @param Content_Width $content_width - instance of Content_Width.
	 */
	public function __construct( Content_Width $content_width ) {
		$this->content_width = $content_width;
		add_action( 'after_setup_theme', array( $this, 'update_image_sizes' ) );
	}

	/**
	 * Update Image Sizes
	 */
	public function update_image_sizes() : void {
		
		$__return_384  = $this->content_width->get_multiplier_function( 3 );
		$__return_640  = $this->content_width->get_multiplier_function( 5 );
		$__return_768  = $this->content_width->get_multiplier_function( 6 );
		$__return_1024 = $this->content_width->get_multiplier_function( 8 );
		$__return_1280 = $this->content_width->get_multiplier_function( 10 );

		// Thumbnail.
		add_filter( 'pre_option_thumbnail_size_w', $__return_384 );
		add_filter( 'pre_option_thumbnail_size_h', '__return_zero' );
		add_filter( 'pre_option_thumbnail_crop', '__return_false' );
		
		// Medium.
		add_filter( 'pre_option_medium_size_w', $__return_640 );
		add_filter( 'pre_option_medium_size_h', '__return_zero' );
		
		// Medium Large.
		add_filter( 'pre_option_medium_large_size_w', $__return_768 );
		add_filter( 'pre_option_medium_large_size_h', '__return_zero' );

		// Large.
		add_filter( 'pre_option_large_size_w', $__return_1024 );
		add_filter( 'pre_option_large_size_h', '__return_zero' );

		// Post Thumbnail.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( $__return_1280() );

	}

}
