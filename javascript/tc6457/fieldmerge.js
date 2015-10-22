
(function($) {
	
	// define default options object
	var defaultOptions = {
		srcAttribute:	'data-fieldname'
	};
	
	
	$.fn.fieldMerge = function(data, options) {
		
		options = $.extend({}, options, defaultOptions);
		
		console.log(data);
		
		return this.each(function(index, srcElem) {
			
			$(srcElem)
				.find('[' + options.srcAttribute + ']')
				.each(function(i, dataElem) {
					
					// take srcAttribute value as data property
					var value = $(dataElem).attr(options.srcAttribute);
					
					// and assign as text or value of dataElem
					if (dataElem.nodeName == "INPUT") {
						// use .val() to assign data
						$(dataElem).val(data[value]);
					} else {
						// use .text() to assign data
						$(dataElem).text(data[value]);
					}
					
					
				 });
		
		});
		
	}; // fieldMerge



})(jQuery);

