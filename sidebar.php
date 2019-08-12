<?php
/**
 * Sidebar
 * Sidebar is unfortunately named, it need not be located on the side of anything.
 * 
 * @package Cata
 */

?>
<section class="site__secondary area--widget" id="secondary">
	<?php
	if ( is_active_sidebar( 'cata-sidebar' ) ) {
		dynamic_sidebar( 'cata-sidebar' );
	}
	?>
</section>
