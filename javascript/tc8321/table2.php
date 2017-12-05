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
		<tbody id="contactitems">
			<?php
			$db = new PDO('mysql:dbname=names;host=localhost','root','xampp');
			$results = $db->query('SELECT * from names');
			while($row = $results->fetch(PDO::FETCH_ASSOC)) {
				echo '<tr id="'. $row['id'] .'">' .
						'<td>' . $row['firstname'] . '</td>' .
						'<td>' . $row['lastname'] . '</td>' .
						'<td>' . $row['code'] . '</td>' .
					 '</tr>';
			}
			?>
		</tbody>
	</table>
</div>

<script type="text/javascript" src="jquery-1.11.3.min.js"></script>
<script type="text/javascript">


$(document).ready(function() {


}); // document.ready




</script>
</body>
</html>