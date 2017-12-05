// JavaScript Document
var PageData = new function() {
	this.rightsideDiv = null;
	this.ajaxobj = null;
	this.formelem = null;
	this.statusDiv = null;
}; // PageData

var App = new function() {
	
	// initialization routine
	this.init = function() {
		PageData.rightsideDiv = document.getElementById("rightside");
		PageData.formelem = document.getElementById("form1");
		PageData.statusDiv = document.getElementById("status");
		
		PageData.ajaxobj = new Ajax();
		
		PageData.formelem.onsubmit = function() {
			data = formData2QueryString(PageData.formelem);
			
			x = new Date();
			x = x.getTime();
			
			PageData.ajaxobj.doPost('echopost.php?mode=xml&x=' + x, data, App.displayStuff, 'xml');
			PageData.statusDiv.style.visibility = 'visible';
			return false;
		}; 
	}; // init
	
	this.displayStuff = function(response) {
		PageData.statusDiv.style.visibility = 'hidden';
		PageData.rightsideDiv.innerHTML = '';
		
		fieldList = XMLParse.xml2ObjArray(response, 'field');
		
		/*
		pelem = document.createElement("P");
		PageData.rightsideDiv.appendChild(pelem);
		pelem.appendChild(document.createTextNode('This space for rent.'));
		*/
		
		tempElem = document.createElement("TABLE");
		PageData.rightsideDiv.appendChild(tempElem);
		tbodyElem = document.createElement("TBODY");
		tempElem.appendChild(tbodyElem);
		
		rowElem = document.createElement("TR");
		tbodyElem.appendChild(rowElem);

		tempElem = document.createElement("TH");
		rowElem.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode('Name'));
		
		tempElem = document.createElement("TH");
		rowElem.appendChild(tempElem);
		tempElem.appendChild(document.createTextNode('Value'));
		
		for (c = 0; c < fieldList.length; c++) {
			rowElem = document.createElement("TR");
			tbodyElem.appendChild(rowElem);
			if (c % 2 == 0) {
				rowElem.className = 'evenrow';
			} else {
				rowElem.className = 'oddrow';
			}
	
			tempElem = document.createElement("TD");
			rowElem.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(fieldList[c].name));
			
			tempElem = document.createElement("TD");
			rowElem.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(fieldList[c].value));
		}
	};
	
	this.cleanup = function() {
		PageData.rightsideDiv = null;
		PageData.formelem = null;
		PageData.statusDiv = null;
	}; // cleanup
	
}; // App

window.onload = App.init;
window.onunload = App.cleanup;
