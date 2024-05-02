<?php 

namespace Cata;

/**
 * Enable Block Editor for Story Posts
 */
class Block_Editor {

	public function __construct() {
		add_filter( 'block_editor_settings_all', array( __CLASS__, 'use_constrained_layout_in_editor' ) );
	}

	/**
	 * Use Constrained Layout In Editor
	 * Tell the block editor that post content uses the constrained layout.
	 * Block themes do this dynamically, but we have to tell it our hybrid theme's layout.
	 *
	 * @see https://developer.wordpress.org/reference/functions/wp_get_post_content_block_attributes/
	 * @see https://core.trac.wordpress.org/browser/tags/6.4/src/wp-includes/block-editor.php#L648
	 * @param array $settings
	 * @return array
	 */
	public static function use_constrained_layout_in_editor( array $settings ): array {
		return array(
			...$settings,
			'postContentAttributes' => array(
				'layout' => array(
					'type' => 'constrained'
				)
			)
		);
	}
}
