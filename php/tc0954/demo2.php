<?php


if (!empty($_POST['butSubmit'])) {
	// form data present, process form
	
	echo '<h1>Welcome, ' . $_POST['firstname'] . ' ' . $_POST['lastname'] . '!</h1>';

} else {
	// display form
?>
	<form action="demo2.php" method="post">
		<p>First Name: <input type="text" name="firstname" /></p>
		<p>Last Name: <input type="text" name="lastname" /></p>
		<input type="submit" name="butSubmit" value="Continue" />
	</form>

<?php
}
?>
