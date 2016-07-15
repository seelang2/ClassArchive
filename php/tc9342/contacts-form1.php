<?php

// connect to db server and select database
try {
	// create an instance of the PDO class
	$db = new PDO('mysql:dbname=tc9342;host=localhost',
				  'root',
				  'xampp');

} catch (PDOException $e) {
    // terminate if there was a database error
    exit( 'Connection failed: ' . $e->getMessage() );
}

// build query
$query = "SELECT id, name FROM interests";

// send query to db server
$results = $db->query($query);

// check result
if (!$results) {
	// error. display feedback
	echo '<p>There was an error: '. $db->errorInfo()[2] . 
		 '<br />Query: ' . $query . '</p>';

	exit();
}


?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>

	<style type="text/css">
	body {
		font-family: Verdana, Arial, sans-serif;
		color: #333333;
		font-size: 100%;
	}

	form {
		width: 400px;
		padding: 1px 30px;
	}

	form label {
		display: block;
		margin-bottom: 0.5em;
	}

	form label span,
	form label input {
		display: inline-block;
	}

	form > label span {
		width: 125px;
	}

	fieldset { 
		margin-bottom: 1em; 
	}
	</style>
</head>
<body>

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
		<?php

// check if there are any rows in table
if ($results->rowCount() < 1) {
	// no rows in table
	echo '<p>No rows in table</p>';
} else {
	$c = 1;
	// loop through result set and add rows to table
	while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
	?>
	
	<label>
		<input type="checkbox" name="interests[]" value="<?php echo $row['id']; ?>" />
		<span><?php echo $row['name']; ?></span>
	</label>
	
	<?php
	$c++;
	}

}

		?>
	</fieldset>
	<div><input type="submit" /></div>
</form>

</body>
</html>