<?php
/*
contactsvc.php - contact app db service

Switches:

MODE - sets service mode
	PUT		- Insert new record into db
			  if ID also passed then edits existing record
	DELETE	- Delete existing record from db (requires ID switch)
	GET		- Retrieve record set
	COUNT	- Retrieve total number of records in database
	
ID	- record ID
L 	- Starting record for range
R 	- # records in range


*/

// database constants
define('DB_USERNAME','root');
define('DB_PASSWORD','portable');
define('DB_NAME','class467');
define('DB_HOST','localhost');

// table/field names multidimensional array
$table_field_labels = array(
	'contacts' => array(
		'id' => '',
		'firstname' => 'First Name',
		'lastname' => 'Last Name',
		'addr1' => 'Address 1',
		'addr2' => 'Address 2',
		'city' => 'City',
		'st' => 'State',
		'zip' => 'Zip',
		'phone1' => 'Phone 1',
		'phone2' => 'Phone 2',
		'email' => 'Email Address',
		'url' => 'Website URL'
	)
);


$me = $_SERVER['PHP_SELF'];

// initialize database
$dbh = db_connect(DB_NAME, DB_USERNAME, DB_PASSWORD, DB_HOST);
if (!$dbh) exit('Error connecting to database server or selecting database');

// get parameter list
if (isset($_GET['l'])) $l = $_GET['l']; else $l = 0; // starting record #
if (isset($_GET['r'])) $r = $_GET['r']; else $r = 5; // range of records per page
if (isset($_GET['id'])) $id = escape($_GET['id']); else unset($id); // record id (if set)

// to simulate latency
//mt_srand ((double) microtime() * 1000000);
mt_srand(crc32(microtime()));
usleep(mt_rand(5000, 100000) * 10);



switch(strtoupper($_GET['mode'])) {
	case 'DELETE':
		db_delete('contacts', $id);
	break;
	
	case 'PUT':
		if (isset($id)) {
			db_mpform_update("EDIT", 'contacts', $id);
		} else {
			db_mpform_update("ADD", 'contacts');
		}
	break;
	
	case 'GET':
		$query = "SELECT * FROM contacts";
		if (isset($id)) $query .= " WHERE id = '$id'";
		$query .= " LIMIT $l, $r";
		
//		echo $query; exit;
		$results = @mysql_query($query);
		
		header("Content-Type: text/xml");
		echo '<?xml version="1.0" encoding="iso-8859-1"?>' . "\n";
		echo "<contactlist>\n";
		
		while ($row = @mysql_fetch_array($results, MYSQL_ASSOC)) {
			echo "<contact>";
			foreach ($row as $key => $value) {
				echo "<$key>\n$value\n</$key>\n";
			}
			echo "</contact>\n";
		}

		echo "</contactlist>\n";

	break;
	
	case 'COUNT':
		$query = "SELECT count(*) FROM contacts";
		$result = @mysql_query($query);
		$row = mysql_fetch_row($result);
		echo $row[0];
	break;

	default:
		echo "Error";
}








///////////////////////// FUNCTIONS ////////////////////////////////

// ====================================================================
//	Connect to mySQL Database server and select database
//	Parameters:
//		$dbname			- Database name
//		$dbuser			- Database username
//		$dbpassword		- Database password
//		$hostname 		- Hostname (default is localhost)
function db_connect($dbname, $dbuser, $dbpassword, $hostname = 'localhost')
{
	$dbcnx = @mysql_connect($hostname, $dbuser, $dbpassword);
	
	if (!$dbcnx) return false;
	
	$dbh = @mysql_select_db($dbname);
	
	if (!$dbh) return false;

	return $dbh;
}

// ====================================================================
//	Format a string correctly for safe insert under all PHP conditions
//  Used on any string intended for database insertion
//	Parameters:
//		$str 	- String to reformat
function escape($str)
{
	return mysql_real_escape_string(stripslashes($str));				
}


// ====================================================================
//	Delete a record from a given table
//	Parameters:
//		$tablename 	- Name of table
//		$id			- Record ID value
//		$idfield	- (optional) Name of ID field (defaults to 'id')
//		$showquery	- (optional) Show SQL query used
function db_delete($tablename, $id, $idfield = 'id', $showquery = FALSE)
{
	$sql = "DELETE FROM $tablename WHERE $idfield = $id";

	if (@mysql_query($sql)) {
	  echo 'Success';
	} else {
	  echo 'Error encountered during deletion: ' . mysql_error();
	}

	if ($showquery) echo "<p>Query used: $sql</p>";
	return;
}

// ====================================================================
//	Multipurpose Add/Edit form update
//	Parameters:
//		$mode		- ADD or DELETE
//		$tablename 	- Name of table
//		$id			- (optional)Record ID value (if EDIT)
//		$idfield	- (optional) Name of ID field (defaults to 'id') (IF EDIT)
//		$showquery	- (optional) Show SQL query used
function db_mpform_update($mode, $tablename, $id = NULL, $idfield = 'id', $showquery = FALSE)
{
	$mode = strtoupper($mode);
	if ($mode != "ADD" && $mode != "EDIT") exit("Error: Invalid Mode $mode in db_mpform_update");

	if ($mode == "ADD") {
		$sql = "INSERT INTO ";
	} else {
		$sql = "UPDATE ";
	}

	$sql .= "$tablename SET ";

	$c = count($_POST); // get count of form items
	reset($_POST); // set array pointer to beginning of array for re-reading
	$i = 0;
	while (list($key, $val) = each($_POST)) {
		if ($val != "") {
			$val = escape($val);
			if ($i > 0) $sql .= ", ";      
			$sql .= "$key = '$val'";
		}
		$i++;
	} // close while
	
	if ($mode == "EDIT") $sql .= " WHERE $idfield = $id";

	if (@mysql_query($sql)) {
	  echo 'Success';
	} else {
	  echo 'Error encountered during update: ' . mysql_error();
	}

	if ($showquery) echo "<p>Query used: $sql</p>";
	return;
}




?>