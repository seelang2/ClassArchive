<?php
require_once('config.php');

include('header.php');
?>

<div id="loginbox">

<div><?php echo $statusmsg; ?></div>

<h2>Please Log In</h2>
<form action="main.php" method="post">
	<div><label for="login">Login:</label><input name="login" /></div>
	<div><label for="password">Password:</label><input type="password" name="password" /></div>
	<div align="center"><input type="submit" name="butLogin" value="Log in Now" /></div>
</form>

</div>

<?php
include('footer.php');
?>