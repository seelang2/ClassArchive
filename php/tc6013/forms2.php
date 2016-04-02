<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>
	
	<style type="text/css">
	form {
		width: 340px;
		margin: auto;
		padding: 10px 20px;
		border: 1px solid #999;
	}
	form label {
		display: block;
		margin: 0 0 0.5em 0;
	}
	form span {
		display: inline-block;
		width: 25%;
	}
	form div {
		text-align: center;
	}
	</style>
</head>
<body>


<?php

// connect to database 
try {

	$db = new PDO('mysql:dbname=tc6013;host=localhost','root','xampp');

} catch (PDOException $e) {
	echo '<p>There was a problem connecting to the database: '.
		 $e->getMessage() . 
		 '</p>';

}



// use ternary operator (instead of if/else) to assign action
$action = empty($_GET['action']) ? 'ADD': strtoupper($_GET['action']);



switch($action) {

	case 'ADD': // display data entry form
	?>
		<form action="forms2.php?action=process" method="post">
			<label><span>First Name:</span><input name="firstname" /></label>
			<label><span>Last Name:</span><input name="lastname" /></label>
			<label><span>Login:</span><input name="login" /></label>
			<label><span>Password:</span><input name="password" /></label>
			<div><input type="submit" value="Continue" /></div>
		</form>
	<?php

	break; // 'ADD'
	
	case 'PROCESS': // process form data
		// build query
		$query = 'INSERT INTO users SET '.
					"firstname = '{$_POST['firstname']}', " .
					"lastname = '{$_POST['lastname']}', " .
					"login = '{$_POST['login']}', " .
					"password = '{$_POST['password']}' ";
		
		// send query to server
		$result = $db->query($query);
		
		// check response
		if ($result === false || $result->rowCount() != 1) {
			// query error
			echo '<p>There was a problem with the query. <br />'.
				 'Query error: ' . $db->errorInfo()[2] . '<br />'.
				 'Query: '.$query.'</p>';
			
			break; // terminate case
		}
		
		// successful save, tell the user
		echo '<p>The record has been saved.</p>';
	
	break; // 'PROCESS'
	
} // switch

?>


</body>
</html>