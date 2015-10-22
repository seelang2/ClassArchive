<?php

require('userlib.php');
require('config.php');

// connect to DB server and select database
try {
	$db = new PDO($dsn,$user,$password);
} catch (PDOException $error) {
	// always put something in the catch section to gracefully
	// recover from the error, provide user feedback, etc.
	
	exit('<p>Error connecting to database.</p>'); // halt execution of page
}

// set up multipurpose page
include('header.php');

// is form data present?
if ( !empty($_POST) ) {
	// process form data
	
	echo '<pre>'.print_r($_POST, true).'</pre>';// good for troubleshooting
	
	// data validation before saving to database goes here
	
	// build query
	// ALWAYS SANITIZE DATA BEFORE USING IN A QUERY!
	$query = "INSERT INTO attendees SET ".
				"firstname = ". $db->quote($_POST['firstname']) .", ".
				"lastname = ". $db->quote($_POST['lastname']) .", ".
				"address1 = ". $db->quote($_POST['address1']) .", ".
				"address2 = ". $db->quote($_POST['address2']) .", ".
				"email = ". $db->quote($_POST['email']) .", ".
				"city = ". $db->quote($_POST['city']) .", ".
				"state = ". $db->quote($_POST['state']) .", ".
				"zip = ". $db->quote($_POST['zip']) ." ";
	
	echo $query; //exit();
	
	// send query to server
	$results = $db->query($query);
	
	// check response
	if ($results === false) {
		// query error
		echo '<p>There was an error in the query.<br />' . $query . '</p>';
	} else {
		// process result set, if any
		// no result set in an INSERT, so display positive feedback
		echo '<p>You are now registered!</p>';
		
	} // if $results
	
} else {
	// display blank form
?>
	<form action="register.php" method="post">
		<label>
			<span>First Name</span>
			<input name="firstname" />
		</label>
		<label>
			<span>Last Name</span>
			<input name="lastname" />
		</label>
		<label>
			<span>Email</span>
			<input name="email" />
		</label>
		<label>
			<span>Address 1</span>
			<input name="address1" />
		</label>
		<label>
			<span>Address 2</span>
			<input name="address2" />
		</label>
		<label>
			<span>City</span>
			<input name="city" />
		</label>
		<label>
			<span>State</span>
			<input name="state" />
		</label>
		<label>
			<span>Zip</span>
			<input name="zip" />
		</label>
		<div>
			<input type="submit" value="Register" />
		</div>
	</form>
	
	
<?php
} // else

include('footer.php');
?>