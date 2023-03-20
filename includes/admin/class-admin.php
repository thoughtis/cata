<?php
/**
 * Admin
 * 
 * @package Cata
 * @since 0.8.2
 */

namespace Cata;

/**
 * Admin
 */

class Admin {
	/**
	 * Construct
	 */
	public function __construct() {
		add_action( 'admin_menu', array( __CLASS__, 'add_custom_menu_pages' ) );
	}
	
	/**
	 * Add Menu Pages
	 */
	public static function add_custom_menu_pages() {
		add_menu_page(
			'Reusable blocks', 
			'Reusable blocks', 
			'edit_posts', 
			'edit.php?post_type=wp_block', 
			'', 
			'dashicons-block-default', 
			30 
		);
	}
}
