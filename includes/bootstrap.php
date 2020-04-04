<?php 
/**
 * Bootstrap
 * 
 * @package Cata
 */

namespace Cata;

new Enqueue_Assets();
new Images\Image_Sizes(
	new Images\Content_Width()
);
new Languages();
new Nav_Menus();
new Sidebar();
