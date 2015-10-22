<?php
/*
session_start();
$dataarray = $_SESSION;

$subarray = array();

foreach ($_POST as $key => $value) {
	$subarray[$key] = $value;
}

$dataarray[] = $subarray;

$c = count($_SESSION); reset($_SESSION);

echo "<p>Session Count: $c</p>";

$_SESSION[$c] = $dataarray;

echo "<pre>" . print_r($_SESSION, true) . "</pre>";

echo "<pre>" . print_r($dataarray, true) . "</pre>";




exit;
*/

switch(strtoupper($_GET['mode'])) {

	case 'CSV':
		foreach ($_POST as $key => $value) {
			echo $key . ', "' . $value . '"' . "\n";
		}
		break;
	
	case 'HTML':
		echo "<table><tr><td>Field Name</td><td>Field Value</td></tr>";
	
		foreach ($_POST as $key => $value) {
			echo "<tr><td>$key</td><td>$value</td></tr>";
		}

		echo "</table>";
	break;

	case 'XML':
		header("Content-Type: text/xml");
		echo '<?xml version="1.0" encoding="iso-8859-1"?>' . "\n";
		echo "<fieldlist>\n";
	
		foreach ($_POST as $key => $value) {
			echo "<field>\n<name>$key</name>\n<value>$value</value>\n</field>\n";
		}

		echo "</fieldlist>\n";
	break;

	default:
		echo "Error";

} // switch

?>