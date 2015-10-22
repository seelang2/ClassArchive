// set up namespacing IIFE
(function(App) {

	App.data = App.data || {};
	
	App.module1 = function() {
		console.log(App);
	};

})(window.App = window.App || {});

