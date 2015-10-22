<?php



?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title><?php echo 'Today is '. date('l, F jS, Y'); ?></title>
	
</head>
<body>

	<h1>Welcome, <?php echo $_GET['firstname'] . ' ' . $_GET['lastname']; ?>!</h1>


</body>
</html>