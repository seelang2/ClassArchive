<?php
require_once('config.php');

include('header.php');
?>

<h1>Log In Here</h1>

<p><?php echo $statusmsg; ?></p>

<form action="login.php" method="post">
	<div>
	<label for="email">Email:</label>
	<input type="text" name="email" size="50" maxlength="100" />
	</div>
	<div>
	<label for="password">Password:</label>
	<input type="password" name="password" size="50" maxlength="100" />
	</div>
	<input name="butSubmit" type="submit" value="Enter Record" />
</form>


<?php
include('footer.php');
?>