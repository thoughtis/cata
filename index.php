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
		</main>
	</section>
	<?php get_sidebar(); ?>
</div>
<?php
get_search_form(
	array(
		'aria_label' => 'Full Site',
	)
);
?>
<?php
get_footer();
