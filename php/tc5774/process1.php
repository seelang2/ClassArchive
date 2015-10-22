<!DOCTYPE html>
<html>
<head>
	<title>Sample Page</title>
	<meta charset="UTF-8" />
	
</head>
<body>

<?php

if ($_GET['havekids']) {

	switch($_GET['age']) {
		case 1:
		case 2:
		case 3:
		case 4:
			// do stuff
		break;
		
		case 5:
		case 6:
		case 7:
		case 8:
		case 9:
		case 10:
		case 11:
		case 12:
			// do stuff
		break;
		
		case 13:
			// do stuff
		break;
		
		
		default:
			echo '<p>Error detected.</p>';
		break;
	}

}


?>

</body>
</html>