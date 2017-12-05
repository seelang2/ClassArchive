// Set up a modular namespace using an IIFE
(function(App) {

	var privateData = {}; // private to module 2 methods
	
	App.getData = function(key) { return privateData[key]; };
	App.setData = function(key, val) { privateData[key] = val; };

})(window.App = window.App || {});
