<?php

if ( isset($_POST['firstname']) && !empty($_POST['firstname']) && isset($_POST['lastname']) && !empty($_POST['lastname']) ) {

	echo "<h1>Welcome, " . $_POST['firstname'] . " " . $_POST['lastname'] . "!</h1>";
	
} else {

?>
<form action="demo7.php" method="post">
<p>
	Firstname: <input name="firstname" type="text" /><br />
	Lastname: <input name="lastname" type="text" /><br />
	
	<input type="submit" />
</p>
</form>

<?php
} // if else

?>

