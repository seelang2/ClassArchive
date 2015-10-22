// Set up a modular namespace using an IIFE
(function(App) {

	var privateData = {}; // private to module 1 methods
	
	App.m1stuff = function() { };

})(window.App = window.App || {});
