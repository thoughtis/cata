(function () {
	'use strict';

	const PROPERTY_NAME="--color-text-decoration-rgb";function main(){changeTextDecorationColor(),document.addEventListener("tocBlocksRendered",changeTextDecorationColor);}function changeTextDecorationColor(){[...document.querySelectorAll(`.has-link-color a:not([style*=${PROPERTY_NAME}])`)].forEach(handleLink);}function handleLink(a){const{color:b}=getComputedStyle(a);b.startsWith("rgb(")?a.style.setProperty(PROPERTY_NAME,b.slice(4,-1)):a.style.removeProperty(PROPERTY_NAME);}

	main();

}());
