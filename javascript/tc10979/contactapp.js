// set up Immediately-invoked function expression (IIFE) as a namespace
(function(App) {
 	
 	// variables and functions created in this scope are inaccessible from the outside
 	var data = {}; // generic data repository

 	/*
 		status option values
 		For ease of use, the select values are named after the data field
 		to which they belong
 	*/
 	data.select = {};
 	data.select.status = ['Inactive','Active'];

 	App.start = function() {
 		console.log(data);

 		// set up form submit handler
 		$('#addcontactform form').on('submit', App.saveContact);

 		// set up search box functionality
 		data.searchResultsElem = $('#search span > div');
 		$('#search input').on('input', App.lookup);

 		data.searchResultsElem
 			.on('mouseover mouseout', '[data-index]', function(e) {
 				$(this).toggleClass('active');
 			 })
 			.on('click', '[data-index]', function(e) {
 				var id = $(this).attr('data-index');
 				
 				App.getContacts(id);

 				data.searchResultsElem
 					.hide()
 					.prev()
 					.val($(this).html());
 			 })
 			.parent()		// traverse up to parent element
 			.on('keyup', App.searchKeyHandler);

 		// add contact button control handler
 		$('#contacts').on('click', 'button', App.contactControlsHandler);

 		// load html templates
 		tracker = getTracker(1, App.getContacts);

 		$.ajax({
 			url: 				'template-contactitem.html',
 			method: 		'get',
 			dataType: 	'html'
 		}).done(function(content) {
 			data.contactItemTemplate = $(content); // store template in data object
 			//console.log(data.contactItemTemplate);

 			tracker.notify(); // update tracker
 		});

 		//App.getContacts(); // get contact list from server
 	}; // App.start

 	App.getContacts = function(id) {

 		var url = 'contacts.php?action=view';
 		if (typeof id != "undefined") {
 			url = url + '&id=' + id;
 		}

 		// do ajax call to get contacts
 		$.ajax({
 			url: 				url,
 			method: 		'get',
 			dataType: 	'json',
 			success: 		App.updateContactList
 		}).done(function(response) {
 			console.log('Ajax Deferred object done handler');
 		});

 	}; // App.getContacts

 	App.updateContactList = function(rData) {
 		console.log('Ajax success.');

 		// validate response from server
 		if (rData.status == 0) {
 			// request failed, nothing to do
 			alert('Request failed No soup for you! *snap*');
 			return; // bail out of handler as there's nothing further to be done
 		}

 		var $contactsElem = $('#contacts');

 		$contactsElem.empty();

 		if (rData.requestData.length == 0) {
 			$contactsElem.append('<p>No records found.</p>');
 			return; // bail out of function
 		}

 		$.each(rData.requestData, function(i, contact) {
 			$contactsElem.append(App.mergeContactTemplate(contact));
 		}); // each contact

 	}; // App.updateContactList

 	App.mergeContactTemplate = function(contact) {
		// merge data with contactitem template and return merged object
		return data.contactItemTemplate
			.clone()													// make copy of template
			.data('contactData', contact) 		// store contact record data with element
			.find('[data-fieldname]')
			.each(function(index, field) {
				// populate template with data values
				var fieldName = $(field).attr('data-fieldname');
				
				// is this field a select?
				if (typeof data.select[fieldName] == "undefined") {
					// not a select so just use value as is
					$(field).html(contact[fieldName]);
				} else {
					// use value from the select option list
					$(field).html(data.select[fieldName][contact[fieldName]]);
				}

			})
			.end()
			.attr('data-index', contact.id);
			

 	}; // App.mergeContactTemplate

 	App.saveContact = function(e) {
 		e.preventDefault(); // prevent form from submitting

 		var $fields = $(this).find(':input'); // get input fields

 		// validate data
 		App.validateFormData($fields);
 		// currently we're ignoring validation

 		// send ajax request
 		$.ajax({
 			url: 				'contacts.php?action=save',
 			method: 		'post',
 			dataType: 	'json',
 			data: 			$fields.serialize(),
 			success: 		App.returnFromSave,
 			error: 			App.error
 		});

 	}; // App.saveContact

 	App.error = function(req, status, message) {
 		console.log(req);
 		console.log(status);
 		console.log(message);

		alert('Server response is not valid');
		return; // bail out of handler as there's nothing further to be done
 	}

 	App.validateFormData = function($fields) {
 		// validate form fields, yadda yadda yadda
 	}; // App.validateFormData

 	App.returnFromSave = function(response){
 		console.log('returnFromSave');
 		console.log(response);

 		// check to make sure response was not malformed
 		if (typeof response.status == "undefined") {
 			// data is not right format
 			alert('Response is not the correct format');
 			return; // bail out of handler as there's nothing further to be done
 		}

 		// validate response from server
 		if (response.status == 0) {
 			// request failed, nothing to do
 			alert('Request failed No soup for you! *snap*');
 			return; // bail out of handler as there's nothing further to be done
 		}

 		// request was ok, do stuff, provide feedback, etc.
 		console.log(response);
 		alert('The record has been saved.');
 		App.getContacts(); // reload contact list

 	}; // App.returnFromSave

 	App.lookup = function(e) {
 		var q = $(this).val();

 		if (q.length < 1) { // minimum chars
 			data.searchResultsElem.hide();
 			return;
 		}


 		$.ajax({
 			url: 				'contacts.php?action=search&q=' + q,
 			method: 		'get',
 			dataType: 	'json',
 			cache: 			false
 		})
 			.done(App.updateSearchResults)
 			.fail(function() {}); // error handler

 	}; // App.lookup

 	App.updateSearchResults = function(results) {
 		if (typeof results.status == "undefined" || results.status == 0) {
 			alert('Server error getting search results.');
 			return;
 		}

 		data.searchResultsElem.empty();

 		if (results.requestData.length == 0) {
 			data.searchResultsElem
 				.hide()
 				.prev()
 				.removeAttr('data-resultid');
 			return;
 		}

 		$.each(results.requestData, function(i, item) {
 			$('<div />')
 				.append(item.firstname + ' ' + item.lastname)
 				.attr('data-index', item.id)
 				.appendTo(data.searchResultsElem);
 		});

 		data.searchResultsElem.show();

 	}; // App.updateSearchResults

 	App.searchKeyHandler = function(e) {
		//console.log(e.keyCode);

		switch(e.keyCode) {
			case 38: // up arrow
				var $target = 
				data.searchResultsElem
					.children('.active');

				if ($target.length == 0) {
					break; // nothing to do
				}

				if ( !$target.is(data.searchResultsElem.children(':first-child')) ) {
					
					var $newTarget=
					$target
						.removeClass('active')
						.prev()
						.addClass('active');

					data.searchResultsElem
						.prev()
						.attr('data-resultid', $newTarget.attr('data-index'));

					var resultText = $newTarget.html();
				
	 				data.searchResultsElem
	 					.prev()
	 					.val(resultText);
				}
			break; // up arrow

			case 40: // down arrow
				var $target = 
				data.searchResultsElem
					.children('.active');

				// if nobody is active, set the first result as active
				if ($target.length == 0) {
					var $newTarget = 
					data.searchResultsElem
						.children(':first-child')
						.addClass('active');

				data.searchResultsElem
					.prev()
					.attr('data-resultid', $newTarget.attr('data-index'));
					
					var resultText =
					$newTarget.html();

 				data.searchResultsElem
 					.prev()
 					.val(resultText);
				} else{
					if ( !$target.is(data.searchResultsElem.children(':last-child')) ) {
						
						var $newTarget = 
						$target
							.removeClass('active')
							.next()
							.addClass('active');

					data.searchResultsElem
						.prev()
						.attr('data-resultid', $newTarget.attr('data-index'));
					
						var resultText = 
						$newTarget.html();
 				
	 				data.searchResultsElem
	 					.prev()
	 					.val(resultText);
					}
				}
			break; // down arrow

			case 13: // enter
				var id = data.searchResultsElem.prev().attr('data-resultid');
				if (typeof id == "undefined") break;

				App.getContacts(id);

 				data.searchResultsElem
 					.hide()

			break; // enter
		} // switch
 	}; // App.searchKeyHandler

 	App.contactControlsHandler = function(e) {

 		switch(true) {
 			case $(this).hasClass('btnEdit'): // edit 
 				App.editInPlace($(this).closest('.contactitem'));
 			break; // edit

 			case $(this).hasClass('btnCancel'): // cancel 
 				App.revertToReadOnly($(this).closest('.contactitem'));
 			break; // cancel

 			case $(this).hasClass('btnSave'): // save 

 			break; // save

 			case $(this).hasClass('btnDelete'): // delete 

 			break; // delete

 		} // switch true

 	}; // App.contactControlsHandler

 	App.editInPlace = function($target) {
 		//console.log($target);

 		// get data associated with contactitem element
 		var contact = $target.data('contactData');
 		//console.log(contact);

 		// replace data field spans with inputs and selects
 		$target
 			.find('[data-fieldname]')
 			.each(function(i, field) {
 				// get field name
 				var fieldName = $(field).attr('data-fieldname');
 				
 				if (typeof data.select[fieldName] == "undefined") {
	 				// create input field
	 				$('<input />')
	 					.attr('name', fieldName)
	 					.val(contact[fieldName])
	 					.insertBefore(field)
	 					.next()
	 					.remove();

 				} else {
	 				// create select field
	 				var $selectElem = 
	 				$('<select />')
	 					.attr('name', fieldName);

	 				// loop through option values
	 				$.each(data.select[fieldName], function(value, label) {
	 					var $optionElem = 
	 					$('<option />')
	 						.attr('value', value)
	 						.append(label)
	 						.appendTo($selectElem);

	 					if (value == contact[fieldName])
	 						$optionElem.prop('selected', true);
	 				}); // each option

	 				$selectElem
	 					.insertBefore(field)
	 					.next()
	 					.remove();

 				} // if select


 			 }) // each field
 			.end() // revert back to target
 			.find('.btnEdit')
 			.toggleClass('btnEdit btnSave')
 			.html('Save')
 			.end()
 			.find('.btnDelete')
 			.toggleClass('btnDelete btnCancel')
 			.html('Cancel')
 			.end();

 	}; // App.editInPlace

 	App.revertToReadOnly = function($target) {
 		var contact = $target.data('contactData');

 		App.mergeContactTemplate(contact)
 			.insertBefore($target);

 		$target.remove();

 	} // App.revertToReadOnly

})(window.App = window.App || {});

function otherstuff() {
	console.log('otherstuff');
}

// Note that the document ready handler is simply an event listener attachment function, much like addEventListener(), but specific to the DOM 'ready' event
$(document).ready(App.start); // launch App.start on DOM ready
$(document).ready(otherstuff); 

