

<?php

if ( !empty($_POST) ) {
	// there's data inside POST array, process form data
	$fullname = $_POST['firstname'] . ' ' . $_POST['lastname'];
	
	echo '<h1>Welcome, ' . $fullname . '!</p>';
	
} else {
	// display blank form
?>

<form action="demo2.php" method="post">
	<label for="firstname">First Name <input type="text" name="firstname" /></label>
	<label for="lastname">Last Name <input type="text" name="lastname" /></label>
	<input type="submit" />
</form>

<?php
} // if empty $_POST

?>