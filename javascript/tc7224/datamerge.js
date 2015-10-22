// jQuery plugins are encapsulated in an IIFE
(function($) {

	$.fn.merge = function(data) {
		return this.each(function(i, template) {
			var $template = $(template);
			
			// loop through contact columns
			$.each(
				data,
				function(fieldName, fieldVal) {
					// merge field data into template
					$template
						.find('[data-name="'+fieldName+'"]')
						.html(fieldVal);
				}
			);
		 })
	}; // $.fn.merge

})(jQuery);

