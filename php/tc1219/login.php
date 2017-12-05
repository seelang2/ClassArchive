<?php
$page_unsecured = true; // MUST put this BEFORE config.php
require_once('config.php');
include('header.php');
?>

<h1>Log in Here</h1>

<p class="flashmessage"><?php echo $flashmessage; ?></p>

<form action="main.php" method="post">
	<div>
		<label for="login">Login:</label>
		<input name="login" />
	</div>
	<div>
		<label for="pwd">Password:</label>
		<input type="password" name="pwd" />
	</div>
	<div>
		<input type="submit" name="loginSubmit" />
	</div>
</form>

<?php include('footer.php'); ?>