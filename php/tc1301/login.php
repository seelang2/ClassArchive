<?php

require_once('config.php');
include('header.php');
?>

<h1>Log in Here</h1>

<p><?php echo $statusmsg; ?></p>

<form action="main.php" method="post">
	<div><label for="login">Login:</label><input name="login" /></div>
	<div><label for="password">Password:</label><input name="password" type="password" /></div>
	<input type="submit" name="Log In" />
</form>


<?php include('footer.php'); ?>