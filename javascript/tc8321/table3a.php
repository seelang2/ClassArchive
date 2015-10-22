<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>
	
	<style type="text/css">
	body {
		font-family: Verdana, Arial, sans-serif;
	}
	
	table { border-collapse: collapse; }
	table, th, td { border: 1px solid #7a7a7a; }
	th, td { padding: 0.5em 1em; }
	
	#contacttable {
		width: 800px;
		margin: auto;
	}
	</style>
</head>
<body>

<div id="contacttable">
	<table>
		<thead>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Office Code</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th colspan="3">
					<button class="previous">Prev</button>
					<button class="next">Next</button>
				</th>
			</tr>
		</tfoot>
		<tbody id="contactitems"></tbody>
	</table>
</div>

<script type="text/javascript" src="jquery-1.11.3.min.js"></script>
<script type="text/javascript">


$(document).ready(function() {

var init = function() {
	// initalize table structure
	$tbodyElem = $('#contactitems');
	$tbodyParent = $tbodyElem.parent(); // get ref to table
	
	// set up pagination buttons
	$('#contacttable').on('click','button', buttonHandler);
	
	// fetch data from server
	getData();
	
}; // init;

var buttonHandler = function(e) {
	
	switch(true) {
		case $(this).hasClass('previous'):
			// move back a page
			// if this is already the first page do nothing
			if (currentPage == 1) return;
			
			getData( (--currentPage - 1) * itemsPerPage, itemsPerPage);
			
		break;
		
		case $(this).hasClass('next'):
			
			getData( (++currentPage - 1) * itemsPerPage, itemsPerPage);
		
		break;
		
	}; // switch
	
	
	
}; // buttonHandler

var getData = function(o, r) {
	if (typeof o == 'undefined') o = 0;
	if (typeof r == 'undefined') r = 10;

	$.ajax({
		url:		'getcontacts1.php?range='+ r +'&offset='+ o,
		type:		'get',
		dataType:	'json',
		cache:		false
	}).then(updateTable, errorHandler);
		
}; // getData

var updateTable = function(data) {
	// clear out and temporarily detach tbody from table
	$tbodyElem
		.empty()
		.detach();

	// loop through data and update tbody
	$.each(
		data,
		function(index, contact) {
			
			$('<tr />')
				.append('<td>' + contact.firstname + '</td>')
				.append('<td>' + contact.lastname + '</td>')
				.append('<td>' + contact.code + '</td>')
				.appendTo($tbodyElem);
			
		}
	);

	// reattach updated tbody to table
	$tbodyElem.appendTo($tbodyParent);
}; // updateTable

var errorHandler = function() {
	alert('An error has occurred. Please try again.');
}; // errorHandler




// set up global (inside namespace) vars
var $tbodyElem;
var $tbodyParent;
var currentPage = 1;
var itemsPerPage = 10;

// start app
init();

}); // document.ready




</script>
</body>
</html>