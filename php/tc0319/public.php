<?php
require_once("config.php");

include("header.php");

echo "<h1>Available Publications</h1>";

		$query = "SELECT p.id, p.name, p.description, p.create_date, u.firstname, u.lastname FROM publications AS p, users AS u WHERE p.author_id = u.id";
		
		$result = mysql_query($query);
		
		if (!$result) {
			// do error checking
			echo "<p>No Publications Available</p>";
		
		} else {
			// process results
			
			$c = 1;
			while($row = mysql_fetch_array($result)) {
				echo "<div class='";

				//if ($c % 2 == 0) echo "evenrow"; else echo "oddrow";
				echo $c % 2 == 0 ? "evenrow" : "oddrow";
				
				echo "'>";
				echo "<h3>{$row['name']}</h3>";
				echo "<p>{$row['description']}</p>";
				echo "<p>Author: {$row['firstname']} {$row['lastname']}</p>";
				echo "<p><a href='subscribe.php?pub={$row['id']}'>Subscribe to this publication</a></p>";
				echo "</div>";
				$c++;
			}
			
		}
		

include("footer.php"); ?>