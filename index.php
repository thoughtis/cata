<?php 
/**
 * Index
 * 
 * @package Cata
 */

get_header();
?>
<div class="site__content" id="content">
	<section class="site__primary area--content" id="primary">
		<main class="site__main" id="main">
		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {

				the_post();

				if ( is_singular() ) {
					get_template_part( 'template-parts/content', get_post_type() );
				} else { 
					get_template_part( 'template-parts/preview', get_post_type() );
				}
			}
		} else {
			get_template_part( 'template-parts/content', 'none' );
		}
		?>
		</main>
	</section>
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
