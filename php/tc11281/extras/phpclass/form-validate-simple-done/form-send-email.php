<?php 
	//send email
	$to = "you@yoursite.com";
	$subject = "You have new mail!";
	$message = "You have a new signup!\r\n\r\n";
	$message .= "Name: $name \r\n";
	$message .= "Email: $email \r\n";
	$message .= "Publications: $publications\r\n";
	$headers = "From:admin@nobledesktop.com\r\n"; 
	mail($to, $subject, $message, $headers);
?>