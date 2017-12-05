// JavaScript Document

var pageData = new function() {
	this.resultsDiv = null;
	this.calendarDiv = null;
	this.categoriesDiv = null;
	this.link1 = null;
	this.statusDiv = null;
	this.dimmerDiv = null;
	this.hoverDiv = null;
	this.resultCount = 0;
	this.currentPage = 1;
	this.totalPages = 1;
	this.resultsPerPage = 6;	// change this value as desired. Should match backend page size
	this.currentCat = 'ALL';
};

function init() {
	pageData.resultsDiv = document.getElementById("results");	
	pageData.calendarDiv = document.getElementById("calendar");	
	pageData.categoriesDiv = document.getElementById("categories");	
	pageData.statusDiv = document.getElementById("status");
	pageData.dimmerDiv = document.getElementById("dimmer");

	pageData.link1 = document.getElementById("link1");
	pageData.link1.onclick = function() {
		getResults('getcats', displayCats, '', '', '', 'TEXT');
		return false;
	}

	getResults('count', setResultCount, '', '', '', 'TEXT');

}

function cleanup() {
	pageData.resultsDiv = null;
	pageData.calendarDiv = null;
	pageData.categoriesDiv = null;
	pageData.link1 = null;
	pageData.statusDiv = null;
	pageData.dimmerDiv = null;
	pageData.hoverDiv = null;
}

function setResultCount(results) {
	toggleStatus('none'); // turn off status div

	// set the result count and total pages
	pageData.resultCount = results;	
	pageData.totalPages = Math.ceil(pageData.resultCount / pageData.resultsPerPage);

	alert('Total count: ' + pageData.resultCount + '\n' + 'Total Pages: ' + pageData.totalPages);
}

function getResults(mode, callback, catid, prodid, page, respType) {

	// used to workaround aggressive IE caching
	x = new Date();
	x = x.getTime();

	toggleStatus('block'); // turn on status div

	ajaxSendReq("GET", "/backend6.php?mode=" + mode + "&catid=" + catid  + "&prodid=" + prodid + "&page=" + page + "&x=" + x, callback, null, respType, false);

}

function displayResults (results) {

	toggleStatus('none');

	pageData.resultsDiv.innerHTML = '';

	// create previous result page link
	if (pageData.currentPage > 1) {
		tempDiv = document.createElement("DIV");
		tempDiv.className = "prevresult";
		pageData.resultsDiv.appendChild(tempDiv);
		temp1 = document.createElement("A");
		tempDiv.appendChild(temp1);
		temp1.appendChild(document.createTextNode('Previous'));
		temp1.href = '#';
		temp1.onclick = prevResult;
	}

	// create next result page link
	if (pageData.currentPage < pageData.totalPages) {
		tempDiv = document.createElement("DIV");
		tempDiv.className = "nextresult";
		pageData.resultsDiv.appendChild(tempDiv);
		temp1 = document.createElement("A");
		tempDiv.appendChild(temp1);
		temp1.appendChild(document.createTextNode('Next'));
		temp1.href = '#';
		temp1.onclick = nextResult;
	}

	// Insert clearing div
	tempDiv = document.createElement("DIV");
	pageData.resultsDiv.appendChild(tempDiv);
	tempDiv.setAttribute("CLASS","clearing");

	// Just for kicks display result page information
	tempDiv = document.createElement("DIV");
	pageData.resultsDiv.appendChild(tempDiv);
	tempDiv.innerHTML = 'Result page ' + pageData.currentPage + ' of ' + pageData.totalPages;

	productList = XMLParse.xml2ObjArray(results, 'product');

	for (d=0; d < productList.length; d++) {

		tempDiv = document.createElement("DIV");
		pageData.resultsDiv.appendChild(tempDiv);

		// Note that setAttribute is buggy in IE so use javascript references instead of DOM
//		tempDiv.setAttribute("CLASS","productdiv");
//		tempDiv.setAttribute("ID","product" + d);
		tempDiv.className = "productdiv";
		tempDiv.id = "product" + d;
	
		temp1 = document.createElement("IMG");
//		temp1.setAttribute("src", "textimage.php?x=200&y=200&bgcolor=9999ff&size=30&text=" + productList[d].url);
//		temp1.setAttribute("width","75");
//		temp1.setAttribute("height","75");
		temp1.src = "img/" + productList[d].url;
		temp1.width = 75;
		temp1.height = 75;
		tempDiv.appendChild(temp1);

		temp1 = document.createElement("P");
		temp1.appendChild(document.createTextNode(productList[d].name));
		tempDiv.appendChild(temp1);

		temp1.appendChild(document.createElement("BR"));
		temp1.appendChild(document.createTextNode("$" + productList[d].price));

	}

	// Insert clearing div to clear floats
	tempDiv = document.createElement("DIV");
	pageData.resultsDiv.appendChild(tempDiv);
	tempDiv.setAttribute("CLASS","clearing");


}

function prevResult() {
	pageData.currentPage = pageData.currentPage - 1;
	if (pageData.currentPage < 1) pageData.currentPage = 1;
	
	getResults('getresults', displayResults, pageData.currentCat, '', pageData.currentPage, 'XML');

}

function nextResult() {
	pageData.currentPage = pageData.currentPage + 1;
	if (pageData.currentPage > pageData.totalPages) pageData.currentPage = pageData.totalPages;

	getResults('getresults', displayResults, pageData.currentCat, '', pageData.currentPage, 'XML');

}

function displayCats(results) {
	
	toggleStatus('none');

	pageData.categoriesDiv.innerHTML = '<p>Filter by category: ' + results + '</p>';	
	selectCat = document.getElementById("catlist");
	
	selectCat.onchange = function() {
		// Reset current page to 1
		pageData.currentPage = 1;
		getResults('getresults', displayResults, selectCat.options[selectCat.selectedIndex].value, '', pageData.currentPage, 'XML');
		pageData.currentCat = selectCat.options[selectCat.selectedIndex].value;

		getResults('count', setResultCount, pageData.currentCat, '', pageData.currentPage, 'XML');
	}

	getResults('getresults', displayResults, '', '', '', 'XML');

}





function getWinHeight() {
	if (document.all) {
		return document.body.clientHeight;
	} else {
		return window.innerHeight;
	}
}

function getWinWidth() {
	if (document.all) {
		return document.body.clientWidth;
	} else {
		return window.innerWidth;
	}
}

function toggleStatus(state) {

//	alert(state);
	
	pageData.statusDiv.style.top = (getWinHeight() / 2) - 26 + 'px';
	pageData.statusDiv.style.left = (getWinWidth() / 2) - 87 + 'px';
	
//	pageData.statusDiv.style.visibility = state;
	pageData.statusDiv.style.display = state;
}


window.onload = init;
window.onunload = cleanup;