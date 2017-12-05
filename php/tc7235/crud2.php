<?php require('functions.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>
	<style type="text/css">
	body {
		font-family: Verdana, Arial, sans-serif;
		color: #000;
		font-size: 110%;
	}
	
	input, select, textarea { 
		font-size: 100%;
		padding: 5px;
	}
	
	form label {
		display: block;
		margin-bottom: 0.5em;
	}
	
	label span, label input {
		display: inline-block;
	}
	
	label span {
		margin-right: 1em;
		width: 25%;
	}
	
	</style>
	
</head>
<body>

<?php

$action = empty($_GET['action']) ? 'LIST' : strtoupper($_GET['action']);

switch($action) {
	case 'LIST': // list records
		
		// build query
		$query = "SELECT id, firstname, lastname, email FROM contacts";
		
		$results = $db->query($query); // send query to server
		
		// check/process results
		if ($results->rowCount() < 1) {
			// no rows returned
			echo '<p>No rows in table.</p>';
		} else {
			// loop through result set and build table
			echo '<table><tbody>';
			
			while( $row = $results->fetch(PDO::FETCH_ASSOC) ) {
				echo '<tr>' .
						'<td>' . $row['id'] . '</td>' . 
						'<td>' . $row['firstname'] . '</td>' . 
						'<td>' . $row['lastname'] . '</td>' . 
						'<td>' . $row['email'] . '</td>' . 
					 '</tr>';
			}
			
			echo '</tbody></table>';
		}
		
		
	break; // LIST
	
	case 'ADD':
	?>
	
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=process" method="post">
			<label>
				<span>First Name</span>
				<input name="firstname" />
			</label>
			
			<label>
				<span>Last Name</span>
				<input name="lastname" />
			</label>
			
			<label>
				<span>Email</span>
				<input name="email" />
			</label>
			
			<label>
				<span>Login</span>
				<input name="login" />
			</label>
			
			<label>
				<span>Password</span>
				<input name="password" />
			</label>
			
			<div>
				<input type="submit" value="Contine" />
			</div>
		</form>
	
	<?php
	break;
	
	case 'PROCESS':
		if ( empty($_POST) ) {
			echo '<p>Nothing to process.</p>';
			break; // terminate case
		}
		
		// ALWAYS sanitize user input before using in a SQL query
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		// build query
		$query = 'INSERT INTO contacts SET ' .
					"firstname = ". $db->quote($firstname) . ", " .
					"lastname = ". $db->quote($lastname) . ", " .
					"email = ". $db->quote($email) . ", " .
					"login = ". $db->quote($login) . ", " .
					"password = ". $db->quote($password) . " ";
	
		//echo $query; exit();
		
		$result = $db->query($query);
		
		if ( !$result ) {
			// there was an error with the query
			echo '<p>Query error. No soup for you *snap*<br />'.$query.'</p>';
			break; // terminate case
		}
		
		// query was successful, provide feedback\
		echo '<p>The record was saved successfully.</p>';
		
	break;
	
} // switch $action

?>

</body>
</html>