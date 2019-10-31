<?php 
/**
 * Header
 * The <header> element, not the opening of <html> or <body>.
 * 
 * @package Cata
 * @see     template-parts/document/document-open.php
 * @since   0.1.0
 */

get_template_part( 'template-parts/document/document', 'open' );
get_template_part( 'template-parts/skip-link' );
?>
<header class="header" id="header" role="banner">
	<hgroup>
		<h1 class="header__title">
			<a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a>
		</h1>
		<?php if ( get_bloginfo( 'description' ) ) : ?>
		<span class="header__description"><?php bloginfo( 'description', 'display' ); ?></span>
		<?php endif; ?>
	</hgroup>
	<nav class="header__navigation" id="headerNav">
	<?php

	/*
	Output:
	<nav class="header__navigation" id="headerNav" role="navigation">
		<div class="menu--header">
			<ul class="menu" id="headerNavMenu">
				<li class="menu-item"><a>Link</a></li>
			</ul>
		</div>
	</nav>
	*/

	wp_nav_menu(
		array(
			'theme_location'  => 'header-nav',
			'menu_id'         => 'headerNavMenu',
			'container_class' => 'menu--header',
		)
	);
	?>
	</nav>
</header>
