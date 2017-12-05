<?php

$namelist = array(
				array(
					'name' => 'Fred',
					'age' => 19
				),
				array(
					'name' => 'Paul',
					'age' => 32
				),
				array(
					'name' => 'John',
					'age' => 39
				),
				array(
					'name' => 'George',
					'age' => 22
				)
			);
				
// echo '<pre>' . print_r($namelist, true) . '</pre>';

echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\">";
echo "<tr><td>Name</td><td>Age</td></tr>";

foreach ($namelist as $person) {
	echo "<tr><td>" . $person['name'] . "</td><td>" . $person['age'] . "</td></tr>";
//	echo "<tr><td>{$person['name']}</td><td>{$person['age']}</td></tr>";
}

echo "</table>";

?>