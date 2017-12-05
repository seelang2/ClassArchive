// JavaScript Document
var Data = new Object(); // create data object to store global data

var App = new function() {
	this.init = function() {
		Data.rightDiv = document.getElementById("rightcol");
		Data.statusDiv = document.getElementById("statusbar");
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
			
			var x = new Date();
			x = x.getTime();
			Data.ajax.doPost('echopost.php?mode=xml&x='+ x, formData, App.updateRight, 'xml');
			// activate status div
			Data.statusDiv.style.display = 'block';
			Data.rightDiv.innerHTML = '<p>Loading, please wait... <br /><img src="19-0.gif" /></p>';
			return false;
		}; // form1.onsubmit
	}; // init
	
	this.updateRight = function(response) {
		// hide status div
		Data.statusDiv.style.display = 'none';
		
		Data.rightDiv.innerHTML = '';
		
		var fieldList = XMLParse.xml2ObjArray(response, 'field');
		
		var tableHTML = '<table><tbody>';

		for (var c = 0; c < fieldList.length; c++) {
			
			tableHTML += '<tr>';
			tableHTML += '<td>'+ fieldList[c].name +'</td>' + '<td>'+ fieldList[c].value +'</td>';
			tableHTML += '</tr>';
		}
		
		Data.rightDiv.innerHTML = tableHTML;
	}; // updateRight
	
}; // App

window.onload = App.init;