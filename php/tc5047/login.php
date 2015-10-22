<?php
// login.php
require('config.php');

// is login data present?
if (!empty($_POST['login']) && !empty($_POST['password'])) {
	// validate login credentials
	$query = "SELECT id, name, permissions ".
			 "FROM authors ".
			 "WHERE login = '".escape($_POST['login'])."' ".
			 "AND password = '".escape($_POST['password'])."' ".
			 "LIMIT 1";
	// is user valid?
	$result = @mysql_query($query);
	if ($result && mysql_num_rows($result) == 1) {
		// store credentials
		$_SESSION['userdata'] = mysql_fetch_array($result, MYSQL_ASSOC);
		
		// send to target page
		header('Location: posts.php');
		exit; // remember to call exit after a header redirect
	} else {
	// else send to login form
	$errMsg = 'Invalid login or password.';
	}
} else {
// else send to login form

}

include('header.php');

?>

<h2>User Login</h2>

<div><?php echo $errMsg; ?></div>

<form action="login.php" method="post">
	<label>
    	Login: <input name="login" type="text" />
    </label>

	<label>
    	Password: <input name="password" type="text" />
    </label>

	<label>
    	<input value="Log In" type="submit" />
    </label>
	
</form>


<?php include('footer.php'); ?>






