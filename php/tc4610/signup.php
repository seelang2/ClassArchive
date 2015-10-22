<?php
require('config.php');
include('header.php');

?>

<?php
if (empty($_POST)) {
	// display form	
	?>
    <h2>User Sign Up</h2>
    
    <form action="signup.php" method="post">
    <label>
    	Full Name: 
        <input type="text" name="fullname" />
    </label>
    <label>
    	Email: 
        <input type="text" name="email" />
    </label>
    <label>
    	Password: 
        <input type="text" name="password" />
    </label>
    <label>
    	<input type="submit" value="Register Now" />
    </label>
    </form>
    
    <?php
} else {
	// process form
	
	// sanitize/validate data
	$fullname = escape($_POST['fullname']);
	$email = escape($_POST['email']);
	$password = escape($_POST['password']);
	
	// set up validation rules
	$validated = true; // assume form data is valid
	$errors = ''; // variable to hold error messages
	
	// fullname can't be blank
	if (is_blank($fullname)) {
		$validated = false; // invalidating form data
		$errors .= '<br />Full name cannot be blank.';
	}
	
	// password must be 6 to 15 characters
	if (between($password, 6, 15)) {
		$validated = false;
		$errors .= '<br />Password must be from 6 to 15 characters long.';
	}
	
	// check email format
	if (preg_match('/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i', $email) == 0) {
		$validated = false;
		$errors .= '<br />Email address appears to be invalid.';
	}
	
	if (!$validated) {
		echo '<p>The following errors were found:'.$errors.'<br />Please go back and correct these errors.</p>';
	} else {
		$password = sha1($password . $password_salt); // hash the password using sha1
		
		// build query
		/*
		$query = "INSERT INTO users SET " .
				 "fullname = '{$_POST['fullname']}', " . 
				 "email = '{$_POST['email']}', " .
				 "password = '{$_POST['password']}' ";
		*/
		$query = "INSERT INTO users " .
				 "(`fullname`, `email`, `password`) " .
				 "VALUES " .
				 "('$fullname', '$email', '$password') ";
		//echo $query;
		
		// send query to server
		$result = @mysql_query($query);
		
		// check result
		if (!$result) {
			// error processing query
			echo '<p>Query error. No soup for you! *snap*<br />Query: ' . $query . '</p>';
		} else {
			// query successfull
			echo '<p>You are now registered and may sign in.</p>';
			
		}
	} // if validated
} // if empty $_POST
?>

<?php include('footer.php'); ?>