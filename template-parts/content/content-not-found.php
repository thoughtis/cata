<?php 
/**
 * Content Not Found
 * content-*.php templates are used for singular posts.
 * 
 * @package Cata
 * @see     /template-parts/preview/preview-*.php for posts in archives. 
 * @since   0.1.0
 */

?>

<article <?php post_class( 'wp-site-blocks wp-block-post-content' ); ?>>
  <div class="has-global-padding is-layout-constrained">
  	<header>
		<h1><?php esc_html_e( 'Not Found', 'cata' ); ?></h1>
	</header>
	<?php get_search_form(); ?>
  </div>
</article>
