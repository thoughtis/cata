<?php 
/**
 * Header
 * The <header> element, not the opening of <html> or <body>.
 * 
 * @see template-parts/document/document-open.php
 * @package Cata
 */

get_template_part( 'template-parts/document/document', 'open' );
get_template_part( 'template-parts/skip-link' );
?>
<header class="site__header" id="header" role="banner">
	<hgroup>
		<h1>
		<a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<?php if ( get_bloginfo( 'description' ) ) : ?>
		<span><?php bloginfo( 'description', 'display' ); ?></span>
		<?php endif; ?>
	</hgroup>
	<nav class="site__navigation" id="siteNav">
	<?php

	/*
	Output:
	<nav class="site__navigation" id="siteNav" role="navigation">
		<div class="menu--site">
			<ul class="menu" id="siteNavMenu">
				<li class="menu-item"><a>Link</a></li>
			</ul>
		</div>
	</nav>
	*/

	wp_nav_menu(
		array(
			'theme_location'  => 'site-nav',
			'menu_id'         => 'siteNavMenu',
			'container_class' => 'menu--site',
		)
	);
	?>
	</nav>
</header>
