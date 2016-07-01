// use an IIFE to isolate plugin code
(function($) {

// private private data and functions here

// to create a top-level $.method
// $.method = function() { }

// to create a collection object method $().method
// $.fn.method = function() {}

$.fn.redraw = function(rowData) {
	return this.each(function(i, tbody) {
		$(tbody).empty();

		$.each(rowData, function(index, rowItem) {
			var $trElem = $('<tr />')
				.appendTo(tbody);
			$.each(rowItem, function( fieldName, fieldValue) {
				$('<td />')
					.attr('data-fieldname', fieldName)
					.append(fieldValue)
					.appendTo($trElem);
			});
		});
	});
}; // redraw

})(jQuery);
