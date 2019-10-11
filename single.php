<?php 
/**
 * Single
 * 
 * @package Cata
 * @since   0.1.0
 */

get_header();
?>
<div class="site__content" id="content">
	<section class="site__primary area--content" id="primary">
		<main class="site__main" id="main">
		<?php
		while ( have_posts() ) :

			the_post();

			get_template_part( 'template-parts/content/content', get_post_type() );

			if ( comments_open() ) :
				comments_template();
			endif;

			the_post_navigation();

		endwhile;
		?>
		</main>
	</section>
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
