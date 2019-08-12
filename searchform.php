<?php 
/**
 * Search Form
 * $args are available globally from get_search_form()
 * 
 * @package Cata
 */

?>
<form aria-label="<?php echo esc_attr( $args['aria_label'] ); ?>" role="search" method="get" action="<?php echo esc_url( home_url() ); ?>">
	<label>
		<span><?php esc_html_e( 'Search For:', 'cata' ); ?></span>
		<input name="s" type="search">
	</label>
	<input type="submit" value="<?php esc_html_e( 'Search', 'cata' ); ?>">
</form>
