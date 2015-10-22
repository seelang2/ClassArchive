<?php
require_once('config.php');

?>

<h1>Log In</h1>

<?php if (!empty($flashmsg)) echo "<p>$flashmsg</p>"; ?>

<form action="<?php echo $flashdata; ?>" method="post">
	<div><label for="email">Email: </label><input name="email" id="email" /></div>
	<div><label for="password">Password: </label><input name="password" id="password" /></div>
    <div><input type="submit" value="Log In Now" /></div>
</form>

