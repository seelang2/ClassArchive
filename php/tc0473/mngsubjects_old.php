<?php

$dbcnx = mysql_connect('localhost', 'root', 'portable');
if (!$dbcnx) die('Error attempting to connect to db server.');

$dbh = mysql_select_db('tc473');
if (!$dbh) die('Error selecing database.');

if (isset($_POST['butSubmit'])) {
	// process form
//	echo "<h1>{$_POST['name']}</h1><p>" . $_POST['description'] . '</p>';
	
	if (isset($_POST['name']) && $_POST['name'] != '') $name = $_POST['name'];
	if (isset($_POST['description']) && $_POST['description'] != '') $description = $_POST['description'];
	
	$query = "INSERT INTO subjects SET name='$name', description='$description'";
	
	$result = mysql_query($query);
	
	if (!$result) {
		// display error message
		echo "<p>Error entering record into database. Query used:<br />$query</p>";
	} else {
		// display success message
		echo "<p>Successfully entered record into database.</p>";
	}
	
} else {
	// display form
?>

<form action="mngsubjects.php" method="post">
<p>Subject Name: <input type="text" name="name" /></p>
<p>Description: <input type="text" name="description" /></p>
<input type="submit" name="butSubmit" />
</form>

<?php
}
?>
