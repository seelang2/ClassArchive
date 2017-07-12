<?php
require('mysql-init.php'); // application init


?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<style type="text/css">
	body {
		font-family: Verdana, Arial, sans-serif;
	}

	form label {
		display: block;
		margin-bottom: 0.5em;
	}

	label span, label input { display: inline-block; }

	label span { width: 125px; }
	</style>
</head>
<body>
<?php

if (empty($_POST)) {
	// display blank form
?>
	<form action="insert.php" method="post">
		<label>
			<span>First Name</span>
			<input name="firstname" />
		</label>

		<label>
			<span>Last Name</span>
			<input name="lastname" />
		</label>

		<label>
			<span>Company</span>
			<input name="company" />
		</label>

		<label>
			<span>Phone</span>
			<input name="phone" />
		</label>

		<label>
			<span>Email</span>
			<input name="email" />
		</label>

		<div><input type="submit" /></div>

	</form>
<?php
} else {
	// save form data
	// get form data and sanitize
	// ALWAYS REMEMBER TO SANITIZE USER INPUT BEFORE USING IT IN A QUERY!
	$firstname = $db->real_escape_string($_POST['firstname']);
	$lastname = $db->real_escape_string($_POST['lastname']);
	$email = $db->real_escape_string($_POST['email']);
	$phone = $db->real_escape_string($_POST['phone']);
	$company = $db->real_escape_string($_POST['company']);

	// build query
	$query = 'INSERT INTO contacts SET ' .
		"firstname = '$firstname', " . 
		"lastname = '$lastname', " . 
		"email = '$email', " . 
		"phone = '$phone', " . 
		"company = '$company' ";

	// send query to database
	$result = $db->query($query);

	// check result
	if (!$result) {
		// query error
		echo '<p>Query error. Query: ' . $query . '</p>';
	} else {
		// success
		echo '<p>The record has been saved.</p>';
	}

} // if $_POST
?>
</body>
</html>