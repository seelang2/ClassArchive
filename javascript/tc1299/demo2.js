// JavaScript Document
var PageData = new function() {
	this.rightsideDiv = null;
	this.ajaxobj = null;
	this.formelem = null;
}; // PageData

var App = new function() {
	
	// initialization routine
	this.init = function() {
		PageData.rightsideDiv = document.getElementById("rightside");
		PageData.formelem = document.getElementById("form1");
		
		PageData.ajaxobj = new Ajax();
		
		PageData.formelem.onsubmit = function() {
			data = formData2QueryString(PageData.formelem);
			
			PageData.ajaxobj.doPost('echopost.php?mode=html', data, App.displayStuff, 'text');
			return false;
		}; 
	}; // init
	
	this.displayStuff = function(response) {
		PageData.rightsideDiv.innerHTML = response;
	};
	
	this.cleanup = function() {
		PageData.rightsideDiv = null;
		PageData.formelem = null;
	}; // cleanup
	
}; // App

window.onload = App.init;
window.onunload = App.cleanup;
