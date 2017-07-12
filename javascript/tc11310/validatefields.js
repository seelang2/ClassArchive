/**
 * validatefields.js - Form validator plugin
 *
 *
 */
 (function($) {

 	// we expect a collection of form objects to process
 	$.fn.getInvalidFields = function() {

 		var $fields = $(''); // create empty collection object

 		this.each(function(i, form) {

 			var $invalidFields = 
 			$(form)
			.find(':input')
			.filter(function(index) {
				// 'this' refers to each element in the collection
				var field = this;

				var vrule = $(field).attr('data-vrule');
				var fieldVal = $(field).val();
				var minlength = $(field).attr('data-minlength');
				var maxlength = $(field).attr('data-maxlength');

				// field can't be blank (required)
				if (vrule == 'required' && fieldVal.length == 0) {
					// exception found
					$(field)
						.attr('data-verror','Field is required');
					return true; // keep element in collection
				}

				// field has minimum length
				if (vrule == 'minlength' && fieldVal.length < minlength) {
					// exception found
					$(field)
						.attr('data-verror','Min length is '+ minlength);
					return true; // keep element in collection
				}

				// field is numeric only
				if (vrule == 'numeric' && 
					(isNaN(parseFloat(fieldVal)) || !isFinite(fieldVal)) ) {
					// exception found
					$(field)
						.attr('data-verror','Must be numeric');
					return true; // keep element in collection
				}
				
				// process other rules...

				return false; // field is valid, dump it
			 }); // filter field
			
			// add invalid fields to collection
			$fields = $fields.add($invalidFields); 
 		}); // this.each

		return $fields; // return NEW collection

 	}; // getInvalidFields()

 })(jQuery);