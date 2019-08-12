<?php 
/**
 * Header
 * 
 * @see template-parts/document-open.php
 * @package Cata
 */

get_template_part( 'template-parts/document', 'open' );
?>
<header class="site-header" id="header" role="banner">
	<hgroup>
		<h1><?php bloginfo( 'name' ); ?></h1>
		<?php if ( get_bloginfo( 'description' ) ) : ?>
		<span><?php bloginfo( 'description', 'display' ); ?></span>
		<?php endif; ?>
	</hgroup>
</header>
