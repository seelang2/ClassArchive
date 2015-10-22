<?php
/***
 getquote.php - Mock quote data service
 Arbitrarily calculates a value that looks like USD
 and returns it as a JSON structure 
 Note that dob POST param MUST be an array
*/

header('Content-Type: application/json');

if (!is_array($_POST['dob'])) {
	echo json_encode(array('error' => 'Invalid data'));
	exit(); // terminate
}

$price = 0;

foreach($_POST['dob'] as $dob) {

	$targetDate = new DateTime($dob);

	$timeStamp = $targetDate->getTimestamp();
	//$timeStamp = $targetDate->format('U'); // for PHP < 5.3.0

	$simpleRate = 0.003125;

	$price += floor(abs((($timeStamp / 5) * $simpleRate))) / 100;

}


echo json_encode(array('price' => $price));

