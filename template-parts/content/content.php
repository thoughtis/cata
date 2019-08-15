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
<article <?php post_class( 'entry' ); ?>>
	<header class="entry__header">
		<h1 class="entry__title"><?php the_title(); ?></h1>
	</header>
	<?php if ( has_post_thumbnail() ) : ?>
	<figure class="entry__image">
		<?php the_post_thumbnail(); ?>
		<?php if ( '' !== get_the_post_thumbnail_caption() ) : ?>
		<figcaption>
			<?php the_post_thumbnail_caption(); ?>
		</figcaption>
		<?php endif; ?>
	</figure>
	<?php endif; ?>
	<div class="entry__content">
		<?php the_content(); ?>
	</div>
	<?php
	wp_link_pages(
		array(
			'before' => '<nav class="navigation navigation--entry">' . esc_html__( 'Pages:', 'cata' ),
			'after'  => '</nav>',
		)
	);
	?>
	<footer class="entry__footer"></footer>
</article>
