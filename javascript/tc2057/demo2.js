// JavaScript Document
// singleton registry pattern to store global values
var Registry = new function() {
	this.contentDiv = null;
}; // registry

var App = new function() {
	this.init = function() {
		Registry.contentDiv = document.getElementById("content");
		
		calendar = new CalendarObj();
		//calendar.initDate('02/01/2008');
		calendar.insert(Registry.contentDiv, 0);
	}; // init
	
	this.cleanup = function() {
		purge(Registry.contentDiv);
		Registry.contentDiv = null;
	}; // cleanup
	
	
}; //app


window.onload = App.init;
window.onunload = App.cleanup;