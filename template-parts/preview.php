<?php 
/**
 * Preview
 * preview-*.php templates are used for posts within archives.
 * 
 * @see /template-parts/content-*.php for singular posts. 
 * @package Cata
 */

?>
<article <?php post_class(); ?>>
	<header>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	</header>
	<?php if ( has_post_thumbnail() ) : ?>
	<figure>
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
	<div>
		<?php the_excerpt(); ?>
	</div>
	<footer></footer>
</article>
