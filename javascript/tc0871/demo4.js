// JavaScript Document demo2.js
pageData = new function() {
	this.currentTab = 1;
	this.statusDiv = null;
	this.seriesDiv = null;
	this.modelsDiv = null;
	this.itemsDiv = null;
};

function init() {
	menuItems = document.getElementsByTagName("A");
	pageData.statusDiv = document.getElementById("statusdiv");
	pageData.seriesDiv = document.getElementById("seriesdata");
	pageData.modelsDiv = document.getElementById("modeldata");
	pageData.itemsDiv = document.getElementById("itemdata");
	
	getSeriesData();
}

function getSeriesData() {
	ajaxSendReq("GET", '/seriesdata.php?mode=series', displaySeries, null, 'TEXT');
	pageData.statusDiv.style.visibility = 'visible';
}

function displaySeries(response) {
	pageData.statusDiv.style.visibility = 'hidden';
	pageData.seriesDiv.innerHTML = response;
	
	document.getElementById("menu1").onchange = function(e) {
		// get node that triggered event
		var targ;
		if (!e) var e = window.event;
		if (e.target) targ = e.target;
		else if (e.srcElement) targ = e.srcElement;
		if (targ.nodeType == 3) // defeat Safari bug
			targ = targ.parentNode;
		
		// alert('Selected series is '+targ.value);
		getModelsData(targ.value);
		
	};
}

function getModelsData(series) {
	ajaxSendReq("GET", '/seriesdata.php?mode=model&series='+series, displayModels, null, 'TEXT');
	pageData.statusDiv.style.visibility = 'visible';
}

function displayModels(response) {
	pageData.statusDiv.style.visibility = 'hidden';
	pageData.modelsDiv.innerHTML = response;
	
	document.getElementById("menu2").onchange = function(e) {
		// get node that triggered event
		var targ;
		if (!e) var e = window.event;
		if (e.target) targ = e.target;
		else if (e.srcElement) targ = e.srcElement;
		if (targ.nodeType == 3) // defeat Safari bug
			targ = targ.parentNode;
		
		// alert('Selected series is '+targ.value);
		getItemData(targ.value);
		
	};
}

function getItemData(model) {
	ajaxSendReq("GET", '/seriesdata.php?mode=data&model='+model, displayItems, null, 'XML');
	pageData.statusDiv.style.visibility = 'visible';
}

function displayItems(response) {
	pageData.statusDiv.style.visibility = 'hidden';
	
	pageData.itemsDiv.innerHTML = '';
	
	itemList = XMLParse.xml2ObjArray(response, "mitem");
	
	itemCount = itemList.length;

	tempElem = document.createElement("TABLE");
	pageData.itemsDiv.appendChild(tempElem);
	
	tbodyElem = document.createElement("TBODY");
	tempElem.appendChild(tbodyElem);
	
	rowElem = document.createElement("TR");
	tbodyElem.appendChild(rowElem);
	
	tempElem = document.createElement("TH");
	tempElem.appendChild(document.createTextNode('Name'));
	rowElem.appendChild(tempElem);
	
	tempElem = document.createElement("TH");
	tempElem.appendChild(document.createTextNode('Size'));
	rowElem.appendChild(tempElem);

	tempElem = document.createElement("TH");
	tempElem.appendChild(document.createTextNode('Color'));
	rowElem.appendChild(tempElem);

	tempElem = document.createElement("TH");
	tempElem.appendChild(document.createTextNode('Type'));
	rowElem.appendChild(tempElem);

	tempElem = document.createElement("TH");
	tempElem.appendChild(document.createTextNode('Price'));
	rowElem.appendChild(tempElem);

	for(c = 0; c < itemCount; c++) {

		rowElem = document.createElement("TR");
		tbodyElem.appendChild(rowElem);
		if (c % 2 == 0) {
			rowElem.className = 'evenrow';
		} else {
			rowElem.className = 'oddrow';
		}
		
		tempElem = document.createElement("TD");
		tempElem.appendChild(document.createTextNode(itemList[c].name));
		rowElem.appendChild(tempElem);
		
		tempElem = document.createElement("TD");
		tempElem.appendChild(document.createTextNode(itemList[c].size));
		rowElem.appendChild(tempElem);
		
		tempElem = document.createElement("TD");
		tempElem.appendChild(document.createTextNode(itemList[c].color));
		rowElem.appendChild(tempElem);
		
		tempElem = document.createElement("TD");
		tempElem.appendChild(document.createTextNode(itemList[c].type));
		rowElem.appendChild(tempElem);
		
		tempElem = document.createElement("TD");
		tempElem.appendChild(document.createTextNode(itemList[c].price));
		rowElem.appendChild(tempElem);
		
	}

}


function cleanup() {
	pageData.statusDiv = null;
	pageData.seriesDiv = null;
	pageData.modelsDiv = null;
	pageData.itemsDiv = null;
}

window.onload = init;
window.onunload = cleanup;