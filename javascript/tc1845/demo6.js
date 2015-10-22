// JavaScript Document
// Registry data object
var AppData = new function() {
	this.statusDiv = null;
	this.ajax = null;
	this.acForm = null;
	this.entryField = null;
	this.lookupDiv = null;
	this.currentLine = -1;
	this.lookupLines = new Array();
}; // AppData

// application object
var App = new function() {
	this.init = function() {
		AppData.statusDiv = document.getElementById("statusbar");
		AppData.acForm = document.getElementById("autocomplete");
		AppData.entryField = document.getElementById("entry");
		AppData.lookupDiv = document.getElementById("lookups");
		
		AppData.lookupDiv.onmouseover = function(e) {
			if (!e) e = window.event;
			target = getTargetElem(e);
			
			var itemRef = target.id.split("-")[1];
			AppData.currentLine = itemRef;
			AppData.lookupDiv.childNodes[itemRef].className = 
				AppData.lookupDiv.childNodes[itemRef].className + ' activelookup';
		};
		
		AppData.lookupDiv.onmouseout = function(e) {
			if (!e) e = window.event;
			target = getTargetElem(e);
			
			var itemRef = target.id.split("-")[1];
			AppData.currentLine = itemRef;
			AppData.lookupDiv.childNodes[itemRef].className = 
				AppData.lookupDiv.childNodes[itemRef].className.substr(0,
					AppData.lookupDiv.childNodes[itemRef].className.length - 13);
		};

		AppData.lookupDiv.onclick = function(e) {
			if (!e) e = window.event;
			target = getTargetElem(e);
			
			var itemRef = target.id.split("-")[1];
			AppData.entryField.value = AppData.lookupLines[itemRef];
			App.submitQuery();
		};

		AppData.ajax = new Ajax();
		
		AppData.acForm.onsubmit = function() { 
			App.submitQuery();
			return false;
		};
		AppData.acForm.onkeyup = App.keyHandler;
		
	}; // init
	
	this.keyHandler = function(e) {
		if (!e) e = window.event;
		
		//alert(e.keyCode);
		switch(e.keyCode) {
			case 13: // Enter
				App.submitQuery();
			break;
			case 27: // ESC 
				AppData.entryField.value = '';
				AppData.lookupDiv.style.display = 'none';
			break;
			case 38: // up arrow
				App.lookupUp();
			break;
			case 40: // down arrow
				App.lookupDown();
			break;
			default:
				// collect data from input field and to xhr request
				
				if (AppData.entryField.value.length > 0) {
					fieldData = AppData.entryField.value;
					// cancel any requests currently in play
					AppData.ajax.abort();
					
					var x = new Date();
					x = x.getTime();
					AppData.ajax.doGet('names.php?name=' + fieldData + '&x=' + x, App.updateLookup, 'text');
					AppData.statusDiv.style.display = 'block';
				} else {
					AppData.lookupDiv.style.display = 'none';
				}
				
			break;
		} // switch
		
	}; // keyhandler
	
	this.lookupDown = function() {
		// remove class from line
		if (AppData.currentLine > -1) {
			AppData.lookupDiv.childNodes[AppData.currentLine].className = 
				AppData.lookupDiv.childNodes[AppData.currentLine].className.substr(0,
					AppData.lookupDiv.childNodes[AppData.currentLine].className.length - 13);
		}
		
		AppData.currentLine++;
		if (AppData.currentLine > 7) AppData.currentLine = 7;
		// add selector class to class list
		AppData.lookupDiv.childNodes[AppData.currentLine].className = 
			AppData.lookupDiv.childNodes[AppData.currentLine].className + ' activelookup';
		
		AppData.entryField.value = AppData.lookupLines[AppData.currentLine];
	};

	this.lookupUp = function() {
		// remove class from line
		AppData.lookupDiv.childNodes[AppData.currentLine].className = 
			AppData.lookupDiv.childNodes[AppData.currentLine].className.substr(0,
				AppData.lookupDiv.childNodes[AppData.currentLine].className.length - 13);
		
		AppData.currentLine--;
		if (AppData.currentLine < -1) AppData.currentLine = -1;
		
		// add selector class to class list
		if (AppData.currentLine != -1) {
			AppData.lookupDiv.childNodes[AppData.currentLine].className = 
				AppData.lookupDiv.childNodes[AppData.currentLine].className + ' activelookup';
			AppData.entryField.value = AppData.lookupLines[AppData.currentLine];
		}
	};

	this.updateLookup = function(data) {
		AppData.statusDiv.style.display = 'none';
		
		// hide the lookup div and quit on error message
		if (data.substr(0, 5) == 'Error') {
			AppData.lookupDiv.style.display = 'none';
			return;
		}
		
		// clear out lookup div
		purge(AppData.lookupDiv);
		AppData.lookupDiv.innerHTML = '';
		
		AppData.lookupLines = data.split(',');
		
		for (var c = 0; c < AppData.lookupLines.length; c++) {
			tempElem = document.createElement("DIV");
			tempElem.id = 'item-' + c;
			AppData.lookupDiv.appendChild(tempElem);
			tempElem.appendChild(document.createTextNode(AppData.lookupLines[c]));
			
		}
		
		AppData.lookupDiv.style.display = 'block';
	}
	
	this.submitQuery = function() {
		alert('Submitting query for name=' + AppData.entryField.value);
	}; // submitQuery
	
	this.cleanup = function() {
		purge(document.getElementById("wrapper"));
		AppData.statusDiv = null;
		AppData.acForm = null;
		AppData.entryField = null;
		AppData.lookupDiv = null;
	}; // cleanup
}; // App

window.onload = App.init;
window.onunload = App.cleanup;
