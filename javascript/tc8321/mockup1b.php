<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>
	
	<link rel="stylesheet" type="text/css" href="jquery-ui-1.11.4/jquery-ui.min.css"/>
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
		<tbody id="contactitems">
			<?php
			$db = new PDO('mysql:dbname=names;host=localhost','root','xampp');
			$results = $db->query('SELECT * from names');
			while($row = $results->fetch(PDO::FETCH_ASSOC)) {
				echo '<tr id="'. $row['id'] .'">' .
						'<td>' . $row['firstname'] . '</td>' .
						'<td>' . $row['lastname'] . '</td>' .
						'<td><a href="#" class="clickable">' . $row['code'] . '</a></td>' .
					 '</tr>';
			}
			?>
		</tbody>
	</table>
</div>

<script type="text/javascript" src="jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="jquery-ui-1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script type="text/javascript">


$(document).ready(function() {

	var showDialog = function(e) {
		//if (conditionIsNotMet) return;
		
		e.preventDefault();
		
		// take code from link text and put in dialog box
		$dialog1.html('<p>Code: ' + $(this).text() + '</p>');
		
		// now show dialog box
		$dialog1.dialog();
		
	};
	 
	$('#contacttable table').DataTable();
	
	var $dialog1 =
	$('<div />');
		
	$('#contacttable')
		.on('click', '.clickable', showDialog);

}); // document.ready




</script>
</body>
</html>