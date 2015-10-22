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
		<tbody id="contactitems"></tbody>
	</table>
</div>

<script type="text/javascript" src="jquery-1.11.3.min.js"></script>
<script type="text/javascript">


$(document).ready(function() {
// initalize table structure
var $tbodyElem = $('#contactitems');
var $tbodyParent = $tbodyElem.parent(); // get ref to table

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

// fetch data from server
$.ajax({
	url:		'getcontacts.php',
	type:		'get',
	dataType:	'json',
	cache:		false
}).then(updateTable, errorHandler);
	


}); // document.ready




</script>
</body>
</html>