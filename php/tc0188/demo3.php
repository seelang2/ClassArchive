<?php


$dbcnx = @mysql_connect('localhost', 'root', 'portable');

if (!dbcnx) { 
	echo '<p>Unable to connect to the database server at this time.</p>';
	exit();
}


if (!@mysql_select_db('demo1')) {
	exit('<p>Unable to locate the database at this time.</p>');
}

// echo '<p>Successfully connected to the database!</p>';


$me = $_SERVER['PHP_SELF'];

$validated = true;

if (isset($_POST['name'])) {
	// validate data and process
	
	if (isset($_POST['name']) && $_POST['name'] != '') $name = $_POST['name']; else $validated = false;
	if (isset($_POST['email']) && $_POST['email'] != '') $email = $_POST['email']; else $validated = false;
	if (isset($_POST['password']) && $_POST['password'] != '') $password = $_POST['password']; else $validated = false;
	
	if (!$validated) {
		// display error message and allow user to go back
		echo "<p><strong>Error: </strong>One or more fields in the form is blank. None of the form fields may be blank."
			. " Please go back and enter in all required information.</p>";
			
	} else {
		// NOW process form data
		$query = "INSERT INTO users SET name = '$name', email = '$email', password = '$password'";
		
		$result = @mysql_query($query);
		
		if (!$result) exit('<p><strong>Error: </strong>Error performing query: ' . mysql_error() . "<br />Query: $query" . '</p>');
		
		echo "<p>Record successfully added to database table.</p>";
	}
} else {
	// display data entry form

?>

<form action="<?php echo $me; ?>" method="post">
	<p>
	First Name: <input type="text" name="name" /><br />
	Email: <input type="text" name="email" maxlength="60" /><br />
	Password: <input type="password" name="password" /><br />
	<input type="submit" value="Enter New User" />
	</p>
</form>

<?php

}

?>

<p><a href="<?php echo $me; ?>">Make new entry</a></p>
