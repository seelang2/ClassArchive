// use IIFE to create namespace
(function(App) {

	// some button handler method
	App.buttonHandler = function(evt) {
		console.log(App.get('contact'));
	};

})(window.App = window.App || {});
