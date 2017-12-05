// JavaScript Document

PageData = new function() {
	this.menuDiv = null;
	this.mainContentDiv = null;
	this.statusDiv = null;
	this.hoverDiv = null;
	this.hoverContent = null;
};

function init() {
	PageData.menuDiv = document.getElementById("menu");
	PageData.mainContentDiv = document.getElementById("maincontent");
	PageData.statusDiv = document.getElementById("status");
	
	// build hover div
	PageData.hoverDiv = document.createElement("DIV");
	document.getElementById("header").appendChild(PageData.hoverDiv);
	PageData.hoverDiv.id = 'hoverdiv';
	tempElem = document.createElement("H2");
	PageData.hoverDiv.appendChild(tempElem);
	tempElem.appendChild(document.createTextNode('Product Details'));
	PageData.hoverContent = document.createElement("DIV");
	PageData.hoverDiv.appendChild(PageData.hoverContent);
	PageData.hoverContent.id = 'hovercontent';
	
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

function displayCatalog(response) {
	PageData.statusDiv.style.visibility = 'hidden';
	PageData.mainContentDiv.innerHTML = '';
	
	productList = XMLParse.xml2ObjArray(response, 'product');
	
	productCount = productList.length;
	for(c = 0; c < productCount; c++) {
		tempDiv = document.createElement("DIV");
		PageData.mainContentDiv.appendChild(tempDiv);
		tempDiv.id = 'user_' + productList[c].id;
		tempDiv.className = 'employee';
		
		tempElem = document.createElement("IMG");
		tempDiv.appendChild(tempElem);
		tempElem.src = '/img/' + productList[c].url;
		tempElem.width = '84';
		tempElem.height = '105';
		
		tempDiv.appendChild(document.createElement("BR"));
		
		tempElem = document.createElement("P");
		tempDiv.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode(productList[c].name));
		tempElem.appendChild(document.createElement("BR"));
		tempElem.appendChild(document.createTextNode(productList[c].category));
		
		tempDiv.ondblclick = function(e) {
			// get node that triggered event
			target = getNode(e);
			
			// Bubble up the node's parents to the div
			while (target.nodeName != "DIV") {
				target = target.parentNode;
			}
			
			employeeID = target.id.substr(5);
			
			//alert('Employee ID: ' + employeeID);

			x = new Date();
			x = x.getTime();

			ajaxSendReq('GET', 'backend.php?mode=getresults&prodid=' + employeeID + '&x=' + x, displayHover, errHandler, null, 'XML', true);
			PageData.statusDiv.style.visibility = 'visible';
			
		};
	}
}

function displayHover(response) {
	PageData.statusDiv.style.visibility = 'hidden';
	PageData.hoverContent.innerHTML = '';
	
	productDetail = XMLParse.xml2ObjArray(response, 'product');
	
	tempElem = document.createElement("IMG");
	PageData.hoverContent.appendChild(tempElem);
	tempElem.src = '/img/' + productDetail[0].url;
	tempElem.width = '200';
	tempElem.height = '200';

	PageData.hoverContent.appendChild(document.createElement("BR"));
	
	tempElem = document.createElement("P");
	PageData.hoverContent.appendChild(tempElem);
	tempElem.appendChild(document.createTextNode(productDetail[0].name));
	tempElem.appendChild(document.createElement("BR"));
	tempElem.appendChild(document.createTextNode(productDetail[0].category));
	tempElem.appendChild(document.createElement("BR"));
	tempElem.appendChild(document.createTextNode(productDetail[0].price));
	tempElem.appendChild(document.createElement("BR"));
	tempElem.appendChild(document.createTextNode(productDetail[0].qty));
	tempElem.appendChild(document.createElement("BR"));
	tempElem.appendChild(document.createTextNode(productDetail[0].description));
	tempElem.appendChild(document.createElement("BR"));

	tempA = document.createElement("A");
	tempElem.appendChild(tempA);
	tempA.href = '#';
	tempA.onclick = function() {
		PageData.hoverDiv.style.display = 'none';
		return false;
	};
	tempA.appendChild(document.createTextNode('Click to close'));
	PageData.hoverDiv.style.display = 'block';
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

			// create default values for XHR request
			handlerfunc = displayContent;
			resptype = 'TEXT';
			preX = '?x=';
			
			domain = 'http://localhost/';

			//alert(target.href.substr(target.href.length - 5));
			if (target.href.substr(target.href.length - 5) == '.html') {
				// this is a static page - send text request
				handlerfunc = displayContent;
				resptype = 'TEXT';
				preX = '?x=';
			}
			
			if (target.href.substr(domain.length, 11) == 'backend.php') {
				// this is a dynamic data - send xml request
				handlerfunc = displayCatalog;
				resptype = 'XML';
				preX = '&x=';
			}
			
			//alert('XHR request params:' + "\n" + 'filename: ' + target.href.substr(domain.length, 11) + "\n" + 'resptype: ' + resptype + "\n" + 'preX: ' + preX);
			
			// get time to pass on query string to work around IE aggressive caching
			// IE's caching prevents setting the style.visibility back hidden on return
			// working around the caching using this method solves this issue
			x = new Date();
			x = x.getTime();

			//alert('href:' + target.href);
			ajaxSendReq('GET', target.href + preX + x, handlerfunc, errHandler, null, resptype, true);
			PageData.statusDiv.style.visibility = 'visible';
//			PageData.statusDiv.style.display = 'block';
			
			return false;
		};
		
	}
}

function errHandler(errorcode) {
	// turn off status div
	PageData.statusDiv.style.visibility = 'hidden';
	
	alert('Error: The server return an error code of ' + errorcode);
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
	PageData.hoverDiv = null;
	PageData.hoverContent = null;
}

window.onload = init;
window.onunload = cleanup;
/* EOF */