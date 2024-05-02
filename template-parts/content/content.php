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

<article <?php post_class( 'wp-site-blocks wp-block-post-content' ); ?>>
  <div class="has-global-padding is-layout-constrained">
	<h1 class="wp-block-heading"><?php the_title(); ?></h1>
	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="wp-block-image">
			<?php the_post_thumbnail(); ?>
			<?php if ( '' !== get_the_post_thumbnail_caption() ) : ?>
				<figcaption class="wp-element-caption">
					<?php the_post_thumbnail_caption(); ?>
				</figcaption>
			<?php endif; ?>
		</figure>
	<?php endif; ?>
    <?php the_content(); ?>
	<?php
	wp_link_pages(
		array(
			'before' => '<nav class="navigation navigation--entry">' . esc_html__( 'Pages:', 'cata' ),
			'after'  => '</nav>',
		)
	);
	?>
  </div>
</article>
