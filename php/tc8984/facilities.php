<?php

// simple debuggin line wrapped in a function for reusability
function dumpvar($array) {
	echo '<pre>'.print_r($array,true).'</pre>';
}


define('DB_DSN', 'mysql:dbname=tc8984;host=localhost');
define('DB_USER', 'root');
define('DB_PASSWD', 'xampp');

// connect to database
try {
    $db = new PDO(DB_DSN, DB_USER, DB_PASSWD);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit(); // terminates script
}

// set action parameter from URI
$action = empty($_GET['action']) ? 'LIST' : strtoupper($_GET['action']);
$id = empty($_GET['id']) ? null : $_GET['id'];



?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page title</title>

</head>
<body>

<?php

switch($action) {
	case 'EDIT': // edit existing record
		if (empty($id)) {
			echo '<p>Invalid record specified.</p>';
			break; // bail if no id is set
		}
		// retrieve specific record
		$query = "SELECT id, site_id, short_name, long_name FROM facilities WHERE id = '{$id}'";
		$result = $db->query($query);

		if ($result === false) {
			// query error
			echo '<p>Query Error. Original query: '.$query.'</p>';
			$dbErr = $db->errorInfo();
			dumpvar($dbErr);
		}

		// get record
		$row = $result->fetch(PDO::FETCH_ASSOC);

		// this break intentionally left off

	case 'ADD': // add new record - display data entry form
?>
	<h1>Facilities Data Entry Form</h1>

	<form action="facilities.php?action=save<?php 
		echo empty($id) ? '' : '&id='.$id;
	?>" method="post">
		<p>
			<span>Site ID:</span>
			<input name="site_id" type="text" 
			value="<?php echo empty($id) ? '' : $row['site_id']; ?>"
			 />
		</p>
		<p>
			<span>Short Name:</span>
			<input name="short_name" type="text" 
			value="<?php echo empty($id) ? '' : $row['short_name']; ?>"
			 />
		</p>
		<p>
			<span>Long Name:</span>
			<input name="long_name" type="text" 
			value="<?php echo empty($id) ? '' : $row['long_name']; ?>"
			 />
		</p>
		<p><input type="submit" value="Save" />
	</form>
	
<?php
	break; // ADD

	case 'SAVE': // save data to database
		//dumpvar($_POST);

		// build query
		$query = empty($id) ? 'INSERT INTO ' : 'UPDATE ';

		$query .= ' facilities SET ' . 
			" site_id = '". $_POST['site_id'] ."', ".
			" short_name = '". $_POST['short_name'] ."', ".
			" long_name = '". $_POST['long_name'] ."' ";

		if (!empty($id)) $query .= " WHERE id = '{$id}' ";

		//echo $query;

		// send query to DB server
		$result = $db->query($query);

		// check result
		if ($result === false) {
			// query error
			echo '<p>Query Error. Original query: '.$query.'</p>';
			$dbErr = $db->errorInfo();
			dumpvar($dbErr);

			// display message based on error code
			switch(true) {
				// Duplicate entry on unique index
				case $dbErr[0] == '23000' && $dbErr[1] == '1062':
					echo '<p><b>Error:</b> The site ID you entered already exists.</p>';
				break;

			} // switch

			break; // terminate case
		} // if result

		// process results (check how many rows processed in this case)
		if ($result->rowCount() > 0) {
			// success! display feedback
			echo '<p>The record has been saved.</p>';
		}

	break; // SAVE

	default: 
	case 'LIST': // display list of records

		// get the table data
		$query = 'SELECT id, site_id, short_name, long_name FROM facilities';

		$results = $db->query($query);

		if ($results === false) {
			// query error
			echo '<p>Query Error. Original query: '.$query.'</p>';
			$dbErr = $db->errorInfo();
			dumpvar($dbErr);
		}

		// process result set
		echo '<table><tbody><thead>' . 
				'<tr>' . 
					'<th>ID</th>' .
					'<th>Site ID</th>' .
					'<th>Short Name</th>' .
					'<th>Long Name</th>' .
					'<th>Options</th>' .
				'</tr>' .
			 '</thead>';

		// loop through result set grabbing a row at a time
		while($row = $results->fetch(PDO::FETCH_ASSOC)) {
			echo '<tr>' .
					'<td>' . $row['id'] . '</td>' .
					'<td>' . $row['site_id'] . '</td>' .
					'<td>' . $row['short_name'] . '</td>' .
					'<td>' . $row['long_name'] . '</td>' .
					'<td>' .
						'<a href="facilities.php?action=edit&id=' . $row['id'] . '">Edit</a> | ' .
						'<a href="facilities.php?action=delete&id=' . $row['id'] . '">Delete</a> ' .
					'</td>' .
				 '</tr>';
		}

		echo '</tbody></table>';
	break; // LIST

	case 'DELETE': // delete record
		if (empty($id)) {
			echo '<p>Invalid record specified.</p>';
			break; // bail if no id is set
		}
		// delete specific record
		$query = "DELETE FROM facilities WHERE id = '{$id}'";
		$result = $db->query($query);

		if ($result === false) {
			// query error
			echo '<p>Query Error. Original query: '.$query.'</p>';
			$dbErr = $db->errorInfo();
			dumpvar($dbErr);
		}

		// process results (check how many rows processed in this case)
		if ($result->rowCount() > 0) {
			// success! display feedback
			echo '<p>The record has been deleted.</p>';
		}

	break; // DELETE


} // switch $action


?>


</body>
</html>