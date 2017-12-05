<?php
require_once('config.php');


if (isset($_POST['submit'])) {
	// process login form
	
	$xemail = $_POST['email'];
	$xpassword = $_POST['password'];
	
	$query = "SELECT id, email, password FROM profiles WHERE email = '$xemail' AND password = '$xpassword'";
	
	if (!$result = mysql_query($query)) {
		// query error
		
	} else {
		if (mysql_num_rows($result) != 1) {
			// cannot find matching user
			$errmsg = '<p>Email or password is incorrect.</p>';
		} else {
			// authenticated user
			$row = mysql_fetch_array($result);
			
			$_SESSION['loggedin'] = true;
			
			if (isset($_SESSION['from'])) {
				$redirect = $_SESSION['from'];
			
			} else {
				$redirect = 'profile.php?mode=view&id=' . $row['id'];
			}
			
			header('Location: ' . $redirect);
			exit;
		}
	}

}
	// display login form
	
include ('header.php');
?>

<h1>Login Here</h1>
<?php echo $errmsg; ?>

<form action="<?php echo $me; ?>" method="post">
	<div><label>Email:</label><input type="text" name="email" /></div>
	<div><label>Password:</label><input type="password" name="password" /></div>
	<input type="submit" name="submit" value="Log in now" />
</form>

<?php

/*
// dump server array values
echo '<pre>' . print_r($_SESSION, true) . '</pre>';
echo '<pre>' . print_r($_COOKIE, true) . '</pre>';
echo '<pre>' . print_r($_POST, true) . '</pre>';
echo '<pre>' . print_r($_GET, true) . '</pre>';
echo '<pre>' . print_r($_SERVER, true) . '</pre>';
*/

include ('footer.php');

?>