<?php 
/**
 * Bootstrap
 * 
 * @package Cata
 */

namespace Cata;

new Blocks\Core_Columns();
new Blocks\Experimental\Border();
new Blocks\Experimental\Font_Family();
new Custom_Formats\Mark();
new Enqueue_Assets();
new Images\Block_Image_Sizes\Setter(
	new Images\Block_Image_Sizes\Getter()	
);
new Images\Image_Sizes(
	new Images\Content_Width()
);
if ( class_exists( 'Automattic\Jetpack\Jetpack_Lazy_Images' ) ) {
	new Images\Lazy_Images();
	new Images\Placeholders();
}
new Languages();
new Nav_Menus();
new Sidebar();
