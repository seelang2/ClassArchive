<?php
require_once('config.php');

include('header.php');

if (empty($flashdata)) $flashdata = DEFAULT_LOGIN_REDIRECT; // set action to default location
?>
<h2>Please Log In</h2>
<div id="flashmessage"><?php echo $flashmessage; ?></div>

<form action="<?php echo $flashdata; ?>" method="post">
<div><label for="login">Login:</label><input id="login" name="login" /></div>
<div><label for="password">Password:</label><input id="password" name="password" /></div>
<div><input type="submit" value="Log In Now" /></div>
</form>

<?php include('footer.php'); ?>