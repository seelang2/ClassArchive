<!DOCTYPE html>
<html>
<head>
	<title>Sample Page</title>
	<meta charset="UTF-8" />
	
</head>
<body>

<?php

//$dayNum = date('j');
$dayNum = 13;

switch(true) {
	case $dayNum == 1 || $dayNum == 21 || $dayNum == 31:
		$ordinal = 'st';
	break;
	
	case $dayNum == 2 || $dayNum == 22:
		$ordinal = 'nd';
	break;
	
	case $dayNum == 3 || $dayNum == 23:
		$ordinal = 'rd';
	break;
	
	default:
		$ordinal = 'th';
	break;
	
}

echo '<p>The day is the ' . $dayNum . $ordinal . '</p>';

?>

</body>
</html>