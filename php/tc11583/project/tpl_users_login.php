<?php 
$message = Flash::get();
if (!empty($message) && $message == 'retrylogin') {
?>
<div class="flashmessage">The login or password is invalid. Please try again.</div>
<?php } ?>

<form action="<?php echo $uri; ?>" method="post">
<div>
	<label>
		<span>Login:</span>
		<input type="text" name="login" />
	</label>
</div>
<div>
	<label>
		<span>Password:</span>
		<input type="text" name="password" />
	</label>
</div>
<div><input type="submit" value="Log In" /></div>
</form>
