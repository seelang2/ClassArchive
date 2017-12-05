// UI code
jQuery(document).ready(function() {

var $ = jQuery; // use $ inside function scope

var $rolecats = $('#ttp-rolecats');
var $roleSelect = $('#ttp-role');
var $catSelect = $('#ttp-categories');

// add categories to roles
$('#ttp-setcats').on('click', function(e) {
	
	var data = $catSelect.val();
	//console.log(data);
	
	var role = $roleSelect.val();
	//console.log(role);
	
	// for the currently selected role...
	// remove all current cat entries
	rcData[role] = {};
	$rolecats.empty();
	// add in current entry values
	$.each(data, function(index, termID) {
		rcData[role][termID] = termID;
		// update role cat display
		$('<div />')
			.addClass('tpp-catitem')
			.attr('data-id', termID)
			.append('<span>' + catData[termID].name + '</span>')
			.appendTo($rolecats);
	});

	// reset category select
	$catSelect.children('option').removeProp('selected');
	
	
});

// update rolecats div when a different role is selected
$roleSelect.on('change', function(e) {
	var role = $(this).val();
	
	$rolecats.empty(); 		// empty role cat display
		
	// update role cat display (only if role has data already)
	if (typeof rcData[role] != 'undefined') {
		$.each(rcData[role], function(index, termID) {
			$('<div />')
				.addClass('tpp-catitem')
				.attr('data-id', termID)
				.append('<span>' + catData[termID].name + '</span>')
				.appendTo($rolecats);
		});	
	}
	
});

// clicking a cat item in the role cat div removes it from the role
$rolecats.on('click', '.tpp-catitem', function(e) {
	var role = $roleSelect.val();
	var termID = $(this).attr('data-id');
	$(this).remove(); // remove div from role cat div
	
	delete rcData[role][termID]; // delete cat item from data
});

// handle form save
// take the rcData and convert into JSON to pass it back to the server
$('#saveform').on('submit', function(e) {
	$(this)
		.find('[name="ttp-data"]')
		.val(JSON.stringify(rcData));
});

// update rolecats div with first role displayed
var role = $roleSelect.val();
if (typeof rcData[role] != 'undefined') {
	$.each(rcData[role], function(index, termID) {
		$('<div />')
			.addClass('tpp-catitem')
			.attr('data-id', termID)
			.append('<span>' + catData[termID].name + '</span>')
			.appendTo($rolecats);
	});	
}

}); // document.ready
