<?php 
/**
 * Functions
 * 
 * @package Cata
 * @since   0.1.0
 */

if ( ! function_exists( 'cata_after_setup_theme' ) ) :
	/**
	 * After Setup Theme
	 */
	function cata_after_setup_theme() {

		add_theme_support( 'align-wide' );
		add_theme_support( 'automatic-feed-links' );

		$html5_options = array(
			'caption',
			'comment-form',
			'comment-list',
			'gallery',
			'search-form',
			// storefront has this, but why?
			'widgets',
		);

		/**
		 * Theme Supports Editor Styles
		 * 
		 * @todo add other aspects of block editor support.
		 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/
		 */
		add_theme_support( 'editor-styles' );

		add_theme_support( 'html5', $html5_options );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'title-tag' );

		/**
		 * Theme Supports Woocommerce
		 * 
		 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
		 */
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		add_theme_support( 'disable-custom-gradients' );
		add_theme_support( 'editor-gradient-presets', array() );

		add_theme_support( 'disable-custom-font-sizes' );
		add_theme_support( 'disable-custom-colors' );
		add_theme_support( 
			'editor-color-palette', 
			array(
				array(
					'name'  => 'White',
					'slug'  => 'white',
					'color' => '#FFFFFF',
				),
				array(
					'name'  => 'Gray Lightest',
					'slug'  => 'gray-lightest',
					'color' => '#fcfcfc',
				),
				array(
					'name'  => 'Gray Lighter',
					'slug'  => 'gray-lighter',
					'color' => '#f8f8f8',
				),
				array(
					'name'  => 'Gray Light',
					'slug'  => 'gray-light',
					'color' => '#dadada',
				),
				array(
					'name'  => 'Gray Dark',
					'slug'  => 'gray-dark',
					'color' => '#848484',
				),
				array(
					'name'  => 'Gray Darker',
					'slug'  => 'gray-darker',
					'color' => '#2b2b2b',
				),
				array(
					'name'  => 'Gray Darkest',
					'slug'  => 'gray-darkest',
					'color' => '#0a0a0a',
				),
				array(
					'name'  => 'Black',
					'slug'  => 'black',
					'color' => '#000000',
				),
			) 
		);

		add_theme_support( 
			'editor-font-sizes', 
			array(
				array(
					'name' => __( 'Small', 'cata' ),
					'size' => 14,
					'slug' => 'small',
				),
				array(
					'name' => __( 'Regular', 'cata' ),
					'size' => 16,
					'slug' => 'regular',
				),
				array(
					'name' => __( 'Medium (H5)', 'cata' ),
					'size' => 18,
					'slug' => 'medium',
				),
				array(
					'name' => __( 'Large (H3)', 'cata' ),
					'size' => 22,
					'slug' => 'large',
				),
				array(
					'name' => __( 'Huge (H1)', 'cata' ),
					'size' => 32,
					'slug' => 'huge',
				),
			) 
		);

	}
endif;
add_action( 'after_setup_theme', 'cata_after_setup_theme' );

/**
 * Autoload
 * Register our autoloader.
 */
require_once get_template_directory() . '/includes/autoload.php';

/**
 * Bootstrap
 * Initialize classes we need to load.
 */
require_once get_template_directory() . '/includes/bootstrap.php';
