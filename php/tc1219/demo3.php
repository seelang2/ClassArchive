<?php

if (!empty($_POST['butSubmit'])) {
	// process form data

	$fullname = $_POST['firstname'] . ' ' . $_POST['lastname'];
?>
	<h1>Welcome, <?php echo $fullname; ?>!</h1>
	<p>Glad you could join the party!</p>
<?php

} else {
	// display form

?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<p>Firstname: <input name="firstname" /></p>
		<p>Lastname: <input name="lastname" /></p>
		<p><input name="butSubmit" type="submit" value="Continue" />
	</form>
<?php
}

?>