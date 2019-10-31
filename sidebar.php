<?php
/**
 * Sidebar
 * Sidebar is unfortunately named, it need not be located on the side of anything.
 * 
 * @package Cata
 * @since   0.1.0
 */

?>
<section class="secondary" id="secondary" role="complementary">
	<?php
	if ( is_active_sidebar( 'cata-sidebar' ) ) {
		dynamic_sidebar( 'cata-sidebar' );
	}
	?>
</section>
