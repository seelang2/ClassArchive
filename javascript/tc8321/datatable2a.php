<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>
	
	<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
	
	<style type="text/css">
	body {
		font-family: Verdana, Arial, sans-serif;
	}
	
	#contacttable {
		width: 800px;
		margin: auto;
	}
	</style>
</head>
<body>

<div id="contacttable">
	<table class="display">
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
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script type="text/javascript">


$(document).ready(function() {

	$('#contacttable table')
		.DataTable({
			ajax: {
				url:		"data1.json",
				dataSrc:	'data'
			},
			columns: [
				{ data: 'firstname' },
				{ data: 'lastname' },
				{ data: 'code' }
			]
		 });

}); // document.ready




</script>
</body>
</html>