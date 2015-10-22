<?php

// echo '<pre>' . print_r($_POST, true) . '</pre>';

// connect to db server
$dbcnx = @mysql_connect('localhost', 'root', 'portable');

if (!$dbcnx) exit('Error connecting to database server.');

// select db
$dbh = @mysql_select_db('tc1068');

if (!$dbh) exit('Error selecting database.');


	
	$query = "SELECT id, firstname FROM personnel";
	
	//echo "<p>$query</p>"; exit;
	
	// send query
	$result = mysql_query($query);
	
	//check results
	if (!$result) {
		// query error or some other problem
		"<p>There was an error performing the query. MySQL Error:<br />" . mysql_error() . "<br />Query used:<br />$query</p>";
		
	} else {
		// query went through ok, continue
		
		if (mysql_num_rows($result) != 1) {
			// no rows found, redirect to login page with error
		} // if num_rows
		
		// do additional processing
		
		while($row = mysql_fetch_array($result))
		{
			// build message
			
$message = <<<END
\n
Hello {$row['firstname']}!\n
\n
Blah blah blah message.\n
\n
Talk to you soon!\n
END;
		
			echo $message;
			
			mail($row['email'], 'My message', $message);
			
		
		}
		
		
		
	} // if result
	

?>
