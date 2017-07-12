<?php
$to = "jeremy@nobledesktop.com";
$subject = 'You have new mail!';
$message = "You have a new signup!\r\n\r\n";
foreach ($expected as $value) {
	if ( is_array(${$value}) ) {
		foreach (${$value} as $subValue) {
			$message .= "     $subValue\r\n";
		}
	}
	else {
		$message .= "$value: ${$value}\r\n";
	}
	
}
$headers = "Content-Type: text/plain; charset=utf-8\r\n"; //specify utf-8 encoding
$headers .= "From:admin@nobledesktop.com\r\n"; 
mail($to,$subject, $message, $headers)
?>