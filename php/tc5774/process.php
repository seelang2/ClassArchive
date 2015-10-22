<!DOCTYPE html>
<html>
<head>
	<title>Sample Page</title>
	<meta charset="UTF-8" />
	
</head>
<body>

<?php

if ($_GET['havekids']) {

	switch(true) {
		case $_GET['age'] < 5:
			echo '<p>Your kid is not old enough for school.</p>';
		break;
	
		case $_GET['age'] > 4 && $_GET['age'] < 13:
			echo '<p>Your kid is in grade school.</p>';
		break;
	
		case $_GET['age'] > 12 && $_GET['age'] < 18:
			echo '<p>Your kid is in high school.</p>';
		break;
	
		case $_GET['age'] > 17:
			echo '<p>Your kid is in higher education.</p>';
		break;
		
		default:
			echo '<p>Error detected.</p>';
		break;
	} // switch

} else {
	echo '<p>Go make some kids and come back later.</p>';
} // if havekids


?>

</body>
</html>