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
		add_action( 'after_setup_theme', array( $this, 'add_image_sizes' ) );
		add_filter( 'image_size_names_choose', array( $this, 'get_editor_image_sizes' ) );
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

	/**
	 * Add Image Sizes
	 * Custom image sizes as opposed to the pre-named sizes in `update_image_sizes`
	 */
	public function add_image_sizes() : void {
		/**
		 * 2x1 cropped sizes for social images
		 */
		$sm = $this->content_width->smallest_unit * 3;
		$md = $this->content_width->smallest_unit * 6;
		$lg = $this->content_width->smallest_unit * 12;

		add_image_size( 'cata_2x1_sm', $sm, ($sm / 2), true );	
		add_image_size( 'cata_2x1_md', $md, ($md / 2), true );
		add_image_size( 'cata_2x1_lg', $lg, ($lg / 2), true );

		/**
		 * 1x1 cropped sizes
		 */
		add_image_size( 'cata_square_xxs', 64, 64, true );
		add_image_size( 'cata_square_xs', 128, 128, true );
		add_image_size( 'cata_square_sm', 384, 384, true );
		add_image_size( 'cata_square_md', 768, 768, true );
		add_image_size( 'cata_square_lg', 1152, 1152, true );
	}

	/**
	 * Get Editor Image Sizes
	 * 
	 * @return array - sizes and their descriptions to show in the post editor.
	 */
	public function get_editor_image_sizes() : array {
		return array(
			'thumbnail'      => __( 'Small', 'cata' ),
			'medium_large'   => __( 'Default', 'cata' ),
			'post-thumbnail' => __( 'Wide', 'cata' ),
			'1536x1536'      => __( 'Full', 'cata' ),
			'full'           => __( 'Original', 'cata' ),
		);
	}

}
