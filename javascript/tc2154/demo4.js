// JavaScript Document

// singleton pattern
var Registry = new function() {
	this.formdataDiv = null;
	
};

var App = new function() {
	this.init = function() {
		Registry.formdataDiv = document.getElementById("formdata");
		
		// use a JSON string to manually hardcode data sample for now
		Registry.attribs = { "Size":["S","M","L"],"Color":["Red","Green","Blue","Orange","Yellow"] };
		
		Registry.itemAttribs = [null, 'Size', 'Color'];
		//alert(attribs['Color'][3]);
		//alert(attribs.Color[4]);
		
		App.doForm();
	};
	
	this.cleanup = function() {
		purge(Registry.formdataDiv);
		Registry.formdataDiv = null;
	};
	
	this.doForm = function() {
		
		var pElem = document.createElement("P");
		Registry.formdataDiv.appendChild(pElem);
		
		pElem.appendChild(document.createTextNode('Select an item: '));
		
		var tempElem = document.createElement("SELECT");
		tempElem.name = 'item';
		
		tempElem.onchange = function() {
			//alert(this.value);
			App.updateAttributes(this.value);
		};
		
		var tempOption = document.createElement("OPTION");
		tempOption.value = 0;
		tempOption.text = 'Select one';
		tempElem.appendChild(tempOption);
		
		var tempOption = document.createElement("OPTION");
		tempOption.value = 1;
		tempOption.text = 'Widget';
		tempElem.appendChild(tempOption);
		
		var tempOption = document.createElement("OPTION");
		tempOption.value = 2;
		tempOption.text = 'Doodad';
		tempElem.appendChild(tempOption);
		
		pElem.appendChild(tempElem);
		
		
		var pElem = document.createElement("P");
		Registry.formdataDiv.appendChild(pElem);
		
		pElem.appendChild(document.createTextNode('Select a quantity: '));
		
		var tempElem = document.createElement("INPUT");
		tempElem.name = 'qty';
		tempElem.size = '4';
		pElem.appendChild(tempElem);
		
		Registry.subFormDiv = document.createElement("P");
		Registry.formdataDiv.appendChild(Registry.subFormDiv);

	};
	
	this.updateAttributes = function(itemid) {
		// loop through children and delete them to clear node contents
		while (Registry.subFormDiv.hasChildNodes()) {
			Registry.subFormDiv.removeChild(Registry.subFormDiv.firstChild);
		}
		
		// create text label
		Registry.subFormDiv.appendChild(document.createTextNode('Select a ' + Registry.itemAttribs[itemid]));
		
		// build select tree
		// create select element 
		var selectElem = document.createElement("SELECT");
		selectElem.name = 'attribute';
		// insert select into subFormDiv
		Registry.subFormDiv.appendChild(selectElem);
		// loop through options array and build option elements
		for (var c = 0; c < Registry.attribs[Registry.itemAttribs[itemid]].length; c++) {
			//alert(Registry.attribs[Registry.itemAttribs[itemid]][c]);
			tempElem = document.createElement("OPTION");
			tempElem.value = c; // use the index of the attribute array
			tempElem.text = Registry.attribs[Registry.itemAttribs[itemid]][c];
			// append option to select node
			selectElem.appendChild(tempElem);
		}
		
	};
};

window.onload = App.init;
window.onunload = App.cleanup;












