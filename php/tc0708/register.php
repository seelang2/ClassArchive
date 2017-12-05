<?php 
require 'config.php';

include 'header.php';

if (!empty($_POST['butSubmit'])) {
	// process form data
	
	$validated = true;
	
	if (!empty($_POST['fullname'])) { $fullname = escape($_POST['fullname']); } else { $validated = false; }
	if (!empty($_POST['email'])) { $email = escape($_POST['email']); } else { $validated = false; }
	if (!empty($_POST['password'])) { $password = escape($_POST['password']); } else { $validated = false; }
	if (!empty($_POST['dob'])) { $dob = escape($_POST['dob']); } else { $validated = false; }
	
	if ($validated) {
		// add new record to db
		
		$query = "INSERT INTO profiles SET " . 
			"fullname = '$fullname', " .
			"email = '$email', " .
			"password = '$password', " .
			"dob = '$dob' ";
		
		if (!$result = mysql_query($query)) {
			// error
			echo "<p>Error performing query:<br />$query</p>";
		} else {
			// success

print <<<END
	<h1>You Are Now Registered.</h1>
	
	<p>You are now a member of the community and may now log in 
	<a href="login.php">here</a>.</p>
END;
		}
		
	} else {
		$errmsg = '<p>None of the fields may be blank.</p>';
	}

}

if (empty($_POST['butSubmit']) || $validated == false) {

print <<<END
	<h1>New User Registration</h1>
	
	<p><span class="errormessage">$errmsg</span></p>
	<form action="$me" method="post">
		<div>Full Name: <input name="fullname" type="text" size="25" maxlength="40" value="" /></div>
		<div>Email Address: <input name="email" type="text" size="25" maxlength="60" value="" /></div>
		<div>Password: <input name="password" type="text" size="25" maxlength="15" value="" /></div>
		<div>Date of Birth: <input name="dob" type="text" size="25" maxlength="25" value="" /></div>
		<div><input name="butSubmit" type="submit" value="Enter new record" /></div>
	</form>

END;

}

include 'footer.php'; 
?>