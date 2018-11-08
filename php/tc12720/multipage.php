<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Demo</title>

	<style type="text/css">
	body, input, select, button {
		font-family: Arial, Verdana, sans-serif;
		font-size: 18px;
	}

	form label {
		display: block;
		margin-bottom: 0.5em;
	}

	form label span,
	form label input {
		display: inline-block;
	}

	form label span { width: 150px; }
	</style>
</head>
<body>

<?php

// is form data present?
if (empty($_POST)) {
	// display form
?>

<form action="multipage.php" method="post">
	<label>
		<span>First Name:</span>
		<input name="firstname" />
	</label>
	<label>
		<span>Last Name:</span>
		<input name="lastname" />
	</label>
	<div><input type="submit" /></div>
</form>

<?php
} else {
	// process form data
	echo '<p>Welcome, '.$_POST['firstname'].' '.$_POST['lastname'].'!</p>';
}

?>





</body>
</html>