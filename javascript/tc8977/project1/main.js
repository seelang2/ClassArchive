// use IIFE to create namespace
(function(App) {
	// define public App methods here
	
	// App startup - connect to dom ready handler
	App.start = function() {

		var contact = {
			firstname: 'John',
			lastname: 'Doe',
			email: "jdoe@email.com" 
		};

		// save contact in registry
		App.set('contact', contact);

		// add event handler to button
		$('#thebutton').on('click', App.buttonHandler);

	}; // App.start

})(window.App = window.App || {});

// start app on DOM ready
$(document).ready(App.start); // document.ready
