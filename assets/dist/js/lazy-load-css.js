(function () {
	'use strict';

	var files=window.cataLazyCSSFiles,head=document.querySelector("head");Array===files.constructor&&files.forEach(appendFileToHead.bind(null,head));function appendFileToHead(a,b){var c=document.createElement("link");c.setAttribute("href",b.href),c.setAttribute("media",b.media),c.setAttribute("rel","stylesheet"),c.setAttribute("type","text/css"),a.append(c);}

}());
