// JavaScript Document demo2.js
pageData = new function() {
	this.currentTab = 1;
	this.statusDiv = null;
	this.seriesDiv = null;
	this.modelsDiv = null;
	this.itemsDiv = null;
	this.itemDetailDiv = null;
	this.timer = null;
};

function init() {
	menuItems = document.getElementsByTagName("A");
	pageData.statusDiv = document.getElementById("statusdiv");
	pageData.seriesDiv = document.getElementById("seriesdata");
	pageData.modelsDiv = document.getElementById("modeldata");
	pageData.itemsDiv = document.getElementById("itemdata");
	pageData.itemDetailDiv = document.getElementById("itemdetail");
	
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
	tempElem.appendChild(document.createTextNode('Price'));
	rowElem.appendChild(tempElem);

	for(c = 0; c < itemCount; c++) {

		rowElem = document.createElement("TR");
		rowElem.id = 'item_' + itemList[c].name;
		tbodyElem.appendChild(rowElem);
		if (c % 2 == 0) {
			rowElem.className = 'evenrow';
		} else {
			rowElem.className = 'oddrow';
		}
		
		rowElem.onmouseover = function(e) {
			// get node that triggered event
			var targ;
			if (!e) var e = window.event;
			if (e.target) targ = e.target;
			else if (e.srcElement) targ = e.srcElement;
			if (targ.nodeType == 3) // defeat Safari bug
				targ = targ.parentNode;
			
			// find parent row of target
			while (targ.nodeName != "TR") {
				targ = targ.parentNode;
			}
						
			var runTimedHover = function() { getItemDetail(targ); };
			
			pageData.timer = setTimeout(runTimedHover, 1500);
			
		};
		
		rowElem.onmouseout = function() {
			clearTimeout(pageData.timer);
		};
				
		tempElem = document.createElement("TD");
		tempElem.appendChild(document.createTextNode(itemList[c].name));
		rowElem.appendChild(tempElem);
		
		tempElem = document.createElement("TD");
		tempElem.appendChild(document.createTextNode(itemList[c].price));
		rowElem.appendChild(tempElem);
		
	}

}

function getItemDetail(target) {
	// alert('Node name: '+ target.nodeName + ' ID of target: ' + target.id);
	
	itemName = target.id.substr(5);
	
	ajaxSendReq("GET", '/seriesdata.php?mode=data&item='+itemName, displayItemDetail, null, 'XML');
	pageData.statusDiv.style.visibility = 'visible';
}

function displayItemDetail(response) {
	pageData.statusDiv.style.visibility = 'hidden';
	
	pageData.itemDetailDiv.innerHTML = '';
	
	itemList = XMLParse.xml2ObjArray(response, "mitem");
	
	tempElem = document.createElement("H3");
	tempElem.appendChild(document.createTextNode(itemList[0].name));
	pageData.itemDetailDiv.appendChild(tempElem);
	
	tempElem = document.createElement("P");
	tempElem.appendChild(document.createTextNode('Size: '+itemList[0].size));
	pageData.itemDetailDiv.appendChild(tempElem);
	
	tempElem = document.createElement("P");
	tempElem.appendChild(document.createTextNode('Color: '+itemList[0].color));
	pageData.itemDetailDiv.appendChild(tempElem);
	
	tempElem = document.createElement("P");
	tempElem.appendChild(document.createTextNode('Type: '+itemList[0].type));
	pageData.itemDetailDiv.appendChild(tempElem);
	
	tempElem = document.createElement("P");
	tempElem.appendChild(document.createTextNode('Price: '+itemList[0].price));
	pageData.itemDetailDiv.appendChild(tempElem);
	
}

function cleanup() {
	pageData.statusDiv = null;
	pageData.seriesDiv = null;
	pageData.modelsDiv = null;
	pageData.itemsDiv = null;
	pageData.itemDetailDiv = null;
}

window.onload = init;
window.onunload = cleanup;