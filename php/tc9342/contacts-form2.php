<?php

require('init.php');


function showInterestCheckboxes($db) {
	// build query
	$query = "SELECT id, name FROM interests";

	// send query to db server
	$results = $db->query($query);

	// check result
	if (!$results) {
		// only return false instead of more feedback
		return false;
	}

	// check if there are any rows in table
	if ($results->rowCount() < 1) {
		// no rows in table
		return '<p>No rows in table</p>';
	} else {

		$output = '';

		// loop through result set and add rows to table
		while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
			$output .= '<label>' .
					'<input type="checkbox" name="interests[]" value="'. $row['id'] .'" />' .
					'<span>'. $row['name'] .'</span>' .
				 '</label>';
		}
		return $output;
	}
}



include('header.php');
?>

<form action="contacts-add.php" method="post">
	<label>
		<span>First Name:</span>
		<input type="text" name="firstname" />
	</label>
	<label>
		<span>Last Name:</span>
		<input type="text" name="lastname" />
	</label>
	<label>
		<span>Email:</span>
		<input type="text" name="email" />
	</label>

	<fieldset>
		<legend>Interests</legend>
		<?php echo showInterestCheckboxes($db); ?>
	</fieldset>
	<div><input type="submit" /></div>
</form>

<?php include('footer.php'); ?>