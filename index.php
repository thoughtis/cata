<?php 
/**
 * Index
 * 
 * @package Cata
 * @since   0.1.0
 */

get_header();
get_template_part( 'woocommerce/global/wrapper', 'start' );
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		if ( is_singular() ) :
			get_template_part( 'template-parts/content/content', get_post_type() );
		else :
			get_template_part( 'template-parts/preview/preview', get_post_type() );
		endif;
	endwhile;
	the_posts_navigation();
else :
	get_template_part( 'template-parts/content/content', 'none' );
endif;
get_template_part( 'woocommerce/global/wrapper', 'end' );
get_footer();
