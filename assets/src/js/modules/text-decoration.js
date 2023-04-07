/**
 * Text Decoration
 * For any elements where we used the editor to apply a custom link color,
 * update the individual links 
 *  
 */

const PROPERTY_NAME = '--color-text-decoration-rgb';

/**
 * Main - function which changes the underline color for a link based on the text color
 *
 * @return {void}
 */
export default function main() {
	[...document.querySelectorAll('.has-link-color a')].forEach(handleLink);
}


/**
 * Handle Link
 *
 * @param {HTMLAnchorElement} link
 */
function handleLink( link ) {
	const { color } = getComputedStyle(link);
	if ( color.startsWith('rgb(') ) {
		link.style.setProperty( PROPERTY_NAME, color.slice(4, -1)); 
	} else {
		link.style.removeProperty( PROPERTY_NAME );
	}
}