<?php 
/**
 * Content
 * content-*.php templates are used for singular posts.
 * 
 * @see /template-parts/preview-*.php for posts in archives. 
 * @package Cata
 */

?>
<article <?php post_class(); ?>>
	<header>
		<h1><?php the_title(); ?></h1>
	</header>
	<?php if ( has_post_thumbnail() ) : ?>
	<figure>
		<?php the_post_thumbnail(); ?>
		<?php if ( '' !== get_the_post_thumbnail_caption() ) : ?>
		<figcaption>
			<?php the_post_thumbnail_caption(); ?>
		</figcaption>
		<?php endif; ?>
	</figure>
	<?php endif; ?>
	<div>
		<?php the_content(); ?>
	</div>
	<footer></footer>
</article>
