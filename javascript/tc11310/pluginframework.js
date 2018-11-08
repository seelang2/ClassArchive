/**
 * Basic plugin framework
 *
 */
 (function($) {

 	// to create a top level (useless) plugin method:
 	$.methodName = function() {};
 	// callable via $.methodName();

 	// to create a collection object plugin method:
 	$.fn.methodName = function() {
 		// 'this' refers to the current collection
 		// always loop through the collection and do stuff to every item
 		// always return the collection to preserve chaining
 		return this.each(function(index, element) {

 		});
 	};

 })(jQuery);