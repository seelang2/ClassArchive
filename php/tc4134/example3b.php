<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
</head>

<body>

<?php

$contacts = array('A'=>array('John','Doe',23,'jdoe@email.com'),
				  'B'=>array('Jane','Smith',32,'jane@smith.com'),
				  'C'=>array('Alex','Trebec',57,'thatshow@nbc5.com'));

echo '<table><tbody>';
// loop through rows and create them
foreach($contacts as $row ) {
	echo '<tr>';
	// now loop through each column
	foreach($row as $column) {
		echo '<td>'.$column.'</td>';	
	}
	echo '</tr>';
} // foreach row

echo '</tbody></table>';

?>

</body>
</html>