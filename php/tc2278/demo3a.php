<?php


if (empty($_GET)) {
	// display form
?>
	<form action="demo3a.php" method="get">
    	<label for="firstname">First Name: <input type="text" name="firstname" /></label>
    	<label for="lastname">Last Name: <input type="text" name="lastname" /></label>
        <input type="submit" value="Continue" />
    </form>
<?php
} else {
	// process form data
	$fullname = $_GET['firstname'] . ' ' . $_GET['lastname'];
	echo '<h1>Welcome, '. $fullname .'!</h1>';

}

?>