<?php
/*
NOTE: This isn't how you do this in production applications as PHP's
sendmail port is blocked as spam by many servers. Use a proper
authenticated library such as PHPMailer 
(https://github.com/PHPMailer/PHPMailer) instead.
*/


$to      = 'seelang2@gmail.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: seelang2@gmail.com' . "\r\n" .
    'Reply-To: seelang2@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

if (mail($to, $subject, $message, $headers)) {
	echo '<p>Mail was sent.</p>';
} else {
	echo '<p>Mail was NOT sent.</p>';
}



?>