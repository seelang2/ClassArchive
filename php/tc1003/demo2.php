<?php

if (isset($_POST['butSubmit'])) {
	// process form data

	//echo '<pre>' . print_r($_SERVER, true) . '</pre>';
	echo $_POST['firstname'];
	echo $_POST['lastname'];

} else {
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	First name: <input name="firstname" type="text" /><br />
	Last name: <input name="lastname" type="text" /><br />
	<input type="submit" name="butSubmit" value="Go >>" />
</form>

<?php } ?>
