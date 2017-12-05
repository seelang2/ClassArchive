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

switch($dayNum) {
	case 1: case 21: case 31:
		$ordinal = 'st';
	break;
	
	case 2: case 22:
		$ordinal = 'nd';
	break;
	
	case 3: case 23:
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