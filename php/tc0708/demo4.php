<?php

$namelist = array(
				'Fred' => 19,
				'Alan' => 34,
				'Alice' => 26,
				'Marcus' => 34,
				'Josie' => 55,
				'Eleanor' => 11,
				'Martha' => 67,
				'Patrick' => 45,
				'Stewart' => 37,
				'Chad' => 23,
				'Millicent' => 12
				);



echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\">";
echo "<tr><td>Name</td><td>Age</td></tr>";

foreach ($namelist as $name => $age) {
	echo "<tr><td>$name</td><td>$age</td></tr>";
}

echo "</table>";

?>