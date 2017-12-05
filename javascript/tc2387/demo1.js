// JavaScript Document
var Data = new Object(); // create data object to store global data

var App = new function() {
	this.init = function() {
		Data.rightDiv = document.getElementById("rightcol");
		Data.ajax = new Ajax();
		
		document.form1.onsubmit = function() {
			var formData = '';
			for (var c = 0; c < document.form1.elements.length; c++) {
				if (document.form1.elements[c].name != '') {
					if (c > 0) { formData += '&'; }
					formData += document.form1.elements[c].name + '=' +
								escape(document.form1.elements[c].value);
				}
			}
			//alert(formData);
			
			Data.ajax.doPost('echopost.php?mode=html', formData, App.updateRight, 'text');
			
			return false;
		}; // form1.onsubmit
	}; // init
	
	this.updateRight = function(response) {
		Data.rightDiv.innerHTML = response;
		
	}; // updateRight
	
}; // App

window.onload = App.init;