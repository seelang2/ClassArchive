// singleton registry object
Registry = new function() {
	this.ajax = null;
	this.field = '';
	this.acfield = null;
	this.actable = null;
	this.actbody = null;
}; // Registry object

var App = new function() {
	this.init = function() {
		Registry.ajax = new Ajax;
		Registry.acfield = document.getElementById("acfield");
		Registry.actable = document.getElementById("actable");
		Registry.actbody = document.getElementById("actbody");
		
		Registry.actable.style.display = 'none';
		
		Registry.acfield.onkeyup = App.lookup;
		Registry.acfield.onmouseup = App.lookup;
		
	}; // init
	
	this.cleanup = function() {
		//
	}; // cleanup
	
	this.lookup = function() {
		if (this.value == '') return;
		
		Registry.field = this.value;
		// abort any current requests
		Registry.ajax.abort();
		// make ajax call
		Registry.ajax.doGet('names.php?name=' + Registry.field, App.updateLookup, 'text');
	}
	
	this.updateLookup = function(response) {
		Registry.actbody.innerHTML = '';
		
		if (response.substr(0,5) == 'Error') return;
		
		Registry.actbody.innerHTML = response;
		// make table viewable
		Registry.actable.style.display = 'block';
	};
	
	
}; // App

window.onload = App.init;
window.onunload = App.cleanup;