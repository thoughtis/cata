/**
 * Lazy Load CSS
 */

const files = window.cataLazyCSSFiles;
const head = document.querySelector( 'head' );

if ( Array === files.constructor ) {
	files.forEach( appendFileToHead.bind( null, head ) );
}

/**
 * Append File To Head
 *
 * @param {HTMLHeadElement} _head
 * @param {string} fileURL
 */
function appendFileToHead( _head, fileObject ) {
	const link = document.createElement( 'link' );

	link.setAttribute( 'href', fileObject.href );
	link.setAttribute( 'media', fileObject.media );
	link.setAttribute( 'rel', 'stylesheet' );
	link.setAttribute( 'type', 'text/css' );

	_head.append( link );
}
