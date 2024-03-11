<?php
/**
 * 404
 * 
 * @package Cata
 * @since 0.1.10
 */

get_header();
get_template_part( 'template-parts/primary/primary', 'open' );
get_template_part( 'template-parts/content/content', 'not-found' );
get_template_part( 'template-parts/primary/primary', 'close' );
get_footer();
