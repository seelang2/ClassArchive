/***********************
 *	Filename: formvalidator-1.0.js
 *	Version: 1.0 2013/03/26
 *	Auth: Chris Langtiw chris@sitebabble.com http://www.sitebabble.com
 *	License: Creative Commons Attribution 3.0 Unported License
 *	License URL: http://creativecommons.org/licenses/by/3.0/deed.en_US
 *	
 *	Description: Form Validation plugin
 *	This plugin gets passed a form (any container, really) and looks for all the input 
 *	elements within it. It then looks for a validation rule attribute 'data-vrule' and
 *	tests the element for that rule. If the element fails the rule, an error message is
 *	placed in the element's 'data-verror' attribute. It then returns the set of nodes 
 *	that failed the validation test.
 *
 *	Validation rules (values for 'data-vrule'):
 *	notempty	- The field cannot be empty
 *	minlength	- field has a minimum length specified in 'data-vminval'
 *	maxlength	- field has a maximum length specified in 'data-vmaxval'
 *	lenbetween	- field must have a length between the values in 'data-vminval' and 
 *				  'data-vmaxval' inclusive
 *	valbetween	- field must have a value between the values in 'data-vminval' and 
 *				  'data-vmaxval' inclusive
 *	isnumeric	- field must be a valid number (float or integer)
 *	isalpha		- field only contains the letters a-z
 *	isalphanumeric		- field only contains the letters a-z and numbers 0-9
 *	isemail		- field appears to be a valid email address
 *	matchregex	- field matches the regular expression given in 'data-vregex'
 *
 ***/

// jQuery plugins use an IIFE that passes in the jQuery object to extend it
(function($) {
	
	$.fn.getInvalidFields = function() {
		
		return this
			.find(':input')
			.removeAttr('data-verror') // remove validation error attribute if there 
			.filter(function(index) {
				
				var vrule = $(this).attr('data-vrule'); // extract validation rule
				var vminval = parseFloat($(this).attr('data-vminval')); // extract numeric val
				var vmaxval = parseFloat($(this).attr('data-vmaxval')); // extract numeric val
				var vregex = new RegExp($(this).attr('data-vregex')); // extract regex string
				var fieldVal = $(this).val(); // extract field value
				
				if (!vrule) return false; // if no validation rule on this element, exclude
				
				//console.log('checking rule', index,':', vrule,'min', vminval,'max', vmaxval, 'val',fieldVal, 'regex',vregex);
				
				switch(true) {
					case vrule == 'notempty' && 
						fieldVal.length < 1:
						
						$(this).attr('data-verror','Must not be blank');
						return true; // include this element in exception list
					break;
					
					case vrule == 'minlength' && 
						fieldVal.length < vminval:
						
						$(this).attr('data-verror','Must be at least ' + vminval + ' characters');
						return true; // include this element in exception list
					break;
					
					case vrule == 'maxlength' && 
						fieldVal.length > vmaxval:
						
						$(this).attr('data-verror','Must be under ' + (vmaxval + 1) + ' characters');
						return true; // include this element in exception list
					break;
					
					case vrule == 'lenbetween' && 
						( fieldVal.length < vminval || fieldVal.length > vmaxval ):
						
						$(this).attr('data-verror','Must be between ' + (vminval - 1) + 
							' and ' + (vmaxval + 1) + ' characters');
						return true; // include this element in exception list
					break;
					
					case vrule == 'isnumeric' &&
						( isNaN(parseFloat(fieldVal)) || !isFinite(fieldVal) ):
						
						$(this).attr('data-verror','Must be numeric');
						return true; // include this element in exception list
					break;
					
					case vrule == 'valbetween' && 
						( !isNaN(parseFloat(fieldVal)) || isFinite(fieldVal) ) &&
						( fieldVal < vminval || fieldVal > vmaxval ):
						
						$(this).attr('data-verror','Must be a number between ' + vminval + 
							' and ' + vmaxval + ' inclusive');
						return true; // include this element in exception list
					break;
					
					case vrule == 'isalpha' && 
						( fieldVal.search(/^[a-zA-Z]+$/i) < 0 ):
						
						$(this).attr('data-verror','Must be alpha characters only');
						return true; // include this element in exception list
					break;
					
					case vrule == 'isalphanumeric' && 
						( fieldVal.search(/^[a-zA-Z0-9]+$/) < 0 ):
						
						$(this).attr('data-verror','Must be letters and numbers only');
						return true; // include this element in exception list
					break;
					
					case vrule == 'isemail' && 
						( fieldVal.search(/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i) < 0 ):
						
						$(this).attr('data-verror','Must not a valid email format');
						return true; // include this element in exception list
					break;
					
					case vrule == 'matchregex' && 
						( fieldVal.search(vregex) < 0 ):
						
						$(this).attr('data-verror','Must match the pattern given');
						return true; // include this element in exception list
					break;
					
					default:
						return false; // any unsupported rules are ignored and excluded
					break;
				}
			 }); // return 
		
		
		
	} // fn.getInvalidFields	
		
		
		
	
	
	
})(jQuery);


