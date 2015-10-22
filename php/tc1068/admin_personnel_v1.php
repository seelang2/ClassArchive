<?php
require_once('startup.php');

//require_once('security.php');

include('header.php');


$mode = 'LIST';

if (!empty($_GET['mode'])) { $mode = strtoupper($_GET['mode']); }

switch($mode)
{

	case 'LIST':
		// list records in table
		
		// build query
		$query = 'SELECT id, firstname, lastname, dept_id, login, password, permission FROM personnel';
		
		$results = mysql_query($query);
		if (!$results) {
			// query error
			echo "<p>Query error. Query used:<br />$query</p>";
		} else {
			if (mysql_num_rows($results) < 1) {
				// no rows returned from query
				echo '<p>No rows present.</p>';
				
			} else {
				// display rows in a table
				echo '<table><tbody>' .
					 '<tr><th>ID</th><th>Name</th><th>Dept</th><th>Login</th><th>Permission</th></tr>';
				
				// loop through result rows
				while ($row = mysql_fetch_array($results)) {
					echo '<tr>' .
						 '<td>' . $row['id'] . '</td>' . 
						 '<td>' . $row['lastname'] . ', ' . $row['firstname'] . '</td>' . 
						 '<td>' . $row['dept_id'] . '</td>' . 
						 '<td>' . $row['login'] . '</td>' . 
						 '<td>' . $row['permission'] . '</td>' . 
						 '</tr>';
				
				} // while
				
				echo '<tbody></table>';
				
			
			} // if num_rows
		} // if results
		
	break;
	default:
		echo '<p>Invalid display mode.</p>';
	break;

} // switch mode


include('footer.php');
?>