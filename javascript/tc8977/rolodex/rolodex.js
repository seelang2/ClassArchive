// use IIFE to create namespace
(function(App) {
	// define private data
	var data = {};

	// define public App methods here
	
	// App startup - connect to dom ready handler
	App.start = function() {
		// initialize values
		data.ulElem = $('#set1');
		data.extraElem = $('#extra');

		// set up base handlers
		$('#appwrapper')
			.on('click', 'button, [type=button]', App.buttonHandler);

		// load HTML templates
		App.loadTemplates();

	}; // App.start

	App.loadTemplates = function() {
		// use deferred object (promises) to load templates asynchronously
		var templateLoader = $.Deferred();
		templateLoader.status = 0;
		templateLoader.numTemplates = 2; // 2 templates to load
		
		// add progress handler to track template loading status
		templateLoader.progress(function() {
			// update status with loaded template
			templateLoader.status ++; 
			console.log('Loaded template status:',templateLoader.status);

			if (templateLoader.status == templateLoader.numTemplates) {
				// all templates have loaded so resolve the promise
				templateLoader.resolve();
			}
		});

		// when the loader finishes then continue App 
		templateLoader.done(function() {
			console.log('all templates loaded.');
			App.getContactData();
		})

		// load templates into a jQuery collection object
		// template 1
		$.ajax({
			url: 		'template-contact.html',
			method: 	'get',
			dataType: 	'html'
		}).done(function(response) {
			data.contactTemplate = $('<div />').html(response).children();
			templateLoader.notify(); // update template counter
		});
		// template 2
		$.ajax({
			url: 		'template-addcontact.html',
			method: 	'get',
			dataType: 	'html'
		}).done(function(response) {
			data.addContactTemplate = $('<div />').html(response).children();
			templateLoader.notify(); // update template counter
		});


	}; // App.loadTemplates

	App.getContactData = function() {
		// get contact data from server
		$.ajax({
			url: 		'./api/contacts',
			method: 	'get',
			dataType: 	'json'
		}).done(App.updateView);

	}; // App.getContactData

	App.updateView = function(contactList) {
		var targetParent = data.ulElem.parent();

		data.ulElem
			.detach()
			.empty();

		// for each contact
		$.each(contactList, function(key, contact) {

			// calculate age
			var today = new Date();
			var dob = new Date(contact.dob);
			var age = parseInt((today - dob) / 31557600000); //  / 1000 / (60*60*24*365.25)

			// add age data to contact to be included in field merge
			contact.age = age;

			data.contactTemplate
				.clone()				// copy template
				.attr('data-key', key)	// add key to template top
				.find('[data-field]')
				.each(function(i, field) {
					// merge field into element
					// get field name from element
					var fieldName = $(field).attr('data-field');
					$(field).html(contact[fieldName]);
				 }) 
				.end()		// revert back to template
				.appendTo(data.ulElem);
		});

		data.ulElem
			.accordionize()
			.appendTo(targetParent);

	}; // App.updateView

	App.buttonHandler = function(evt) {
		evt.preventDefault(); // preven detault action on buttons

		var $button = $(this);

		switch(true) {
			case $button.hasClass('btnAdd'):
				// add new contact
				App.addNewContact();
			break;

			case $button.hasClass('btnSave'):
				// save contact
				App.saveContact($button);
			break;

			case $button.hasClass('btnDelete'):
				// delete contact
				var key = 
				$button
					.closest('.contactitem')
					.attr('data-key');

				App.deleteContact(key);
			break;

		} // switch

	}; // App.buttonHandler

	App.deleteContact = function(key) {
		// insert bailout code
		if (!confirm('Are you sure you want to delete this contact?')) return;

		$.ajax({
			url: 		'./api/contacts/' + key,
			method: 	'delete',
			dataType: 	'json',
		}).done(function(response,statusText,req) {
			if (req.status != 204) {
				// something went wrong
				alert('The record was not deleted. Please try again later.');
				return; // bail out of handler
			}
			// success
			//if (typeof key != 'undefined') console.log(key);
			$('[data-key='+ key +']').remove(); // delete contact LI
			alert('The contact has been deleted.');

		});

	}; // App.deleteContact

	App.addNewContact = function() {
		data.extraElem.empty();

		data.addContactTemplate
			.clone()
			.appendTo(data.extraElem);

	}; // App.addNewContact

	App.saveContact = function($button) {

		var data = 
		$button
			.closest('.contactitem')	// move up to FORM
			.find(':input')				// get data fields
			.serialize();				// convert to query string

		// save form data
		$.ajax({
			url: 		'./api/contacts',
			method: 	'post',
			dataType: 	'json',
			data: 		data
		}).done(function(response,statusText,req) {
			// done returns same parameters as success handler
			console.log('response:',response,'statusText:',statusText,'req:',req);
			// clear extra container
			$('#extra').empty();
			// provide user feedback
			if (req.status != 201) {
				// something went wrong
				alert('The record was not saved. Please try again later.');
				return; // bail out of handler
			}
			// success
			alert('The contact has been saved.');

			App.getContactData(); // refresh data
		});

	}

})(window.App = window.App || {});

// start app on DOM ready
$(document).ready(App.start); // document.ready

