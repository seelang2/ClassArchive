<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
</head>

<body>

<?php

$contacts = array('A'=>array('John','Doe',23),
				  'B'=>array('Jane','Smith',32),
				  'C'=>array('Alex','Trebec',57));

echo '<table><tbody>';
echo '<tr><td>'.$contacts['A'][0].
		 '</td><td>'.$contacts['A'][1].
		 '</td><td>'.$contacts['A'][2].'</td></tr>';
echo '<tr><td>'.$contacts['B'][0].
		 '</td><td>'.$contacts['B'][1].
		 '</td><td>'.$contacts['B'][2].'</td></tr>';
echo '<tr><td>'.$contacts['C'][0].
		 '</td><td>'.$contacts['C'][1].
		 '</td><td>'.$contacts['C'][2].'</td></tr>';
echo '</tbody></table>';

?>

</body>
</html>