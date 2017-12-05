// JavaScript Document
var PageData = new function() {
	this.leftsideDiv = null;
	this.rightsideDiv = null;
	this.ajaxobj = null;
	this.itemDiv = null;
	this.statusDiv = null;
	this.hoverDiv = null;
	this.timedHover = null;
	this.itemListActive = true;
}; // PageData

var App = new function() {
	
	// initialization routine
	this.init = function() {
		PageData.leftsideDiv = document.getElementById("leftside");
		PageData.rightsideDiv = document.getElementById("rightside");
		PageData.itemDiv = document.getElementById("itemlist");
		PageData.statusDiv = document.getElementById("status");
		
		App.createHoverDiv();
		
		PageData.ajaxobj = new Ajax();
		
		// caching workaround for aggressive browsers
		x = new Date();
		x = x.getTime();
		// do xhr request
		PageData.ajaxobj.doGet('seriesdata.php?mode=series&x=' + x, App.displaySeries, 'text');
		PageData.statusDiv.style.visibility = 'visible';
		
	}; // init
	
	this.createHoverDiv = function() {
//		PageData.hoverDiv = document.getElementById("hoverdiv");
		PageData.hoverDiv = document.createElement("DIV");
		PageData.hoverDiv.id = 'hoverdiv';
		document.getElementById("content").appendChild(PageData.hoverDiv);
		
	};
	
	// display series
	this.displaySeries = function(response) {
		PageData.statusDiv.style.visibility = 'hidden';
		PageData.leftsideDiv.innerHTML = response;
		
		selectItem = document.getElementById("menu1");
		selectItem.onchange = function(e) {
			if (!e) var e = window.event;
			// get element that triggered the event
			target = getTargetElem(e);
			
			//alert(target.value);

			// caching workaround for aggressive browsers
			x = new Date();
			x = x.getTime();
			// do xhr request
			PageData.ajaxobj.doGet('seriesdata.php?mode=model&series='+target.value+'&x=' + x, App.displayModel, 'text');
			PageData.statusDiv.style.visibility = 'visible';
		
		};
		
	}; // displayseries
	
	// display model
	this.displayModel = function(response) {
		PageData.statusDiv.style.visibility = 'hidden';
		PageData.rightsideDiv.innerHTML = response;
		
		selectItem = document.getElementById("menu2");
		selectItem.onchange = function(e) {
			if (!e) var e = window.event;
			// get element that triggered the event
			target = getTargetElem(e);
			
			//alert(target.value);

			// caching workaround for aggressive browsers
			x = new Date();
			x = x.getTime();
			// do xhr request
			PageData.ajaxobj.doGet('seriesdata.php?mode=data&model='+target.value+'&x=' + x, App.displayItems, 'xml');
			PageData.statusDiv.style.visibility = 'visible';
		
		};
		
	}; // displaymodel
	
	this.displayItems = function(response) {
		PageData.statusDiv.style.visibility = 'hidden';
		PageData.itemDiv.innerHTML = '';
		
		itemList = XMLParse.xml2ObjArray(response, 'mitem');
		
		/*
		pelem = document.createElement("P");
		PageData.rightsideDiv.appendChild(pelem);
		pelem.appendChild(document.createTextNode('This space for rent.'));
		*/
		
		tempElem = document.createElement("TABLE");
		PageData.itemDiv.appendChild(tempElem);
		tbodyElem = document.createElement("TBODY");
		tempElem.appendChild(tbodyElem);
		
		rowElem = document.createElement("TR");
		tbodyElem.appendChild(rowElem);

		tempElem = document.createElement("TH");
		rowElem.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode('Name'));
		
		tempElem = document.createElement("TH");
		rowElem.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode('Size'));
		
		tempElem = document.createElement("TH");
		rowElem.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode('Color'));
		
		tempElem = document.createElement("TH");
		rowElem.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode('Type'));
		
		tempElem = document.createElement("TH");
		rowElem.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode('Price'));
		
		for (c = 0; c < itemList.length; c++) {
			rowElem = document.createElement("TR");
			tbodyElem.appendChild(rowElem);
			if (c % 2 == 0) {
				rowElem.className = 'evenrow';
			} else {
				rowElem.className = 'oddrow';
			}
			// assign unique id to row
			rowElem.id = itemList[c].name;
			
			rowElem.onmouseover = function(e) {
				if (!PageData.itemListActive) return;
				if (!e) var e = window.event;
				// get element that triggered the event
				target = getTargetElem(e);
				
				// bubble up through the dom to the row level
				while (target.nodeName != "TR")
					target = target.parentNode;
				
				//alert(target.id);
				
				var runTimedHover = function() {
					//alert(target.id);
					App.getItem(target.id);
				};
				
				PageData.timedHover = setTimeout(runTimedHover, 1500);
			};
			
			rowElem.onmouseout = function() {
				clearTimeout(PageData.timedHover);
			};
	
			tempElem = document.createElement("TD");
			rowElem.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(itemList[c].name));
			
			tempElem = document.createElement("TD");
			rowElem.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(itemList[c].size));
			
			tempElem = document.createElement("TD");
			rowElem.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(itemList[c].color));
			
			tempElem = document.createElement("TD");
			rowElem.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(itemList[c].type));
			
			tempElem = document.createElement("TD");
			rowElem.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(itemList[c].price));
		}
	};
	
	this.getItem = function(target) {
		// caching workaround for aggressive browsers
		x = new Date();
		x = x.getTime();
		// do xhr request
		PageData.ajaxobj.doGet('seriesdata.php?mode=data&item='+target+'&x=' + x, App.displayHover, 'xml');
		PageData.statusDiv.style.visibility = 'visible';
	}; // getitem
	
	this.displayHover = function(response) {
		PageData.statusDiv.style.visibility = 'hidden';
		PageData.hoverDiv.innerHTML = '';
		
		itemList = XMLParse.xml2ObjArray(response, 'mitem');
		
		divElem = document.createElement("DIV");
		PageData.hoverDiv.appendChild(divElem);
		
		tempElem = document.createElement("H2");
		divElem.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode(itemList[0].name));
		
		tempElem = document.createElement("P");
		divElem.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode(itemList[0].size));
		
		tempElem = document.createElement("P");
		divElem.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode(itemList[0].color));
		
		tempElem = document.createElement("P");
		divElem.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode(itemList[0].type));
		
		tempElem = document.createElement("P");
		divElem.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode(itemList[0].price));
		
		// create close button
		tempElem = document.createElement("INPUT");
		divElem.appendChild(tempElem);
		tempElem.type = 'button';
		tempElem.value = 'Close this Window';
		tempElem.onclick = function() {
			PageData.hoverDiv.style.display = 'none';
			PageData.itemListActive = true;

		};
		
		// now center and display updated hoverdiv
		//centerElement(PageData.hoverDiv);
		PageData.hoverDiv.style.display = 'block';
		PageData.itemListActive = false;
		
	}; // displayhover
	
	this.cleanup = function() {
		PageData.leftsideDiv = null;
		PageData.rightsideDiv = null;
		PageData.itemDiv = null;
		PageData.statusDiv = null;
	}; // cleanup
	
}; // App

window.onload = App.init;
window.onunload = App.cleanup;
