<?php 
/**
 * Page
 * 
 * @package Cata
 * @since   0.1.0
 */

get_header();
get_template_part( 'template-parts/primary/primary', 'start' );
while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/content/content', get_post_type() );
	wp_link_pages();
	if ( comments_open() ) :
		comments_template();
	endif;
endwhile;
get_template_part( 'template-parts/primary/primary', 'end' );
get_footer();
