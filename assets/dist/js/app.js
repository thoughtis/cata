(function () {
	'use strict';

	const PROPERTY_NAME="--color-text-decoration-rgb";function main(){changeTextDecorationColor(),0<document.querySelectorAll(".wp-block-cata-toc").length&&document.addEventListener("tocBlocksRendered",changeTextDecorationColor);}function changeTextDecorationColor(){[...document.querySelectorAll(".has-link-color a")].forEach(handleLink);}function handleLink(a){const{color:b}=getComputedStyle(a);b.startsWith("rgb(")?a.style.setProperty(PROPERTY_NAME,b.slice(4,-1)):a.style.removeProperty(PROPERTY_NAME);}

	main();

}());
