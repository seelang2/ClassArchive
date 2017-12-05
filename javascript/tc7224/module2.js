// Set up a modular namespace using an IIFE
(function(App) {

	var privateData = {}; // private to module 2 methods

	App.m2stuff = function() { };

})(window.App = window.App || {});
