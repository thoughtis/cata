<?php 
/**
 * Autoload
 * 
 * @package Cata
 */

/**
 * Autoload
 * 
 * @param string $class - the class we're attempting to load.
 */
function cata_autoload( string $class ) : void {

	// Folder relative to theme, we'll add theme folder at the end.
	$base = '/includes';

	// Parts of the class name include namespaces.
	// Example Cata\Languages.
	$parts = explode( '\\', $class );

	// Parts must be an array with some values.
	if ( ! is_array( $parts ) || empty( $parts ) ) {
		return;
	}
	// Namespace must be Clearing_Farm.
	if ( 'Cata' !== current( $parts ) ) {
		return;
	}

	// Remove the namespace.
	$parts = array_slice( $parts, 1 );

	// All parts lowercase.
	$parts = array_map( 'strtolower', $parts );

	// Separate with hyphens.
	$parts = array_map(
		function( $part ) {
			return str_replace( '_', '-', $part );
		},
		$parts
	);

	// Languages changes to /languages/.
	$path = array_reduce(
		$parts,
		function( $carry, $part ) {
			return $carry . $part . '/';
		},
		'/'
	);

	// File is last item in $parts.
	$file = array_pop( $parts );

	// File name.
	$file_name = 'class-' . $file . '.php';

	// Files we're going to try to load.
	// We might want more files, like template-tags.
	$files = array_merge(
		array( $file_name ),
		cata_get_autoload_complementary_files()
	);

	// Full file path.
	$file_path = $base . $path;

	// Attempt to load class and complementary files.
	array_walk( $files, 'cata_autoload_file', $file_path );

}
spl_autoload_register( 'cata_autoload' );

/**
 * Autoload File
 *
 * @param string $file_name - file we're looking for.
 * @param int    $key - unused, but part of array_walk.
 * @param string $relative_path - where to look for the file.
 */
function cata_autoload_file( string $file_name, int $key, string $relative_path ) : void {

	$file_path = $relative_path . $file_name;

	// If file exists, load it.
	if ( file_exists( get_template_directory() . $file_path ) ) {
		require_once get_template_directory() . $file_path;
	}

}

if ( ! function_exists( 'cata_get_autoload_complementary_files' ) ) :
	/**
	 * Get Autoload Complementary Files
	 * We want to autoload our class-* files, but we might need functions in the global scope.
	 * Use this function to add file names you typically want to accompany your class.
	 * They will be autoloaded if they exist the class folder.
	 * 
	 * @return array - complementary files with filters applied.
	 */
	function cata_get_autoload_complementary_files() : array {

		return array(
			'template-functions.php',
			'template-tags.php',
		);

	}
endif;
