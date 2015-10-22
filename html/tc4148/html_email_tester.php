<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HTML Email Test Utility</title>

<style type="text/css">
body {
	font-size: 85%;
	font-family: Verdana, Geneva, sans-serif;
}

form {
}

form label {
	display: block;
	clear: both;
	margin-bottom: 0.em;
}

</style>
</head>

<body>

<?php
if (!empty($_POST['mode'])):

	// get values and set up email
	$message = stripslashes($_POST['message']);
	$to = $_POST['toemail'];
	$from = $_POST['fromemail'];
	$subject = stripslashes($_POST['subject']);
	$headers  = "From: $from\r\n";
	$headers .= "Content-type: text/html\r\n";
	
	//options to send to cc+bcc
	//$headers .= "Cc: [email]maa@p-i-s.cXom[/email]";
	//$headers .= "Bcc: [email]email@maaking.cXom[/email]";
	
	// now lets send the email.
	if (mail($to, $subject, $message, $headers)) {
		echo '<p>Message has been sent.<p>';
	} else {
		echo '<p>There was a problem sending the message. Please go back and check the email settings.</p>';
	}


else:
?>

<h1>HTML E-mail Test Utility</h1>
<p>This will send an HTML email to a specified address using the form below.<p>
<p><span style="color:#ff0000;font-weight:bold">WARNING: THIS IS AN INSECURE FORM. DO NOT LEAVE THIS PAGE PUBLICLY ACCESSIBLE AND UNSECURED!</span></p>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<input type="hidden" name="mode" value="process" />
<label>To email:<input name="toemail" maxlength="120" /></label>
<label>From email:<input name="fromemail" maxlength="120" /></label>
<label>Subject:<input name="subject" maxlength="120" /></label>
<label>HTML Email Contents:<br /><textarea name="message" rows="40" cols="80"></textarea></label>
<input type="submit" value="Send HTML Mail" />
</form>

<?php endif; ?>

</body>
</html>