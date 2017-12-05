<?php
/*
	security.php - basic security system

*/


// define permission constants

@define('VIEW', 1);


// echo '<pre>' . print_r($_POST, true) . '</pre>';

if(!empty($_POST['butSubmit'])) {

	// build query
	$userlogin = $_POST['login'];
	$userpassword = $_POST['password'];
	
	$query = "SELECT id, firstname, permission FROM personnel WHERE login = '$userlogin' AND password = '$userpassword'";
	
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
			header('Location: http://localhost/login.php?status=2');
			exit;
		} // if num_rows
		
		// do additional processing
		
		$user = mysql_fetch_array($result);
		
		// check permission level
		if ($user['permission'] < VIEW) {
			// insufficient permission to view page - take back to login
			header('Location: http://localhost/login.php?status=3');
			exit;
		}
		
		
	} // if result
	
} else {
	// send to login form
	header('Location: http://localhost/login.php');
	exit;
}

?>