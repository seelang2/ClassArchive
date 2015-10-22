<?php
/*
	demo3.php - sample backend
	Training Connection class #2290 - Ajax
	Author: Chris Langtiw chris@langtiw.com
	
*/

if (!$dbcnx = @mysql_connect('localhost','root','xampp')) exit('Error: Cannot connect to db server.');
if (!$dbh = @mysql_select_db('tc2290')) exit('Error: Cannot select database.');

if (!empty($_GET['action'])) $action = strtoupper($_GET['action']); else $action = NULL;
if (!empty($_GET['id'])) $id = mysql_escape_string($_GET['id']); else $id = NULL;
if (!empty($_GET['output'])) $output = strtoupper($_GET['output']); else $output = 'TEXT';
if (!empty($_GET['status'])) $status = mysql_escape_string($_GET['status']); else $status = 'ALL';

// to simulate latency
//mt_srand ((double) microtime() * 1000000);
mt_srand(crc32(microtime()));
usleep(mt_rand(25000, 300000) * 3);

switch($action) {
	case 'SHOW':
		$query = "SELECT * FROM patients";
		if (!empty($id)) $query .= " WHERE id = '$id' ";
		if ($status != 'ALL') {
			if (!empty($id)) $query .= " AND"; else $query .= " WHERE";
			$query .= " status = '$status' ";
		}
		$query .= " ORDER BY status DESC, name ASC ";
		
		$results = @mysql_query($query);
		if (!$results) {
			echo 'Error: Problem with query: ' . $query;
			break;
		}
		
		if (mysql_num_rows($results) < 1) {
			echo 'Error: No rows present.';
		}
		
		switch($output) {
			default:
			case 'TEXT':
				$c = 1;
				while($row = mysql_fetch_array($results, MYSQL_ASSOC)) {
					if ($c > 1) echo ';';
					$p = 1;
					foreach ($row as $column => $value) {
						if ($p > 1) echo ',';
						echo $column . '=' . $value;
						$p++;
					}
					$c++;
				}
			break;
			
			case 'XML':
				header("Content-Type: text/xml");
				echo '<?xml version="1.0" encoding="iso-8859-1"?>' . "\n";
				echo '<patientlist>' . "\n";
				$c = 1;
				while($row = mysql_fetch_array($results, MYSQL_ASSOC)) {
					//if ($c > 1) echo ';';
					$p = 1;
					echo '<patient>' . "\n";
					foreach ($row as $column => $value) {
						//if ($p > 1) echo ',';
						//echo $column . '=' . $value;
						echo "<$column>$value</$column>\n";
						$p++;
					}
					echo '</patient>' . "\n";
					$c++;
				}
				echo '</patientlist>' . "\n";
			break;

		} // output
		
	break;
	
	case 'UPDATE':
		if (empty($id)) {
			echo 'Error: invalid id specified.';
			break;
		}
		$query = "UPDATE patients SET ";
			$c = 1;
			foreach($_POST as $col => $value) {
				$col = mysql_escape_string($col);
				$value = mysql_escape_string($value);
				if ($c > 1) $query .= ", ";
				$query .= "$col = '$value'";
				$c++;
			}
			$query .= " WHERE id = '$id' ";
			if (!$result = @mysql_query($query)) {
				echo 'Error: Problem with query: ' . $query;
				break;
			}
			echo 'Ok';
	break;
	
	default:
		echo 'Error: Invalid action specified.';
	break;
} // switch


