<?php

if (!empty($_POST['mode'])) {
	// data present, process data
	
	echo '<h1>Welcome, ' . $_POST['firstname'] . ' ' . $_POST['lastname'] . '!</h1>';


} else {
	// no data, so display form
?>
<form action="demo2.php" method="post">
	<input type="hidden" name="mode" value="data" />
	<p>First Name: <input type="text" name="firstname" /></p>
	<p>Last Name: <input type="text" name="lastname" /></p>
	<input type="submit" name="butSubmit" value="Continue">
</form>
<?php } // if ?>
