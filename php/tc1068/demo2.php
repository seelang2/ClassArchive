<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<?php

if(!empty($_POST)) {
	// process form data
	if ($_POST['password'] == 'hamster' && $_POST['login'] == 'admin') {
		// let them in	
?>
	<h1>Main Content Page</h1>
	<p>Access granted. Come on in!</p>
<?php
	} else {
		// show them the door
?>
	<h1>Access Denied</h1>
	<p>Invalid login or password. No soup for you!</p>
	<p>Please go back and try again.</p>
<?php
	} // if login/password

} else {
	// display form
?>
	<form action="/demo2.php" method="post">
		<p>Login: <input type="text" name="login" /></p>
		<p>Password: <input type="password" name="password" /></p>
		<input type="submit" name="butSubmit" value="Log In Now" />
	</form>


<?php
}


?>

</body>
</html>
