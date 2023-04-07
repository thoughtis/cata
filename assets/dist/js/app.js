(function () {
	'use strict';

	const PROPERTY_NAME="--color-text-decoration-rgb";function main(){[...document.querySelectorAll(".has-link-color a")].forEach(handleLink);}function handleLink(a){const{color:b}=getComputedStyle(a);b.startsWith("rgb(")?a.style.setProperty(PROPERTY_NAME,b.slice(4,-1)):a.style.removeProperty(PROPERTY_NAME);}

	main();

}());
