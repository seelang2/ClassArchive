// JavaScript Document

PageData = new function() {
	this.leftDiv = null;
	this.rightDiv = null;
	this.ajaxreq = null;
	this.statusDiv = null;
	this.itemDiv = null;
	this.allowRowDblClick = true;
	this.currentRow = null;
	this.modifiedRow = null;
	this.rowId = null;
	this.hoverDiv = null;
	this.hoverTimer = null;
	this.screenDiv = null;
}; 

DemoApp = new function() {

	this.init = function() {
		PageData.leftDiv = document.getElementById("leftside");
		PageData.rightDiv = document.getElementById("rightside");
		PageData.statusDiv = document.getElementById("statusmsg");
		PageData.itemDiv = document.getElementById("itemlist");
		PageData.screenDiv = document.getElementById("screen");
		OpacElem.setOpacity(PageData.screenDiv, 0);
		OpacFader.initFade(PageData.screenDiv, 0, 50, 5, 10);
		
		PageData.ajaxreq = new Ajax();
		PageData.ajaxreq.async = true;
		
		// create hover div
		PageData.hoverDiv = document.createElement("DIV");
		document.getElementById("content").appendChild(PageData.hoverDiv);
		PageData.hoverDiv.id = 'hoverdiv';
		
		tempElem = document.createElement("H2");
		PageData.hoverDiv.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode('Name'));
		
		tempElem = document.createElement("P");
		PageData.hoverDiv.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode('Size'));
		
		tempElem = document.createElement("P");
		PageData.hoverDiv.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode('Color'));
		
		tempElem = document.createElement("P");
		PageData.hoverDiv.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode('Type'));
		
		tempElem = document.createElement("P");
		PageData.hoverDiv.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode('Price'));
		
		tempElem = document.createElement("INPUT");
		PageData.hoverDiv.appendChild(tempElem);
		tempElem.type = 'button';
		tempElem.value = 'Close';
		tempElem.onclick = function() {
			PageData.hoverDiv.style.visibility = 'hidden';
		};
		
		centerElement(PageData.hoverDiv);
		
		// retrieve series select
		x = new Date();
		x = x.getTime();

		PageData.ajaxreq.doGet('seriesdata.php?mode=series&x=' + x, DemoApp.displaySeries, 'text');
		PageData.statusDiv.style.visibility = 'visible';

	};
	
	this.cleanup = function() {
		PageData.leftDiv = null;
		PageData.rightDiv = null;
		PageData.statusDiv = null;
		PageData.itemDiv = null;
		PageData.hoverDiv = null;
		PageData.screenDiv = null;
	};
	
	this.displaySeries = function(response) {
		PageData.statusDiv.style.visibility = 'hidden';

		// display the select box
		PageData.leftDiv.innerHTML = response;
		
		// attach behavior to the select
		selectitem = document.getElementById("menu1");
		selectitem.size = 1;
		selectitem.selectedIndex = 0;
		selectitem.onchange = function(e) {
			
			// find which element triggered event
			var target = getTargetElement(e);
			
			// retrieve series select
			x = new Date();
			x = x.getTime();

			//alert(target.value);
			PageData.ajaxreq.doGet('seriesdata.php?mode=model&series=' + target.value + '&x=' + x, DemoApp.displayModel, 'text');
			PageData.statusDiv.style.visibility = 'visible';
			
		};
		
	};
	
	this.displayModel = function(response) {
		PageData.statusDiv.style.visibility = 'hidden';

		// display the model box
		PageData.rightDiv.innerHTML = response;
		
		// attach behavior to the select
		modelitem = document.getElementById("menu2");
		modelitem.size = 1;
		modelitem.value = 'ALL';
		modelitem.onchange = function(e) {
			// find which element triggered event
			var target = getTargetElement(e);
			
			//alert(target.value);
			PageData.ajaxreq.doGet('seriesdata.php?mode=data&model=' + target.value + '&x=' + x, DemoApp.displayItems, 'xml');
			PageData.statusDiv.style.visibility = 'visible';
			
		};
		
	};
	
	this.displayItems = function(response) {
		PageData.statusDiv.style.visibility = 'hidden';

		// clear the items div
		PageData.itemDiv.innerHTML = '';
		
		itemList = XMLParse.xml2ObjArray(response, 'mitem');
		
			tempElem = document.createElement("TABLE");
			PageData.itemDiv.appendChild(tempElem);
			//tempElem.style.width = '100%';
			tempElem.cellSpacing = 0;
			
			tbody = document.createElement("TBODY");
			tempElem.appendChild(tbody);

			// create header row
			tempRow = document.createElement("TR");
			tbody.appendChild(tempRow);
			
			tempElem = document.createElement("TH");
			tempElem.appendChild(document.createTextNode('Name'));
			tempRow.appendChild(tempElem);
			
			tempElem = document.createElement("TH");
			tempElem.appendChild(document.createTextNode('Size'));
			tempRow.appendChild(tempElem);
			
			tempElem = document.createElement("TH");
			tempElem.appendChild(document.createTextNode('Color'));
			tempRow.appendChild(tempElem);

			tempElem = document.createElement("TH");
			tempElem.appendChild(document.createTextNode('Type'));
			tempRow.appendChild(tempElem);

			tempElem = document.createElement("TH");
			tempElem.appendChild(document.createTextNode('Price'));
			tempRow.appendChild(tempElem);

			tempElem = document.createElement("TH");
			tempElem.appendChild(document.createTextNode(' '));
			tempRow.appendChild(tempElem);

		itemCount = itemList.length;
		for (c = 0; c < itemCount; c++) {
			
			tempRow = document.createElement("TR");
			tbody.appendChild(tempRow);
			tempRow.id = itemList[c].name;
			
			if (c % 2 == 0) {
				tempRow.className = 'evenrow';
			} else {
				tempRow.className = 'oddrow';
			}
			
			tempElem = document.createElement("TD");
			tempElem.appendChild(document.createTextNode(itemList[c].name));
			tempRow.appendChild(tempElem);
			
			tempElem = document.createElement("TD");
			tempElem.appendChild(document.createTextNode(itemList[c].size));
			tempRow.appendChild(tempElem);
			
			tempElem = document.createElement("TD");
			tempElem.appendChild(document.createTextNode(itemList[c].color));
			tempRow.appendChild(tempElem);
			
			tempElem = document.createElement("TD");
			tempElem.appendChild(document.createTextNode(itemList[c].type));
			tempRow.appendChild(tempElem);
			
			tempElem = document.createElement("TD");
			tempElem.appendChild(document.createTextNode(itemList[c].price));
			tempRow.appendChild(tempElem);

			tempElem = document.createElement("TD");
			tempElem.appendChild(document.createTextNode(' '));
			tempRow.appendChild(tempElem);

			// set up row double click event
			tempRow.ondblclick = function(e) {
				if (!PageData.allowRowDblClick) return;
				
				target = getTargetElement(e);
				
				// bubble up the DOM to the table row level
				while (target.nodeName != 'TR')
					target = target.parentNode;
				
				//alert(target.nodeName + ' ' + target.id);
				DemoApp.getItemData(target.id, DemoApp.showItemForm);
				
			};
			
			tempRow.onmouseover = function(e) {
				target = getTargetElement(e);
				
				// bubble up the DOM to the table row level
				while (target.nodeName != 'TR')
					target = target.parentNode;
					
				var doHover = function() {
					DemoApp.getItemData(target.id, DemoApp.showHoverDiv);
				};
				
				PageData.hoverTimer = setTimeout(doHover, 500);
			};
			
			tempRow.onmouseout = function(e) {
				clearTimeout(PageData.hoverTimer);
			};
		}
	};
	
	this.getItemData = function(itemid, handlerfunc) {
		//alert(itemid);
		
		x = new Date();
		x = x.getTime();
		
		// cancel any requests in transit
		PageData.ajaxreq.abort();

		PageData.ajaxreq.doGet('seriesdata.php?mode=data&item=' + itemid + '&x=' + x, handlerfunc, 'xml');
		PageData.statusDiv.style.visibility = 'visible';
		
	};
	
	this.showHoverDiv = function(response) {
		PageData.statusDiv.style.visibility = 'hidden';
		
		// get item data
		itemData = XMLParse.xml2ObjArray(response, 'mitem');
		
		// clear out old div content
		while (PageData.hoverDiv.firstChild) {
			PageData.hoverDiv.removeChild(PageData.hoverDiv.firstChild);
		}
		
		// insert values into div
		tempElem = document.createElement("H2");
		PageData.hoverDiv.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode(itemData[0].name));
		
		tempElem = document.createElement("P");
		PageData.hoverDiv.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode('Size: ' + itemData[0].size));
		
		tempElem = document.createElement("P");
		PageData.hoverDiv.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode('Color: ' + itemData[0].color));
		
		tempElem = document.createElement("P");
		PageData.hoverDiv.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode('Type: ' + itemData[0].type));
		
		tempElem = document.createElement("P");
		PageData.hoverDiv.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode('Price: ' + itemData[0].price));
		
		tempElem = document.createElement("INPUT");
		PageData.hoverDiv.appendChild(tempElem);
		tempElem.type = 'button';
		tempElem.value = 'Close';
		tempElem.onclick = function() {
			PageData.hoverDiv.style.visibility = 'hidden';
			OpacFader.initFade(PageData.screenDiv, 50, 0, 5, 10);
			OpacFader.startFade();
			PageData.screenDiv.style.visibility = 'hidden';
		};
		
		// center div
		centerElement(PageData.hoverDiv);
		
		// make div visible
		PageData.screenDiv.style.visibility = 'visible';
		OpacFader.startFade();
		PageData.hoverDiv.style.visibility = 'visible';
	};
	
	this.showItemForm = function(response) {
		PageData.statusDiv.style.visibility = 'hidden';

		itemData = XMLParse.xml2ObjArray(response, 'mitem');
		
		// store working row in registry to avoid server trip
		PageData.currentRow = itemData;
		PageData.rowId = itemData[0].name;
		
		// get appropriate row
		row = document.getElementById(itemData[0].name);
		
		// disable row double click events
		PageData.allowRowDblClick = false;
		
		// remove all cells inside row
		while (row.firstChild) {
			row.removeChild(row.firstChild);
		}
		
		// create new cells with input fields
		tempElem = document.createElement("TD");
		row.appendChild(tempElem);
		tempInput = document.createElement("INPUT");
		tempElem.appendChild(tempInput);
		tempInput.name = 'Name';
		tempInput.value = itemData[0].name;

		tempElem = document.createElement("TD");
		row.appendChild(tempElem);
		tempInput = document.createElement("INPUT");
		tempElem.appendChild(tempInput);
		tempInput.name = 'Size';
		tempInput.value = itemData[0].size;

		tempElem = document.createElement("TD");
		row.appendChild(tempElem);
		tempInput = document.createElement("INPUT");
		tempElem.appendChild(tempInput);
		tempInput.name = 'Color';
		tempInput.value = itemData[0].color;

		tempElem = document.createElement("TD");
		row.appendChild(tempElem);
		tempInput = document.createElement("INPUT");
		tempElem.appendChild(tempInput);
		tempInput.name = 'Type';
		tempInput.value = itemData[0].type;

		tempElem = document.createElement("TD");
		row.appendChild(tempElem);
		tempInput = document.createElement("INPUT");
		tempElem.appendChild(tempInput);
		tempInput.name = 'Price';
		tempInput.value = itemData[0].price;

		tempElem = document.createElement("TD");
		row.appendChild(tempElem);
		// save button
		tempInput = document.createElement("INPUT");
		tempElem.appendChild(tempInput);
		tempInput.type = 'image';
		tempInput.src = 'b_edit.png';
		tempInput.className = 'icon';
		
		tempInput.onclick = function(e) {
			
			itemform = document.getElementById("itemform");
			
			// make copy of original row to get object array structure
			PageData.modifiedRow = PageData.currentRow;

			//alert(PageData.currentRow[0].name);
			// save form data to modifiedRow elements
			for (i = 0; i < itemform.elements.length; i++) {
				formElem = itemform.elements[i];
				if (formElem.name == 'Name') PageData.modifiedRow[0].name = formElem.value;
				if (formElem.name == 'Color') PageData.modifiedRow[0].color = formElem.value;
				if (formElem.name == 'Size') PageData.modifiedRow[0].size = formElem.value;
				if (formElem.name == 'Type') PageData.modifiedRow[0].type = formElem.value;
				if (formElem.name == 'Price') PageData.modifiedRow[0].price = formElem.value;
			}
			//alert(PageData.currentRow[0].name);
			
			formData = formData2QueryString(itemform);

			target = getTargetElement(e);
			
			// bubble up the DOM to the table row level
			while (target.nodeName != 'TR')
				target = target.parentNode;
			
			x = new Date();
			x = x.getTime();
			PageData.ajaxreq.doPost('seriesdata.php?mode=edit&item=' + target.id + '&x=' + x, formData, DemoApp.confirmUpdate, 'text');
			PageData.statusDiv.style.visibility = 'visible';
			
			return false;
		};
		
		// cancel button
		tempInput = document.createElement("INPUT");
		tempElem.appendChild(tempInput);
		tempInput.type = 'image';
		tempInput.src = 'b_drop.png';
		tempInput.className = 'icon';
		
		tempInput.onclick = function() {
			DemoApp.revertRow(PageData.currentRow);
			return false;
		};
		
		
		
	};
	
	this.confirmUpdate = function(response) {
		PageData.statusDiv.style.visibility = 'hidden';
		
		if (response == 'Ok') {
			// presume data saved properly
			alert('Changes have been saved.');
			DemoApp.revertRow(PageData.modifiedRow);
			
		} else {
			// show error message
			alert(response);
			
			// perform any other processing (or not) we desire 
			
		}
	};
	
	this.revertRow = function(rowData) {
		//alert(rowData[0].name);
		
		// get appropriate row
		row = document.getElementById(PageData.rowId);
		
		// enable row double click events
		PageData.allowRowDblClick = true;
		
		// remove all cells inside row
		while (row.firstChild) {
			row.removeChild(row.firstChild);
		}
		
		// recreate row cells
		tempElem = document.createElement("TD");
		tempElem.appendChild(document.createTextNode(rowData[0].name));
		row.appendChild(tempElem);
		
		tempElem = document.createElement("TD");
		tempElem.appendChild(document.createTextNode(rowData[0].size));
		row.appendChild(tempElem);
		
		tempElem = document.createElement("TD");
		tempElem.appendChild(document.createTextNode(rowData[0].color));
		row.appendChild(tempElem);
		
		tempElem = document.createElement("TD");
		tempElem.appendChild(document.createTextNode(rowData[0].type));
		row.appendChild(tempElem);
		
		tempElem = document.createElement("TD");
		tempElem.appendChild(document.createTextNode(rowData[0].price));
		row.appendChild(tempElem);

		tempElem = document.createElement("TD");
		tempElem.appendChild(document.createTextNode(' '));
		row.appendChild(tempElem);

		
	};

};

function getTargetElement(e) {
	var target;
	if (!e) var e = window.event;
	if (e.target) target = e.target;
	else if (e.srcElement) target = e.srcElement;
	if (target.nodeType == 3) // defeat Safari bug
		target = target.parentNode;
	return target;
}

Flasher = new function() {
	this.timedEvent = null;
	this.counter = 0;
	
	this.resetBackground = function() {
		Flasher.counter++;
		if (Flasher.counter % 2 == 0) {
			bgcolor = '#ff0000';	
		} else {
			bgcolor = '#ffffff';	
		}
		PageData.rightDiv.style.backgroundColor = bgcolor;
		
		if (Flasher.counter > 4) {
			clearInterval(Flasher.timedEvent);
			Flasher.counter = 0;
		}
	}
	
};

//document.onkeyup = DemoApp.

window.onload = DemoApp.init;
window.onunload = DemoApp.cleanup;

