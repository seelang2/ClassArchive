<?php
/*******
 * Filename: userdata.php
 * Version: v.1.2
 * Auth: Chris Langtiw chris@sitebabble.com http://www.sitebabble.com
 * License: Creative Commons Attribution 3.0 Unported License
 * License URL: http://creativecommons.org/licenses/by/3.0/deed.en_US
 *	
 * Description:
 * A simple back-end service example for use in developing ajax applications. Can also
 * be used to store simple data without need for a database.
 *
 * Note that the datafile or directory where the datafile is located must be writeable.
 *
 * Parameters:
 * action	- Specifies operation. Valid values:
 *				getlist - Get list of users.
 *				getuser - Get specific user info.
 *				saveuser - Save user record.
 *				delete - Delete user record. id must be specified.
 *
 * type		- Response format. Valid values are json and xml.
 *
 * id		- User array index. Use with action=getuser or action=saveuser.
 *			  Note that not specifying an id with action=saveuser will result in a
 *			  new record being created.
 *
 * range	- Number of records to be returned with action=getlist. Default is all.
 *
 * offset	- Starting array index of result set.
 *
 * callback - Function name to use in JSONP request wrapper
 *
 * Change Log
 * ----------
 * v1.2 - Added id parameter in return object when calling saveuser
 * v1.1 - Added JSONP callback support
 * v1.0 - Initial coding
 *
 ***/


// to simulate latency
mt_srand(crc32(microtime()));
usleep(mt_rand(25000, 400000) * 10);

function savedata($data, $datafile) {
	// write to serialized file
	$OUTPUT = serialize($data); 
	$fp = fopen($datafile,"w"); 
	fputs($fp, $OUTPUT); 
	fclose($fp); 
}

function loaddata($datafile) {
	// read from serialized file
	return @unserialize(@file_get_contents($datafile));
}

$datafile = 'users.dat';

// Note: Do NOT use 'id' as a field name as id is used and passed as the array index
$fieldlist = array('firstname','lastname','login'); 

// initialize data file
if (!file_exists($datafile)) {
	savedata(
		array(
			array("firstname" => "John","lastname" => "Doe","login" => "jdoe"),
			array("firstname" => "Alex","lastname" => "Jones","login" => "ajones"),
			array("firstname" => "Mary","lastname" => "Allen","login" => "coachu"),
			array("firstname" => "Peter","lastname" => "Geraci","login" => "attyatlaw"),
			array("firstname" => "Liz","lastname" => "Cleaver","login" => "lcleaver"),
			array("firstname" => "Harry","lastname" => "Jacobs","login" => "hjacobs"),
			array("firstname" => "Alice","lastname" => "Hartmann","login" => "alice1"),
			array("firstname" => "Maria","lastname" => "Alvarez","login" => "ma229"),
			array("firstname" => "June","lastname" => "Wendell","login" => "june.wendell"),
			array("firstname" => "Bob","lastname" => "Tackle","login" => "thebob1"),
			array("firstname" => "Jane","lastname" => "Smith","login" => "jmsmith")
		), 
		$datafile);
}

// load data
$users = loaddata($datafile);
if (!$users) $users = array();

$action = empty($_GET['action']) ? '' : strtoupper($_GET['action']);
$type = empty($_GET['type']) ? 'JSON' : strtoupper($_GET['type']);
$id = !isset($_GET['id']) ? -1 : $_GET['id'];
$range = !isset($_GET['range']) ? count($users) : $_GET['range'];
$offset = !isset($_GET['offset']) ? 0 : $_GET['offset'];
$callback = empty($_GET['callback']) ? '' : $_GET['callback'];

if (!empty($callback)) $type = 'JSON'; // force type to JSON if callback present

//echo "action: $action id: $id type: $type";

switch($action) {
	case 'GETLIST':
		switch($type) {
			case 'JSON':
				$c = -1;
				if (!empty($callback)) {
					header('Content-Type: text/javascript');
					echo $callback . '(';
				} else {
					header('Content-Type: application/json');
				}
				echo '[';
				foreach ($users as $user) {
					$c++;
					if ($c < $offset) continue;
					if ($c > ($offset + ($range - 1))) break;
					if ($c > 0 && $c > $offset) echo ',';
					echo '{';
					$x = 0;
					echo '"id":' . $c;
					foreach($fieldlist as $value) {
						//if ($x++ > 0) echo ',';
						echo ',';
						echo '"'.$value.'":"'.$user[$value].'"';
					}
					echo '}';
				}
				echo ']';
				if (!empty($callback)) {
					echo ');';
				}
				break;

			case 'XML':
				$c = -1;
				header("Content-Type: text/xml");
				echo '<?xml version="1.0" encoding="iso-8859-1"?>' . "\n";
				echo "<contactlist>\n";
				foreach ($users as $user) {
					$c++;
					if ($c < $offset) continue;
					if ($c > ($offset + ($range - 1))) break;
					echo '<contact>';
					foreach($fieldlist as $value) {
						echo '<'.$value.'>'.$user[$value].'</'.$value.'>';
					}
					echo '</contact>'."\n";
				}
				echo "</contactlist>\n";
			break;
		}
	break; // GETLIST
	
	case 'GETUSER':
		if ($id < 0) exit('{"status":0,"message":"No id specified."}');
		switch($type) {
			case 'JSON':
				if (!empty($callback)) {
					header('Content-Type: text/javascript');
					echo $callback . '(';
				} else {
					header('Content-Type: application/json');
				}
				echo '{"id":"'.$id.'",';
				$c = 1;
				foreach($fieldlist as $value) {
					//if ($c++ > 0) echo ',';
					echo ',';
					echo '"'.$value.'":"'.$users[$id][$value].'"';
				}
				echo '}';
				if (!empty($callback)) {
					echo ');';
				}
			break;
			
			case 'XML':
				header("Content-Type: text/xml");
				echo '<?xml version="1.0" encoding="iso-8859-1"?>' . "\n";
				echo "<contactlist>\n";
				echo '<contact>';
				echo '<id>'.$id.'</id>';
				foreach($fieldlist as $value) {
					echo '<'.$value.'>'.$users[$id][$value].'</'.$value.'>';
				}
				echo '</contact>'."\n";
				echo "</contactlist>\n";
			break;
		}
	break; // GETUSER
	
	case 'SAVEUSER':
		if ($id < 0) $id = count($users);
		
		foreach($fieldlist as $value) {
			$users[$id][$value] = $_POST[$value];
		}
		savedata($users, $datafile);
		echo '{"status":1,"message":"Record saved.","id":'.$id.'}';
		
	break; // SAVEUSER
	
	case 'DELETE':
		if ($id < 0) exit('{"status":0,"message":"No id specified."}');
		unset($users[$id]); // remove array value
		$users = array_values($users); // reorder array
		savedata($users, $datafile);
		echo '{"status":1,"message":"Record deleted."}';
	break; // DELETE
	
	default:
		echo '{"status":0,"message":"Invalid action."}';
	break;

}



?>