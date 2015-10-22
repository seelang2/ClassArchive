<?php


if (empty($_POST)) {
	// display form
?>
	<form action="demo3.php" method="post">
    	<label for="firstname">First Name: <input type="text" name="firstname" /></label>
    	<label for="lastname">Last Name: <input type="text" name="lastname" /></label>
        <input type="submit" value="Continue" />
    </form>
<?php
} else {
	// process form data
	$fullname = $_POST['firstname'] . ' ' . $_POST['lastname'];
	echo '<h1>Welcome, '. $fullname .'!</h1>';

}

?>