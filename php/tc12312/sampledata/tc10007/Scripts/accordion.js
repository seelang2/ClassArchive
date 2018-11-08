/**
 * Quick and dirty accordion plugin
 * How to use:
 * Add the "accordion" class to the accordion item.
 * Add the "accordion-control" class to the child element of "accordion" that controls the behavior.
 * Add the "accordion-target" attribute to the child element of "accordion" to be expanded/collapsed
 * Call $(parentElem).initAccordion(flag) to initialize all accordions inside of parentElem
 * If flag is true (default), the accordion targets are closed on initialization
 * If flag is false, the accordion targets are left open on initialization
 */
 (function($) {
 	$.fn.initAccordion = function(flag) {
 		flag = typeof flag == "undefined" ? true: flag;
 		return this.each(function (index, element) {
 			$(element)
 				.find('.accordion-control')
 				.on('click', function(evt) {
 					$(this)
 						.closest('.accordion')
 						.find('.accordion-target')
 						.slideToggle();
 				 });

 				if (flag) {
 					$(element)
	 					.find('.accordion-target')
	 					.hide();
 				}
 		});
 	}
 })(jQuery);