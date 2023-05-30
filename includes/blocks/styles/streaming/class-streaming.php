<?php
/**
 * Block Styles > Streaming Button
 * 
 * @package Cata\Blocks\Styles
 */

namespace Cata\Blocks\Styles;

/**
 * Streaming
 */
class Streaming {
	/**
	 * Construct
	 */
	public function __construct() {
		add_action( 'init', array( __CLASS__, 'register_block_styles' ) );
	}

	/**
	 * Register Block Styles
	 */
	public static function register_block_styles() : void {
		register_block_style(
			'core/button',
			array(
				'name'         => 'streaming',
				'label'        => __( 'Streaming', 'cata' ),
				'is_default'   => false,
				'inline_style' => self::get_inline_style(),
			)
		);
	}

	/**
	 * Get Inline Style
	 * 
	 * @return string
	 */
	public static function get_inline_style() : string {
		$style = <<<'EOD'
.wp-block-button.is-style-streaming .wp-block-button__link{
	border-style: solid;
	border-width: 0.125em;
	display: flex;
	align-items: center;
}
.wp-block-button.is-style-streaming .wp-block-button__link:not(.has-background) {
	border-color: currentColor;
	background-color: transparent;
}
.wp-block-button.is-style-streaming .wp-block-button__link.has-background {
	border-color: transparent;
}
.wp-block-button.is-style-streaming .wp-block-button__link:not(.has-text-color):not(.has-background) {
	color: var(--color-accent, inherit);
}
.wp-block-button.is-style-streaming .wp-block-button__link::after {
	content: "";
	inline-size: 1em;
	block-size: 1em;
	display: inline-block;
	vertical-align: top;
	margin-inline-start: 0.5em;
	background-color: currentColor;
	mask-image: url(data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2016%2016%22%3E%3Cpath%20d%3D%22M8%2C16C3.59%2C16%2C0%2C12.41%2C0%2C8S3.59%2C0%2C8%2C0s8%2C3.59%2C8%2C8-3.59%2C8-8%2C8Zm0-15C4.14%2C1%2C1%2C4.14%2C1%2C8s3.14%2C7%2C7%2C7%2C7-3.14%2C7-7S11.86%2C1%2C8%2C1Zm3.12%2C7L6.88%2C3.76V12.24s4.24-4.24%2C4.24-4.24Z%22%20fill%3D%22black%22%2F%3E%3C%2Fsvg%3E);
	-webkit-mask-image: url(data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2016%2016%22%3E%3Cpath%20d%3D%22M8%2C16C3.59%2C16%2C0%2C12.41%2C0%2C8S3.59%2C0%2C8%2C0s8%2C3.59%2C8%2C8-3.59%2C8-8%2C8Zm0-15C4.14%2C1%2C1%2C4.14%2C1%2C8s3.14%2C7%2C7%2C7%2C7-3.14%2C7-7S11.86%2C1%2C8%2C1Zm3.12%2C7L6.88%2C3.76V12.24s4.24-4.24%2C4.24-4.24Z%22%20fill%3D%22black%22%2F%3E%3C%2Fsvg%3E);
	mask-size: cover;
}
EOD;

		return preg_replace( '/[\\s]+/', ' ', $style );
	}

}