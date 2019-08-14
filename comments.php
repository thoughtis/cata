<?php 
/**
 * Comments
 * 
 * @package Cata
 * @since   0.1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div class="area--comments comments" id="comments">
	<h2 class="comments__title"><?php esc_html_e( 'Comments', 'cata' ); ?></h2>
	<?php if ( have_comments() ) : ?>
		<ol>
		<?php
			wp_list_comments(
				array(
					'style' => 'ol',
					'type'  => 'comment',
				)
			);
		?>
		</ol>
		<?php the_comments_navigation(); ?>
	<?php endif; ?>
	<?php comment_form(); ?>
</div>
