// JavaScript Document

var pageData = new function() {
	this.resultsDiv = null;
	this.calendarDiv = null;
	this.categoriesDiv = null;
	this.link1 = null;
	this.statusDiv = null;
	this.dimmerDiv = null;
	this.hoverDiv = null;
}

function init() {
	pageData.resultsDiv = document.getElementById("results");	
	pageData.calendarDiv = document.getElementById("calendar");	
	pageData.categoriesDiv = document.getElementById("categories");	
	pageData.statusDiv = document.getElementById("status");
	pageData.dimmerDiv = document.getElementById("dimmer");

	pageData.link1 = document.getElementById("link1");
	pageData.link1.onclick = function() {
//		getResults('getresults', displayResults, '', '', 'XML');
		getResults('getcats', displayCats, '', '', 'TEXT');
		return false;
	}

	pageData.hoverDiv = document.createElement("DIV");
	document.body.appendChild(pageData.hoverDiv);
	pageData.hoverDiv.className = "hover";
	
	temp1 = document.createElement("IMG");
	temp1.src = "#";
	temp1.width = 200;
	temp1.height = 200;
	pageData.hoverDiv.appendChild(temp1);


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

function getResults(mode, callback, catid, prodid, respType) {

	x = new Date();
	x = x.getTime();

	toggleStatus('block');

	ajaxSendReq("GET", "/backend.php?mode=" + mode + "&catid=" + catid  + "&prodid=" + prodid + "&x=" + x, callback, null, respType, false);
	

}

function displayResults (results) {

	toggleStatus('none');

	pageData.resultsDiv.innerHTML = '';
	
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
		
		tempDiv.onmouseover = function(e) { 

			// get event
			var targ;
			if (!e) var e = window.event;
			if (e.target) targ = e.target;
			else if (e.srcElement) targ = e.srcElement;
			if (targ.nodeType == 3) // defeat Safari bug
				targ = targ.parentNode;

//			alert('Event type: ' + e.type);

			var runTimedHover = function() { doHover(targ) };

			pageData.timer = setTimeout(runTimedHover, 1500);
		}

		tempDiv.onmouseout = function() { clearTimeout(pageData.timer); }


	}

	tempDiv = document.createElement("DIV");
	pageData.resultsDiv.appendChild(tempDiv);
	tempDiv.setAttribute("CLASS","clearing");


}

function displayCats(results) {
	
	toggleStatus('none');

	pageData.categoriesDiv.innerHTML = '<p>Filter by category: ' + results + '</p>';	
	selectCat = document.getElementById("catlist");
	
	selectCat.onchange = function() {
		getResults('getresults', displayResults, selectCat.options[selectCat.selectedIndex].value, '', 'XML');	
	}

	getResults('getresults', displayResults, '', '', 'XML');

}

function doHover(elem) {

	// elem returned will be a cell inside the row, so we want the parent row
	elem = elem.parentNode;
	
	alert(elem.id);
	
	ajaxSendReq("GET", 'http://localhost/seriesdata.php?x='+x+'&mode=data&series=all&model=all&item='+elem.id, showHover, null, 'XML');
	getResults('getresults', displayResults, '', elem.id, 'XML');

	// turn on user feedback
	toggleStatusbar(pageData.statusDiv, true);

}

function showHover(response) {

	// turn off user feedback
	toggleStatusbar(pageData.statusDiv, false);

	itemdata = XMLParse.xml2ObjArray(response, 'mitem');
	
//	hoverdiv = document.getElementById('hoverdata');
	hoverdiv = pageData.hoverDiv.firstChild;
	
	hoverdiv.innerHTML = '';
	
	hoverdiv.appendChild(document.createTextNode(itemdata[0].name));
	hoverdiv.appendChild(document.createElement('BR'));
	hoverdiv.appendChild(document.createTextNode(itemdata[0].size));
	hoverdiv.appendChild(document.createElement('BR'));
	hoverdiv.appendChild(document.createTextNode(itemdata[0].color));
	hoverdiv.appendChild(document.createElement('BR'));
	hoverdiv.appendChild(document.createTextNode(itemdata[0].type));
	hoverdiv.appendChild(document.createElement('BR'));
	hoverdiv.appendChild(document.createTextNode(itemdata[0].price));

	toggleStatusbar(pageData.hoverDiv, true);

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