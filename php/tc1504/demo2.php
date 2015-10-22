<html>
<body>
<?php



if(!empty($_POST)) {
	// check form fields
	if ($_POST['login'] == 'root' && $_POST['password'] == 'password') {
		// login ok, display greeting
		echo '<h1>Login Successful</h1><p>Welcome Root!</p>';
	} else {
		echo '<p>The login and/or password is invalid. Please try again.</p>';
	}
	
} else {
	// display login form
?>	
	<h1>Log in here</h1>
    
    <form action="demo2.php" method="post">
    	<p>Login: <input name="login" type="text" /></p>
        <p>Password: <input name="password" type="text" /></p>
        <p><input type="submit" value="Log in Now" /></p>
    </form>
    
<?php	
} // if empty post


?>
</body>
</html>