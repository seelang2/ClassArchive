// JavaScript Document
// set up registry object
var AppData = new function() {
	this.ajax = null;
	this.statusDiv = null;
	this.itemDiv = null;
	this.form1 = null;
	this.itemData = new Array();
	this.editActive = false;
	this.screenDiv = null;
	this.hoverDiv = null;
}; // AppData

// set up application object(s)
var App = new function() {
	this.init = function() {
		AppData.ajax = new Ajax();
		AppData.statusDiv = document.getElementById("statusbar");
		AppData.itemDiv = document.getElementById("itemlist");
		AppData.form1 = document.getElementById("form1");
		AppData.screenDiv = document.getElementById("screen");
		AppData.hoverDiv = document.getElementById("hoverdiv");

		// initialize screen opacity
		OpacElem.setAlpha('screen');
		// set screen opacity to clear
		OpacElem.setOpacity(AppData.screenDiv, 0);
		
		App.getItemData();
	}; // init
	
	this.getItemData = function() {
		// set up dummy variable to work around caching issues
		var x = new Date();
		x = x.getTime();
		// do xhr get request
		AppData.ajax.doGet('seriesdata3.php?mode=data&x=' + x, App.processItemData, 'xml');
		// show status div
		AppData.statusDiv.style.display = 'block';
	}; // getItemTable
	
	this.processItemData = function(response) {
		// hide status div
		AppData.statusDiv.style.display = 'none';
		// parse xml data into object array
		AppData.itemData = XMLParse.xml2ObjArray(response, 'mitem');
		// display table
		App.displayItemTable(AppData.form1, AppData.itemData);
	}; // processItemData
	
	this.displayItemTable = function(parent, itemData) {
		// this assumes the table data is the only content in the parent element
		// purge and clear parent child nodes (old table)
		App.deleteChildren(parent);
		// set up table
		var tempElem = document.createElement("TABLE");
		tempElem.id = 'itemtable';
		parent.appendChild(tempElem);
		
		var tempTbody = document.createElement("TBODY");
		tempElem.appendChild(tempTbody);
		// create header row dynamically
		var tempRow = document.createElement("TR");
		tempTbody.appendChild(tempRow);
		for (field in itemData[0]) {
			var tempElem = document.createElement("TH");
			tempRow.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(field.toUpperCase()));
		}
		
		// build data rows
		for (var c = 0; c < itemData.length; c++) {
			var tempRow = document.createElement("TR");
			tempRow.id = 'item-' + c;
			
			if (c % 2 == 0)
				tempRow.className = 'evenrow';
			else
				tempRow.className = 'oddrow';
			
			tempRow.ondblclick = function(e) {
				if (!e) e = window.event;
				var target = getTargetElem(e);
				// move up to row level
				while (target.nodeName != 'TR')
					target = target.parentNode;
				
				App.showTextBox(target);
			}; // ondblclick
			
			tempTbody.appendChild(tempRow);
			for (field in itemData[c]) {
				var tempElem = document.createElement("TD");
				tempRow.appendChild(tempElem);
				tempElem.appendChild(document.createTextNode(itemData[c][field]));
			}
		}
		
	}; // displayItemTable
	
	this.showTextBox = function(row) {
		// show screen
		AppData.screenDiv.style.display = 'block';
		// fade screen
		OpacFader.initFade(AppData.screenDiv, 0, 70, 5, 1);
		OpacFader.startFade();
		
		// populate hover div
		// parse index from element id
		var index = row.id.split('-')[1];
		// wipe out existing cells in row
		App.deleteChildren(AppData.hoverDiv);
		
		var tempForm = document.createElement("FORM");
		tempForm.id = 'hoverform';
		tempForm.name = 'hoverform';
		tempForm.action = '#';
		AppData.hoverDiv.appendChild(tempForm);
		
		var tempElem = document.createElement("TABLE");
		tempElem.id = 'itemtable';
		tempForm.appendChild(tempElem);
		
		var tempTbody = document.createElement("TBODY");
		tempElem.appendChild(tempTbody);

		for (field in AppData.itemData[0]) {
			var tempRow = document.createElement("TR");
			tempTbody.appendChild(tempRow);
			
			var tempElem = document.createElement("TD");
			tempRow.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(field.toUpperCase() + ':'));
			
			var tempElem = document.createElement("TD");
			tempRow.appendChild(tempElem);
			//tempElem.appendChild(document.createTextNode(AppData.itemData[index][field]));
			var tempInput = document.createElement("INPUT");
			tempElem.appendChild(tempInput);
			tempInput.name = field;
			tempInput.value = AppData.itemData[index][field];
		}
		
		// save and cancel buttons
		var tempElem = document.createElement("INPUT");
		tempElem.type = 'submit';
		tempElem.value = 'Save';
		tempForm.appendChild(tempElem);

		var tempElem = document.createElement("INPUT");
		tempElem.type = 'button';
		tempElem.value = 'Cancel';
		tempForm.appendChild(tempElem);
		tempElem.onclick = function() {
			App.closeTextBox();
		};
		
		tempForm.onsubmit = function() {
			formData = formData2QueryString(this);
			//alert(formData);
			// extract id
			var itemId = formData.split("&")[0].split("=")[1];
			//alert(itemId);
			
			// set up dummy variable to work around caching issues
			var x = new Date();
			x = x.getTime();
			// do xhr get request
			AppData.ajax.doPost('seriesdata3.php?mode=edit&item=' + itemId + '&x=' + x, formData, App.confirmSave, 'text');
			// show status div
			AppData.statusDiv.style.display = 'block';
			App.closeTextBox();
			return false;
		};
		
		// center element
		//centerElement(AppData.hoverDiv);
		// display hoverdiv
		AppData.hoverDiv.style.display = 'block';
	}; // showTextBox
	
	this.closeTextBox = function() {
		// hide hover div
		AppData.hoverDiv.style.display = 'none';
		// fade and hide screen
		OpacFader.initFade(AppData.screenDiv, 70, 0, -5, 1);
		OpacFader.startFade();
		AppData.screenDiv.style.display = 'none';
	}; // closetextbox
	
	this.confirmSave = function(response) {
		AppData.statusDiv.style.display = 'none';
		if (response == 'Ok')
			alert('The record was saved successfully');
		else
			alert('An error has occurred:' + "\n" + response);
	}; // confirmsave
	
	this.makeReadable = function(row) {
		AppData.editActive = true;
		// parse index from element id
		var index = row.id.split('-')[1];
		// wipe out existing cells in row
		App.deleteChildren(row);
		// recreate cells with input fields inside
		for (field in AppData.itemData[0]) {
			var tempTd = document.createElement("TD");
			tempTd.className = 'editfield';
			row.appendChild(tempTd);
			var tempInput = document.createElement("INPUT");
			tempTd.appendChild(tempInput);
			tempInput.value = AppData.itemData[index][field];
		}
		
	}; // makeReadable
	
	this.deleteChildren = function(target) {
		// we don't want to just purge target because that would remove any listeners attached to the target
		while (target.hasChildNodes()) {
			purge(target.firstChild);
			target.removeChild(target.firstChild);
		}
	}; // deleteChildren
	
	this.cleanup = function() {
		purge(document.getElementById("wrapper"));
		AppData.ajax = null;
		AppData.statusDiv = null;
		AppData.itemDiv = null;
		AppData.form1 = null;
	}; // cleanup
}; // App

window.onload = App.init;
window.onunload = App.cleanup;