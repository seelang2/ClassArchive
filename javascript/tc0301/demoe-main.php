<?php

require_once ("demoe-config.php");


include ("demoe-header.php");
?>

<h2>Patient List</h2>

<?php


$query = "SELECT id, firstname, lastname, phone, email FROM contacts WHERE type = 1";

$result = mysql_query($query);

if (mysql_num_rows($result) < 1) echo "<p>No rows present.</p>";
else {
	echo "<table>";
	while ($row = mysql_fetch_array($result)) {
		echo "<tr>" .
		"<td>" . $row['id'] . "</td>" .
		"<td>" . $row['firstname'] . "</td>" .
		"<td>" . $row['lastname'] . "</td>" .
		"<td>" . $row['phone'] . "</td>" .
		"<td>" . $row['email'] . "</td>" .
		"</tr>";
	}
	echo "</table>";
}

?>

<?php include ("demoe-footer.php");
