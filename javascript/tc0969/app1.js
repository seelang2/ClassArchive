// JavaScript Document

PageData = new function() {
	this.menuDiv = null;
	this.mainContentDiv = null;
	this.statusDiv = null;
};

function init() {
	PageData.menuDiv = document.getElementById("menu");
	PageData.mainContentDiv = document.getElementById("maincontent");
	PageData.statusDiv = document.getElementById("status");

//	alert(PageData.statusDiv.style.visibility);

	// hijack menus
	hijackLinks(PageData.menuDiv);
}

function displayContent(response) {
	PageData.statusDiv.style.visibility = 'hidden';
//	PageData.statusDiv.style.display = 'none';
	PageData.mainContentDiv.innerHTML = response;
	
	// hijack content links
	hijackLinks(PageData.mainContentDiv);
	
}

function hijackLinks(element) {
	links = element.getElementsByTagName("A");
	//alert('Found ' + links.length + ' links.');
	for(c = 0; c < links.length; c++) {
		links[c].onclick = function(e) {

			// get node that triggered event
			target = getNode(e);
/*
			var target;
			if (!e) var e = window.event;
			if (e.target) target = e.target;
			else if (e.srcElement) target = e.srcElement;
			if (target.nodeType == 3) // defeat Safari bug
				target = target.parentNode;
*/			

			// get time to pass on query string to work around IE aggressive caching
			// IE's caching prevents setting the style.visibility back hidden on return
			// working around the caching using this method solves this issue
			x = new Date();
			x = x.getTime();

			//alert('href:' + target.href);
			ajaxSendReq('GET', target.href + '?x=' + x, displayContent, null, 'TEXT', true);
			PageData.statusDiv.style.visibility = 'visible';
//			PageData.statusDiv.style.display = 'block';
			
			return false;
		};
		
	}
}

function getNode(e) {
	// get node that triggered event
	var target;
	if (!e) var e = window.event;
	if (e.target) target = e.target;
	else if (e.srcElement) target = e.srcElement;
	if (target.nodeType == 3) // defeat Safari bug
		target = target.parentNode;
	return target;
}

function cleanup() {
	PageData.menuDiv = null;
	PageData.cainContentDiv = null;
	PageData.statusDiv = null;
}

window.onload = init;
window.onunload = cleanup;
/* EOF */