<?php
// to simulate latency
//mt_srand ((double) microtime() * 1000000);
mt_srand(crc32(microtime()));
usleep(mt_rand(25000, 400000) * 10);


switch(strtoupper($_GET['mode'])) {

	case 'CSV':
		foreach ($_POST as $key => $value) {
			echo $key . ', "' . $value . '"' . "\n";
		}
		break;
	
	case 'HTML':
		echo "<table><tbody><tr><td>Field Name</td><td>Field Value</td></tr>";
	
		foreach ($_POST as $key => $value) {
			echo "<tr><td>$key</td><td>$value</td></tr>";
		}

		echo "</tbody></table>";
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
	
	case 'JSON':
		if (empty($_GET['callback'])) {
			header("Content-Type: application/json");
		}
		$counter = 0;
		if (!empty($_GET['callback'])) echo $_GET['callback'] . '(';
		echo "{";
		foreach ($_POST as $key => $value) {
			echo ($counter > 0 ? ',': '') . "\"$key\":\"$value\"";
			$counter++;
		}
		echo "}";
		if (!empty($_GET['callback'])) echo ');';
	break;

	default:
		echo "Error";

} // switch

?>