// set up namespacing IIFE
(function(App) {
	
	App.module2 = function() {
		console.log(App);
	};

})(window.App = window.App || {});

