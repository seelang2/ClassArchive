// create global data object
var Data = new Object();

var App = new function() {
	this.init = function() {
		Data.contentDiv = document.getElementById("content");
		Data.pagenavDiv = document.getElementById("pagenav");
		Data.ajax = new Ajax();
		
		Data.ajax.doGet('article1.html', App.processArticle, 'text');
	}; // init
	
	this.processArticle = function(response) {
		//Data.contentDiv.innerHTML = response;
		Data.article = response; // save article original form in case
		// separate article into pages
		Data.pages = response.split('<h2>');
		// replace lost <h2> tags from the splie
		for(var c = 1; c < Data.pages.length; c++) { // start loop at second element
			Data.pages[c] = '<h2>' + Data.pages[c];
			//alert(Data.pages[c]);
		}
		
		App.displayPage(1); // display first page of article
	}; // processArticle
	
	this.displayPage = function(page) {
		Data.contentDiv.innerHTML = Data.pages[page - 1];
		// add page enavigation
		Data.pagenavDiv.innerHTML = ''; // clear div first
		if (page > 1) {
			// build prev page link
			aElem = document.createElement("A");
			aElem.href = '#';
			aElem.title = 'Go to page ' + (page - 1);
			aElem.appendChild(document.createTextNode('<< Previous Page'));
			Data.pagenavDiv.appendChild(aElem);
			aElem.onclick = function() {
				App.displayPage(page - 1);
				return false;
			};
		}
		
		if (page > 1 && page < Data.pages.length) {
			Data.pagenavDiv.appendChild(document.createTextNode(' | '));
		}
		
		if (page < Data.pages.length) {
			// build next page link
			aElem = document.createElement("A");
			aElem.href = '#';
			aElem.title = 'Go to page ' + (page + 1);
			aElem.appendChild(document.createTextNode('Next Page >>'));
			Data.pagenavDiv.appendChild(aElem);
			aElem.onclick = function() {
				App.displayPage(page + 1);
				return false;
			};
		}
		
	}; // displayPage
	
}; // App

window.onload = App.init;