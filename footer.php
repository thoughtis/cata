<?php 
/**
 * Footer
 * The <footer> element, not the closing of <body> or <html>.
 * 
 * @see template-parts/document/document-close.php
 * @package Cata
 */

?>
<?php
get_search_form(
	array(
		'aria_label' => esc_html__( 'Full Site', 'cata' ),
	)
);
?>
<footer class="site__footer" id="footer" role="contentinfo">
	<p>
	<?php if ( function_exists( 'vip_powered_wpcom' ) ) : ?>
		<?php vip_powered_wpcom(); ?>
	<?php else : ?>
		<a href="<?php echo esc_url( __( 'https://wordpress.org', 'cata' ) ); ?>">
			<?php
			/* translators: %s: CMS name, i.e. WordPress. */
			printf( esc_html__( 'Proudly powered by %s', 'cata' ), 'WordPress' );
			?>
		</a>
	<?php endif; ?>
	</p>
</footer>
<?php
get_template_part( 'template-parts/document/document', 'close' );
