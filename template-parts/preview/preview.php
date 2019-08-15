<?php 
/**
 * Preview
 * preview-*.php templates are used for posts within archives.
 * 
 * @package Cata
 * @see     /template-parts/content/content-*.php for singular posts. 
 * @since   0.1.0
 */

?>
<article <?php post_class( 'preview' ); ?>>
	<header class="preview__header">
		<h2 class="preview__title">
			<a class="preview__permalink" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
	</header>
	<?php if ( has_post_thumbnail() ) : ?>
	<figure class="preview__image">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail(); ?>
		</a>
		<?php if ( '' !== get_the_post_thumbnail_caption() ) : ?>
		<figcaption>
			<?php the_post_thumbnail_caption(); ?>
		</figcaption>
		<?php endif; ?>
	</figure>
	<?php endif; ?>
	<div class="preview__content">
		<?php the_excerpt(); ?>
	</div>
	<footer class="preview__footer"></footer>
</article>
