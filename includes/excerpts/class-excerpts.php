<?php
/**
 * Excerpts
 * 
 * @package Cata
 * @since 0.7.15
 */

namespace Cata;

/**
 * Excerpts
 */
class Excerpts {
	/**
	 * Construct
	 */
	public function __construct() {
		add_filter( 'excerpt_length', array( __CLASS__, 'excerpt_length' ), 10, 1 );
		add_filter( 'excerpt_more', array( __CLASS__, 'excerpt_more' ) );
	}

	/**
	 * Excerpt Length
	 * 
	 * @param int $length - number of words in excerpts.
	 * @return int - number of words we'd like in excerpts.
	 */
	public static function excerpt_length( int $length ) : int {
		return 21;
	}

	/**
	 * Excerpt More
	 * 
	 * @return string - character(s) to use when truncating an excerpt to indicate it goes on.
	 */
	public static function excerpt_more() : string {
		return '&hellip;';
	}
}