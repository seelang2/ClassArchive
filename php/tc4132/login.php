<?php
require('init.php');

//print_r($flashdata);
include('header.php');

?>

<h2>Please Log In</h2>

<div id="statusmessage"><?php echo empty($flashdata['text'])?'':$flashdata['text']; ?></div>

<form action="<?php echo empty($flashdata['fromurl'])?'default.php':$flashdata['fromurl']; ?>" method="post">
	<label>Login:<input type="text" name="login" /></label>
	<label>Password:<input type="text" name="password" /></label>
	<input type="submit" value="Log In" />
</form>

<?php include('footer.php');