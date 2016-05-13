/**
 * Feedback form 'plugin' module
 */
$(document).ready(function() {
var data = {}; 
// load feedback widget HTML
$.ajax({
	url: 		'feedback_widget.html',
	method: 	'get',
	dataType: 	'html'
}).done(function(content){
	data.feedbackElem = 
	$(content)
		.find('form')
		.hide()
		.on('submit', function(e) {
			e.preventDefault();
			var form = this; // store reference to form for later use
			$.ajax({
				url: 		'echo.php',
				method: 	'post',
				dataType: 	'json',
				data: 		$(this).serialize()
			}).done(function(response) {
				console.log(response);
				form.reset(); // reset is a POJ method, not jQuery
				var thankyoumessage = 
				$(form)							// select form
					.hide()						// then hide it
					.closest('#feedback')		// traverse back uop to top 
					.find('.thankyoumessage')	// find the thankyou
					.show();					// and show it

				// set up box to close automatically after a few seconds
				setTimeout(function() {
					$(thankyoumessage).slideUp();
				}, 3000);
			});
		})
		.end()
		.find('.control')
		.on('click', function(e) {
			$(this)
				.closest('#feedback')
				.find('form')
				.slideToggle();
		})
		.end()
		.prependTo(document.body);
})

});

