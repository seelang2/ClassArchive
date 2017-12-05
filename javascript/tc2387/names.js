// global data object
var Data = new Object();

var App = new function() {
	this.init = function() {
		Data.formElem = document.getElementById("form1");
		Data.nameField = document.getElementById("namefield");
		Data.resultBox = document.getElementById("resultbox");
		Data.results = document.getElementById("results");
		Data.ajax = new Ajax();
		Data.fieldData = '';
		
		Data.formElem.onkeyup = function(e) {
			if (!e) var e = window.event;
			//alert(e.keyCode);
			
			// only do ajax call if field data has changed
			if (Data.fieldData != Data.nameField.value) {
				Data.fieldData = Data.nameField.value; // update field data
				
				if (Data.fieldData != '') { // only do ajax call if there's data present
					Data.ajax.doGet('names.php?name='+Data.fieldData, App.updateResults, 'text');
				} else {
					Data.resultBox.style.display = 'none'; // hide result box if field is blank
				}
			}
		}; // onkeyup
		
		Data.results.onmouseover = function(e) {
			if (!e) var e = window.event;
			var target = getTargetElem(e);
			
			Data.nameField.value = target.firstChild.nodeValue;
			// assign highlight class to row (target's parent)
			target.parentNode.className = 'highlight';
		}; 
		
		Data.results.onmouseout = function(e) {
			if (!e) var e = window.event;
			var target = getTargetElem(e);
			
			// remove highlight class from row (target's parent)
			target.parentNode.className = '';
		}; 
		
		Data.results.onclick = function() {
			Data.resultBox.style.display = 'none';
			App.submitForm();
		}
		
		Data.formElem.onsubmit = function() { 
			App.submitForm();
		};
		
	}; // init
	
	this.submitForm = function() {
		alert(Data.nameField.value);
		return false;
	}; // submitForm
	
	this.updateResults = function(response) {
		Data.results.innerHTML = response;
		Data.resultBox.style.display = 'block';
	}; // updateResults
	
}; // App

window.onload = App.init;
