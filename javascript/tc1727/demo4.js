// JavaScript Document
var AppData = new function() {
	this.form1 = null;
	this.rightDiv = null;
	this.statusDiv = null;
	this.ajax = null;
}; // AppData

var App = new function() {
	this.init = function() {
		AppData.form1 = document.getElementById("form1");
		AppData.rightDiv = document.getElementById("rightside");
		AppData.statusDiv = document.getElementById("statusbar");
		AppData.ajax = new Ajax();
		
		AppData.form1.onsubmit = function() {
			
			var formData = formData2QueryString(AppData.form1);
			
			AppData.ajax.doPost('echopost.php?mode=xml', formData, App.displayResult, 'xml');
			
			// show status bar
			AppData.statusDiv.style.display = 'block';
			return false;
		}; // appdata.link1.onclick
	}; // init
	
	this.cleanup = function() {
		AppData.form1 = null;
		AppData.rightDiv = null;
		AppData.statusDiv = null;
	}; // cleanup
	
	this.displayResult = function(response) {
		// hide status bar
		AppData.statusDiv.style.display = 'none';

		// clearing a container method 1
		//AppData.rightDiv.innerHTML = '';
		
		// clearing a container method 2
		while (AppData.rightDiv.hasChildNodes())
			AppData.rightDiv.removeChild(AppData.rightDiv.firstChild);
		
		var fieldList = XMLParse.xml2ObjArray(response, 'field');
		
		var tempElem = document.createElement("TABLE");
		AppData.rightDiv.appendChild(tempElem);
		
		var tempTbody = document.createElement("TBODY");
		tempElem.appendChild(tempTbody);
		
		
		for (var c = 0; c < fieldList.length; c++) {
			
			var tempRow = document.createElement("TR");
			tempTbody.appendChild(tempRow);
			tempRow.id = 'row_' + c;
			
			if (c % 2 == 0)
				tempRow.className = 'evenrow';
			else
				tempRow.className = 'oddrow';
			
			tempElem = document.createElement("TD");
			tempRow.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(fieldList[c].name));
		
			tempElem = document.createElement("TD");
			tempRow.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(fieldList[c].value));
		
		}
		
	}; // displayResult
}; // App

window.onload = App.init;
window.onunload = App.cleanup;
