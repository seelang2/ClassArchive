<?php
// to simulate latency
//mt_srand ((double) microtime() * 1000000);
mt_srand(crc32(microtime()));
usleep(mt_rand(25000, 400000) * 10);

$mode = empty($_GET['mode']) ? '': strtoupper($_GET['mode']);
$callback = empty($_GET['callback']) ? '': $_GET['callback'];
switch($mode) {

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
		header("Content-Type: application/json");
		echo "[";
		$c = 0;
		foreach ($_POST as $key => $value) {
			echo $c++ > 0 ? ',':'';
			echo '{"name":"'.$key.'","value":"'.$value.'"}';
		}

		echo "]";
	break;

	case 'JSONP':
		if (empty($callback)) return false;
		
		header("Content-Type: application/javascript");
		echo $callback."([";
		$c = 0;
		foreach ($_POST as $key => $value) {
			echo $c++ > 0 ? ',':'';
			echo '{"name":"'.$key.'","value":"'.$value.'"}';
		}

		echo "]);";
	break;

	default:
		echo "Error";

} // switch

?>