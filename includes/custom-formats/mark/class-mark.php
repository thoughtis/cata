<?php
/**
 * <mark> Custom Format for Block Editor
 * 
 * @link https://developer.wordpress.org/block-editor/tutorials/format-api/
 * @package Cata\Custom_Formats
 * @since 0.1.5
 */

namespace Cata\Custom_Formats;

/**
 * Mark
 */
class Mark {

	/**
	 * Construct
	 */
	public function __construct() {
		add_action( 'init', array( __CLASS__, 'register_format' ) );
		add_action( 'enqueue_block_editor_assets', array( __CLASS__, 'enqueue_assets' ) );
	}

	/**
	 * Register Format
	 */
	public static function register_format() : void {
		wp_register_script(
			'cata-block-editor-format-mark',
			get_template_directory_uri() . '/assets/dist/js/block-editor-format-mark.js',
			array( 'wp-rich-text', 'wp-element', 'wp-editor', 'wp-compose', 'wp-data' ),
			wp_get_theme( 'cata' )->get( 'Version' ),
			true
		);
	}

	/**
	 * Enqueue Assets
	 */
	public static function enqueue_assets() : void {
		wp_enqueue_script( 'cata-block-editor-format-mark' );
	}

}