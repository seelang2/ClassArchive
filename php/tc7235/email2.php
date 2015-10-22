<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

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

	// include PHPMailer autoload function to locate/load classes
	require('phpmailer/PHPMailerAutoload.php');
	
	$mail = new PHPMailer;

	// get values and set up email
	$message = stripslashes($_POST['message']);
	$to = $_POST['toemail'];
	$from = $_POST['fromemail'];
	$fromName = $_POST['fromname'];
	$subject = stripslashes($_POST['subject']);
	
	
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = '';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = '';                 // SMTP username
	$mail->Password = '';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

	$mail->From = $from;
	$mail->FromName = $fromName;
	$mail->addAddress($to);     		// Add a recipient
		
	$mail->WordWrap = 50;               // Set word wrap to 50 characters
	$mail->isHTML(true);              	// Set email format to HTML

	$mail->Subject = $subject;
	$mail->Body    = $message;
	//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo 'Message has been sent';
	}


else:
?>

<h1>HTML E-mail Test Utility</h1>
<p>This will send an HTML email to a specified address using the form below.<p>
<p><span style="color:#ff0000;font-weight:bold">WARNING: THIS IS AN INSECURE FORM. DO NOT LEAVE THIS PAGE PUBLICLY ACCESSIBLE AND UNSECURED!</span></p>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<input type="hidden" name="mode" value="process" />
<label>To email:<input name="toemail" maxlength="120" /></label>
<label>From name:<input name="fromname" maxlength="120" /></label>
<label>From email:<input name="fromemail" maxlength="120" /></label>
<label>Subject:<input name="subject" maxlength="120" /></label>
<label>HTML Email Contents:<br /><textarea name="message" rows="40" cols="80"></textarea></label>
<input type="submit" value="Send HTML Mail" />
</form>

<?php endif; ?>

</body>
</html>