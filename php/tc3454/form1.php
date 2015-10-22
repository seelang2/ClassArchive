<?php


if (!empty($_POST)) {
	// process form
	// is firstname or lastname blank?
	if (empty($_POST['firstname']) || empty($_POST['lastname'])) {
		// display error message
		echo '<p>The first or last name fields cannot be blank. Please go back and enter both fields.</p>';
	} else {
		// perform data processing
		$fullname = $_POST['firstname'] . ' ' . $_POST['lastname'];
		
		echo '<h1>Welcome, ' . $fullname . '!</h1>';
	}

} else {
	// display blank form 
?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div><label>First Name: <input name="firstname" /></label></div>
		<div><label>Last Name: <input name="lastname" /></label></div>
		<div><input type="submit" value="Continue" /></div>
	</form>

<?php

} // if 

?>
