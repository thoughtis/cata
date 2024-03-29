<?php 
/**
 * Footer
 * The <footer> element, not the closing of <body> or <html>.
 * 
 * @package Cata
 * @see     template-parts/document/document-close.php
 * @since   0.1.0
 */

?>
<footer class="footer" id="footer" role="contentinfo">
	<p>
	<?php if ( function_exists( 'vip_powered_wpcom' ) ) : ?>
		<?php echo wp_kses_post( vip_powered_wpcom() ); ?>
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
