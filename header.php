<?php 
/**
 * Header
 * The <header> element, not the opening of <html> or <body>.
 * 
 * @see template-parts/document-open.php
 * @package Cata
 */

get_template_part( 'template-parts/document', 'open' );
?>
<header class="site__header" id="header" role="banner">
	<hgroup>
		<h1><?php bloginfo( 'name' ); ?></h1>
		<?php if ( get_bloginfo( 'description' ) ) : ?>
		<span><?php bloginfo( 'description', 'display' ); ?></span>
		<?php endif; ?>
	</hgroup>
	<nav
		aria-label="<?php echo esc_html__( 'Primary Navigation', 'cata' ); ?>"
		class="site__navigation"
		id="siteNav"
		role="navigation"
	>
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
