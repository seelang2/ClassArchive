<?php

if (isset($_POST['firstname']) && isset($_POST['lastname'])) {
	// process form data
	if (empty($_POST['firstname']) || empty($_POST['lastname'])) {
		// First or last name missing
		echo '<p>One or more form fields is missing. Please go back and fill in all the fields.</p>';
	} else {
		$fullname = $_POST['firstname'] . ' ' . $_POST['lastname'];
		echo '<p>Welcome, ' . $fullname . '</p>';
	}

} else {
	// display blank form
?>
	<form action="form.php" method="post">
		<div><label>First Name: <input name="firstname" /></label></div>
		<div><label>Last Name: <input name="lastname" /></label></div>
		<div><input type="submit" value="Continue" /></div>
	</form>

<?php

} // if 

?>
