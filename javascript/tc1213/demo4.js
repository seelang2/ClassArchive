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
}; 

DemoApp = new function() {

	this.init = function() {
		PageData.leftDiv = document.getElementById("leftside");
		PageData.rightDiv = document.getElementById("rightside");
		PageData.statusDiv = document.getElementById("statusmsg");
		PageData.itemDiv = document.getElementById("itemlist");
		PageData.ajaxreq = new Ajax();
		PageData.ajaxreq.async = true;
		
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
				DemoApp.getItemData(target.id);
				
			};
			
			
		}
		
	};
	
	this.getItemData = function(itemid) {
		x = new Date();
		x = x.getTime();

		PageData.ajaxreq.doGet('seriesdata.php?mode=data&item=' + itemid + '&x=' + x, DemoApp.showItemForm, 'xml');
		PageData.statusDiv.style.visibility = 'visible';
		
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

