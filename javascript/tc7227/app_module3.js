// set up namespacing IIFE
(function(App, undefined) {
	
	var module3data = 'bar3';

	App.data = App.data || {};

	App.module3 = function() {
		console.log(module3data);
	};

})(window.App = window.App || {});

