<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simple login demo</title>
</head>
<body>
<?php 
if (!empty($_POST)) {
	// form data present - process data
	if ( ($_POST['username'] == 'root') && ($_POST['password'] == 'obvious') ) {
		// login ok, proceed
		echo '<p>Login credentials accepted. Welcome!</p>';
	} else {
		// login failed, display error
		echo '<p>Invalid username or password. Please try again.</p>';
	}
} else {
	// display login form
?>
	<form action="login.php" method="post">
    	<div>
        	<label for="username">Username:</label>
            <input type="text" id="username" name="username" />
        </div>
    	<div>
        	<label for="password">Password:</label>
            <input type="text" id="password" name="password" />
        </div>
    	<div>
            <input type="submit" value="Log in" />
        </div>
    </form>
<?php
}
?>
</body>
</html>