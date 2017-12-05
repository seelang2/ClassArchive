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
			
			Data.ajax.doPost('echopost.php?mode=csv', formData, App.updateRight, 'text');
			
			return false;
		}; // form1.onsubmit
	}; // init
	
	this.updateRight = function(response) {
		Data.rightDiv.innerHTML = '';
		
		// parse response values
		Data.itemList = response.split("\n");
		
		var tableHTML = '<table><tbody>';
		var colData = [];
		
		for (var c = 0; c < Data.itemList.length; c++) {
			colData = Data.itemList[c].split(', ');
			
			tableHTML += '<tr>';
			for (var i = 0; i < colData.length; i++) {
				tableHTML += '<td>'+ colData[i] +'</td>';
			}
			tableHTML += '</tr>';
		}
		
		tableHTML += '</tbody></table>';
		
		Data.rightDiv.innerHTML = tableHTML;
	}; // updateRight
	
}; // App

window.onload = App.init;