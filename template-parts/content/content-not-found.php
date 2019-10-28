<?php 
/**
 * Content
 * content-*.php templates are used for singular posts.
 * 
 * @package Cata
 * @see     /template-parts/preview/preview-*.php for posts in archives. 
 * @since   0.1.0
 */

?>
<article class="entry">
	<header class="entry__header">
		<h1 class="entry__title"><?php esc_html_e( 'Not Found', 'cata' ); ?></h1>
	</header>
	<div class="entry__content">
		<?php get_search_form(); ?>
	</div>
	<footer class="entry__footer"></footer>
</article>
