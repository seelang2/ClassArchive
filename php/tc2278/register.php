<?php

// connect to database server
$dblnk = @mysql_connect('localhost','root','xampp');
if (!$dblnk) { exit('Error connecting to database server.'); }

// select database
$dbh = @mysql_select_db('tc2278');
if (!$dbh) { exit('Error selecting database.'); }


if (empty($_POST)) {
	// display form
?>
	<h1>New User Registration Form</h1>
    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    	<div><label for="firstname">First Name:</label><input type="text" name="firstname" /></div>
    	<div><label for="lastname">Last Name:</label><input type="text" name="lastname" /></div>
    	<div><label for="email">Email:</label><input type="text" name="email" /></div>
    	<div><label for="login">Login:</label><input type="text" name="login" /></div>
    	<div><label for="password">Password:</label><input type="text" name="password" /></div>
        <div><input type="submit" value="Sign Me Up" /></div>
    </form>
<?php
} else {
	// process form data
	
	$form_validated = true;
	$errmessage = '';
	
	$firstname = mysql_escape_string($_POST['firstname']);
	// field can't be blank
	if (empty($firstname)) {
		$form_validated = false;
		$errmessage .= '<br />First name cannot be blank.';
	}
	
	$lastname = mysql_escape_string($_POST['lastname']);
	// field can't be blank
	if (empty($lastname)) {
		$form_validated = false;
		$errmessage .= '<br />Last name cannot be blank.';
	}
	
	$email = mysql_escape_string($_POST['email']);
	// field can't be blank
	if (empty($email)) {
		$form_validated = false;
		$errmessage .= '<br />Email cannot be blank.';
	}
	
	$login = mysql_escape_string($_POST['login']);
	// field can't be blank
	if (empty($login)) {
		$form_validated = false;
		$errmessage .= '<br />Login cannot be blank.';
	}
	
	$password = mysql_escape_string($_POST['password']);
	// field can't be blank
	if (empty($password)) {
		$form_validated = false;
		$errmessage .= '<br />Password cannot be blank.';
	}
	// password must be between 4 and 15 characters
	if (strlen($password) < 4 || strlen($password) > 15) {
		$form_validated = false;
		$errmessage .= '<br />Password must be between 4 and 15 characters.';
	}
	
	// check validation
	if ($form_validated) {
		// build query
		$query = 'INSERT INTO users SET ' .
				 "firstname = '" . $firstname . "', " .
				 'lastname = \'' . $lastname. '\', ' .
				 "email = '$email', " .
				 "login = '$login', " .
				 "password = '$password' ";
		
		//$query = "INSERT INTO users SET firstname = '$firstname', lastname = '$lastname', email = '$email', login = '$login', password = '$password'";
		
		// send query to db server
		$result = @mysql_query($query);
		
		// check result
		if (!$result) {
			// error encountered
			echo '<p>There was an error with the query:<br />' . $query . '</p>';
		} else {
			// success
			?>
				<h1>Registration Complete</h1>
				<p>Congratulations, you are now registered, yadda yadda yadda.</p>
			<?php
		}
		
	} else {
		// display error messages
		echo '<p>The following problems were found: ' . $errmessage . 
			 '<br />Please go back and correct them.</p>';
	
	} // validated
	
} // if empty POST

?>