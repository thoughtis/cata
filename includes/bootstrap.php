<?php 
/**
 * Bootstrap
 * 
 * @package Cata
 */

namespace Cata;

new Blocks\Styles\Streaming();
new Custom_Formats\Mark();
new Enqueue_Assets();
new Images\Block_Image_Sizes\Setter(
	new Images\Block_Image_Sizes\Getter()	
);
new Images\Image_Sizes(
	new Images\Content_Width()
);
new Languages();
new Nav_Menus();
new Sidebar();
new Excerpts();
new Admin();
new Block_Editor();
