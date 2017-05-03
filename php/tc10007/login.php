<?php 
require_once('init.php'); 
require('header.php');
?>
	<style type="text/css">
	form label {
		display: block;
		margin-bottom: 0.5em;
	}

	label span, label input {
		display: inline-block;
	}

	label span {
		width: 120px;
	}

	label span:after {
		content: ':';
		margin-right: 1em;
	}
	</style>

<div id="flash">
	<p><?php if (!empty($_FLASH)) echo $_FLASH; ?></p>
</div>
<form action="index.php" method="post">
	<label>
		<span>Username</span>
		<input name="username" type="text" />
	</label>
	<label>
		<span>Password</span>
		<input name="password" type="password" />
	</label>
	<label>
		<input type="submit" value="Log In" />
	</label>
</form>

<?php require('footer.php'); ?>