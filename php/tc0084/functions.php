<?php
/*
functions.php - Basic php function library
*/

/*
	Connect to MySQL database and server in a single bound
*/
function db_connect($dbname, $dbuser, $dbpasswd, $dbhost = 'localhost') {
	$dbh = @mysql_connect($dbhost, $dbuser, $dbpasswd);
	if (!dbh) return false;
	
	if (!@mysql_select_db($dbname)) return false;

	return $dbh;
}

/*
	Process query and return result set as array
*/
function get_results($query, $returntype = "A", $showerrors = false) {
	switch (strtoupper($returntype)) {
		case 'A': $rtype = MYSQL_ASSOC; break;
		case 'N': $rtype = MYSQL_NUM; break;
		default: $rtype = MYSQL_BOTH; break;
	}
	
	$resultarray = array();
	$resrc = @mysql_query($query);
	if (!$resrc) {
		if ($showerrors) echo "<p>Error performing query: " . mysql_error() . "</p>";
		return false;
	}
	while ($row = @mysql_fetch_array($resrc, $rtype)) {
		$resultarray[] = $row;
	}
	return $resultarray;
}

/*
	Prints table of fields without a header row
*/
function print_results($array, $returnval = false) {
	$output = "<table>";
	foreach ($array as $row) {
		$output .= "<tr>";
		foreach ($row as $field => $value) {
			$output .= "<td>$value</td>";
		}
		$output .= "</tr>";
	}
	$output .= "</table>";
	if ($returnval) return $output; else echo $output;
}

/*
	Prints table of fields with header row version 1
	(using additional foreach loop)
*/
function print_results1($array, $returnval = false) {
	$output = "<table>";

	$output .= "<tr>";
	foreach ($array[0] as $field => $value) {
		$output .= "<td>$field</td>";
	}
	$output .= "</tr>";
	
	foreach ($array as $row) {
		$output .= "<tr>";
		foreach ($row as $field => $value) {
			$output .= "<td>$value</td>";
		}
		$output .= "</tr>";
	}
	$output .= "</table>";
	if ($returnval) return $output; else echo $output;
}

/*
	Prints table of fields with header row version 2
	(without additional foreach loop)
*/
function print_results2($array, $returnval = false) {
	$output = "";

	$headerrow = "<table><tr>";
	$c = 0;
	foreach ($array as $row) {
		$output .= "<tr>";
		foreach ($row as $field => $value) {
			$output .= "<td>$value</td>";
			if ($c < 1) {
				$headerrow .= "<td>$field</td>";
			}
		}
		$output .= "</tr>";
		if ($c < 1) {
			$headerrow .= "</tr>";
		}
		$c++;
	}
	$output .= "</table>";

	$output = $headerrow . $output;
	
	if ($returnval) return $output; else echo $output;
}

/*
	Adds or edits entries in a table using array
	array keys are equal to table colnames
*/
function table_update($mode, $tablename, $formdata, $id = NULL, $idfield = NULL) {
	$mode = strtoupper($mode);
	if ($mode != "ADD" && $mode != "EDIT") return false;
	
	if ($mode == "ADD")
		$query = "INSERT INTO ";
	else
		$query = "UPDATE ";
		
	$query .= $tablename . " SET ";
	
	$c = count($formdata) -1;
	reset ($formdata);
	$i = 0;
	
	foreach ($formdata as $field => $value) {
		if ($field != "butSubmit") {
			if ($i > 0) $query .= ", ";
			$query .= $field . " = '" . escape($value) ."'";
		}
		$i++;
	}
	
	if ($mode == "EDIT") $query .= " WHERE $idfield = '$id'";
	
	if (!$result = @mysql_query($query)) return false;
	
	return $result;
}

/*
	Escapes potentially harmful entries for SQL queries
	Works regardless of Magic Quotes setting
*/
function escape($str)
{
	return mysql_real_escape_string(stripslashes($str));				
}

/*
	Dump contents of global arrays
*/
function dump_global_vars() {

	echo '<h2>Contents of $_SERVER:</h2>';
	reset($_SERVER);
	foreach ($_SERVER as $key => $val)
		echo "$key => $val<br />";
	reset($_SERVER);

	echo '<h2>Contents of $_GET:</h2>';
	reset($_GET);
	foreach ($_GET as $key => $val)
		echo "$key => $val<br />";
	reset($_GET);

	echo '<h2>Contents of $_POST:</h2>';
	reset($_POST);
	foreach ($_POST as $key => $val)
		echo "$key => $val<br />";
	reset($_POST);

	echo '<h2>Contents of $_SESSION:</h2>';
	reset($_SESSION);
	foreach ($_SESSION as $key => $val)
		echo "$key => $val<br />";
	reset($_SESSION);

	echo '<h2>Contents of $_COOKIE:</h2>';
	reset($_COOKIE);
	foreach ($_COOKIE as $key => $val)
		echo "$key => $val<br />";
	reset($_COOKIE);
	
}
?>