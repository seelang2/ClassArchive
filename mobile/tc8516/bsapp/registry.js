/*
registry.js - Basic Registry module
Attaches getter and setter methods to the App object
while keeping the actual data hidden inside the  IIFE scope

*/
(function(App) {

	// private data storage
	var data = {};
	
	// retrieves value from data object
	App.getData = function(key) {
		// if the key doesn't exist return as undefined
		if (typeof data[key] == 'undefined') return undefined;
		
		return data[key];
	};
	
	// sets value to key in data object
	App.setData = function(key, value) {
		data[key] = value;
		return;
	};

})(window.App = window.App || {});