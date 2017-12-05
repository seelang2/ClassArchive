<?php
require_once("config.php");

		$query = "SELECT id, firstname, lastname, email, login, permission FROM users";
		
		$result = mysql_query($query);
		
		if (!$result) {
			// do error checking
			echo "<p>Did something go wrong?</p>";
		
		} else {
			// process results
			
			while($row = mysql_fetch_array($result)) {
				echo $row['firstname'] . ', ' . $row['lastname'] . ', ' . $row['email'] . "\n";
			}
			
		}


?>