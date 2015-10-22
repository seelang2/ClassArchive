<?php

if (isset($_SESSION['redir'] && $_SESSION['redir'] != '') {
	// get page that visitor came from and reset redir value
	$target = $_SESSION['redir'];
	$_SESSION['redir'] = '';
}

?>

<form action="<?php echo $target; ?>" method="post">
	<input type="hidden" name="fromlogin" value="1" />
	Name: <input type="text" name="name" /><br />
	Password: <input type="password" name="password" /><br />
	<input type="submit" value="Log In" />
</form>
