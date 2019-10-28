<?php
/**
 * 404
 * 
 * @package Cata
 * @since 0.1.10
 */

get_header();
?>
<div class="site__content" id="content">
	<section class="site__primary area--content" id="primary">
		<main class="site__main" id="main">
			<?php get_template_part( 'template-parts/content/content', 'not-found' ); ?>
		</main>
	</section>
</div>
<?php
get_footer();
