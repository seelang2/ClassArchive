/*

*/
(function(App) {

	App.start = function() {
		// do init stuff
		
		// initialize view manager module
		App.initViews();
		
		// notify any listeners for the app.start event
		$(App).trigger('app.start');
		
	}; // App.start

})(window.App = window.App || {});

$(document).ready(App.start); // launch App
