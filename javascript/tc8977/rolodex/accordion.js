// Enclose plugin inside IIFE
// pass jQuery into IIFE because $ may not be the jQuery alias.
(function($) {
	// $.method = function() <-- creates $.method()
	// $.fn.method = function() <-- creates $().method()
	$.fn.accordionize = function() {
		// this refers to the current collection
		// and always return the collection to maintain chaining
		return this.each(function (index, element) {
			$(element)
				.find('.content')
				.hide()
				.prev()
				.on('click', function() {
					// show adjacent sublist
					$(this)
						.next()
						.slideToggle();
				});
		});

	}; // accordionize

})(jQuery);