<?php

if (isset($_SESSION['redir']) && $_SESSION['redir'] != '') {
	// get page that visitor came from and reset redir value
	$target = $_SESSION['redir'];
	$_SESSION['redir'] = '';
} else {
	$target = DEFAULT_PAGE;
}

?>

<p><span class="statusmessage"><?php echo $statusmsg; ?></span></p>

<form action="<?php echo $target; ?>" method="post">
	<input type="hidden" name="fromlogin" value="1" />
	Name: <input type="text" name="email" /><br />
	Password: <input type="password" name="password" /><br />
	<input type="submit" value="Log In" />
</form>
