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

<div class="has-global-padding is-layout-constrained">
	<div id="comments" class="comments-area alignwide">
		<header class="comments__header">
			<h2 class="comments__title"><?php esc_html_e( 'Comments', 'cata' ); ?></h2>
		</header>
		<div class="comments__content">
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
			<?php 
			comment_form(
				array (
					'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . ' <span class="required">*</span></label><br /><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required></textarea></p>',
				)
			); 
			?>
		</div>
	</div>
</div>
