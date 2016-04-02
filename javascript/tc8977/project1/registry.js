// use IIFE to create a simple data registry
(function(App) {
	// the data object is private inside the IIFE
	var data = {};
	
	// define getters and setters to access data
	App.set = function(key, value) {
		data[key] = value;
	};

	App.get = function(key) {
		return data[key];
	};

})(window.App = window.App || {}); 
