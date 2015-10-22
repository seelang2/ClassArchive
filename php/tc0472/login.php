<?php
require_once('config.php');
session_start();


if (isset($_POST['submit'])) {
	// process login form
	
	$xlogin = $_POST['login'];
	$xpassword = $_POST['password'];
	
	if ($xlogin == 'user' && $xpassword == 'obvious') {
		// authenticated user
		$_SESSION['loggedin'] = true;
		
		if (isset($_SESSION['from'])) {
			$redirect = $_SESSION['from'];
		
		} else {
			$redirect = 'pub_main.php';
		}
		
		header('Location: ' . $redirect);
		exit;
	} else {
		$errmsg = '<p>Login or password is incorrect.</p>';
	}

}
	// display login form
	
include ('pub_header.php');
?>

<h1>Login Here</h1>
<?php echo $errmsg; ?>

<form action="<?php echo $me; ?>" method="post">
	<div><label>Login:</label><input type="text" name="login" />
	<div><label>Password:</label><input type="password" name="password" />
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

include ('pub_footer.php');

?>