<?php
/***********************************************************************
class_dbinfo.php - dbInfo record handler class
Version 0.93 Last update 2007-02-19
Copyright (c) 2007 Chris Langtiw

Flags in GET:
mode	add, edit, delete
tbl		table name
id		identifier (based on first field in table)

Change Log
-----------------------------------------------------------------------


***********************************************************************/


// class constants
@define('VERSION', 0.93);
@define('TABLE', 1);
@define('CSV', 2);


class db_info {
	
	var $table_list = array();
	var $table_info = array();
	
	function db_info($dbhost, $dbname, $dbuser, $dbpassword)
	{
		$this->dbh = @mysql_connect($dbhost,$dbuser,$dbpassword);

		if ( !$this->dbh )
		{
			$this->print_error("Unable to establish database connection");
		}

		$this->select($dbname);
		$this->get_table_info();
	} // function

	function select($db)
	{
		if ( !@mysql_select_db($db,$this->dbh))
		{
			$this->print_error("Unable to select database");
		}
	} // function

	function escape($str)
	{
		return mysql_real_escape_string(stripslashes($str));				
	} // function

	function print_error($str = "")
	{
		if (!$str) $str = mysql_error();
		echo "<div id=\"dberror\"><blockquote><b>SQL/DB Error --</b> ";
		echo "[$str]</blockquote></div>";
	} // function

	function get_table_info() {
		
		$query = "SHOW TABLES";
		
		$this->result = @mysql_query($query,$this->dbh);
		
		if ( mysql_error() )
		{
			$this->print_error();
			return false;
		}
		//echo "Ran query $query...<br />";
		
		while (list($key, $val) = mysql_fetch_array($this->result)) {
			//echo "Adding $key from ($val) to table_list...<br />\n";
			$this->table_list[] = $key;
		}
		reset($this->table_list);
		
		foreach ($this->table_list as $table) {
			$this->table_info[$table] = array();
			
			$query = "SHOW COLUMNS IN $table";
			$this->result = @mysql_query($query,$this->dbh);
			//echo "Ran query $query...<br />";
			
			while (list($field, $type, $null, $key, $default, $extra) = mysql_fetch_array($this->result)) {
				//echo "Table $table: Adding $field to table_info (ignoring $type, $null, $key, $default, $extra)...<br />\n";
				$this->table_info[$table][$field] = $type;
			}
		}
	
	} // function
	
	function get_table_list() {
		return $this->table_list;
	} // function
	
	function get_table_array($table = "ALL") {
		if ($table == "ALL")
			return $this->table_info;
		else
			return $this->table_info[$table];
	} // function
	
	function tbl_list($tablename, $field_labels = NULL, $list_type = TABLE, $use_option_cell = TRUE, $target = NULL) {
		global $_SERVER;
		
		$output = "";
		if (is_null($target) || $target == "") $target = $_SERVER['PHP_SELF'];

		// build query
		$sql = "SELECT * FROM $tablename";
	
		// submit query
		$results = @mysql_query($sql);
		if (!$results) {
			$this->print_error();
			return false;
		}
		
		$output .= "<table border=\"1\" cellpadding=\"3\" cellspacing=\"0\">\n";
	
		/*
			NOTE: How to determine the ID field when setting up the ability to select
			a record in a table blindly?
			We'll use the assumption that the first field in the table is the unique
			identifier for the record, a fairly common convention.
		*/
		
		// create table header row
		$output .= "<tr>";
		$c = 1;
		while (list($field, $type) = each($this->table_info[$tablename])) {
//			$output .= "<td>" . $field . "</td>";
			$output .= "<td>" . (is_null($field_labels) ? $field : ($field_labels[$field] == "" ? $field : $field_labels[$field])) . "</td>";
			if ($c == 1) $idfield = $field;
			$c++;
		}
		$output .= "<td>Options (<a href=\"$target?mode=add&tbl=$tablename\">Add New Record</a>)</td>";
		$output .= "</tr>\n";
		reset($this->table_info[$tablename]); // move pointer back to start of array
		
		// display results
		while ($row = mysql_fetch_array($results)) {
			$output .= "<tr>";
			while (list($field, $type) = each($this->table_info[$tablename])) {
					$output .= "<td>" . ((is_null($row[$field]) || $row[$field] == "") ? "&nbsp;" : $row[$field]) . "</td>";
			}
			// add function options to end
			$output .= "<td><a href=\"$target?mode=edit&tbl=$tablename&id=" . $row[$idfield] . "\">EDIT</a>&nbsp;&nbsp;<a href=\"$target?mode=delete&tbl=$tablename&id=" . $row[$idfield] . "\">DELETE</a></td>";
	
			$output .= "</tr>\n";
			reset($this->table_info[$tablename]);
		}
		$output .= "</table>";
		return $output;
	} // function

	function list_table($table = "ALL", $field_labels = NULL, $return_as_var = FALSE, $list_type = TABLE, $use_option_cell = TRUE, $target = NULL) {
		$output = "";
		
		if ($table == "ALL" || $table == "") {
			foreach ($this->table_list as $table) {
				$output .= "<p>Displaying table $table:</p>\n";
				$output .= $this->tbl_list($table, $field_labels, $list_type, $use_option_cell, $target);
				$output .= "<br />";
			}
		} else {
			$output .= "<p>Displaying table $table:</p>\n";
			$output .= $this->tbl_list($table, $field_labels, $list_type, $use_option_cell, $target);
		}
		if ($return_as_var) {
			return $output;
		} else {
			echo $output;
			return;
		}
	} // function
	
	function do_form($mode, $tablename, $field_labels = NULL, $id = NULL, $target = NULL, $showquery = FALSE)
	{
		global $_SERVER;
		
		$output = "";

		$mode = strtoupper($mode);
		if ($mode != "ADD" && $mode != "EDIT") {
			$this->print_error("Error: Invalid Mode $mode in db_mpform");
			return false;
		}

		if ($mode == "EDIT") {
			$butsubmitval = "Update Record";
			$flags = "?mode=edit";

			// get idfield based on first field in table
			$c = 1;
			while (list($field, $type) = each($this->table_info[$tablename])) {
				if ($c == 1) {
					$idfield = $field;
					break;
				}
				$c++;
			}
			reset($this->table_info[$tablename]); // move pointer back to start of array

			$sql = "SELECT * FROM $tablename WHERE $idfield = '$id'";
			$results = @mysql_query($sql);
			if (!$results) {
				$this->print_error();
				return false;
			}
			$row = mysql_fetch_array($results);
		} else {
			$butsubmitval = "Add Record";
			$flags = "?mode=add";
		}

		$flags .= "&tbl=$tablename&id=$id";
		if (is_null($target) || $target == "") $target = $_SERVER['PHP_SELF'] . $flags;

		echo "<form action=\"$target\" method=\"post\">";
		echo "<table>\n";
	
		while (list($field, $type) = each($this->table_info[$tablename])) {
			echo "<tr><td align=\"right\">" . (is_null($field_labels) ? $field : ($field_labels[$field] == "" ? $field : $field_labels[$field])) . ":&nbsp;</td><td><input type=\"text\" name=\"$field\" value=\"";
			if ($mode == "EDIT") echo $row[$field]; 
			echo "\" size=\"25\" maxlength=\"100\" /></td></tr>\n";
		}
	
		echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" name=\"butSubmit\" value=\"$butsubmitval\" /></td></tr>";
		echo "</table></form>\n";
	
		if ($showquery) echo "<p>Query used: $sql</p>";
		return;
	}

	function form_update($mode, $tablename, $values, $id = NULL, $showquery = FALSE) {
		$mode = strtoupper($mode);
		if ($mode != "ADD" && $mode != "EDIT") {
			$this->print_error("Error: Invalid Mode $mode in db_mpform");
			return false;
		}
	
		if ($mode == "ADD") {
			$sql = "INSERT INTO ";
		} else {
			$sql = "UPDATE ";
		}
	
		$sql .= "$tablename SET ";
	
		$c = count($values) - 1; // get count of form items and subtract one (for submit button)
		reset($values); // set array pointer to beginning of array for re-reading
		$i = 0;
		while (list($key, $val) = each($values)) {
			if ($key != "butSubmit") { // avoid submit button field
//				if ($val != "") {
					$val = $this->escape($val);
					if ($i > 0) $sql .= ", ";      
					$sql .= "$key = '$val'";
//				}
				$i++;
		   }
		} // close while

		// get idfield based on first field in table
		$c = 1;
		while (list($field, $type) = each($this->table_info[$tablename])) {
			if ($c == 1) {
				$idfield = $field;
				break;
			}
			$c++;
		}
		reset($this->table_info[$tablename]); // move pointer back to start of array
		
		if ($mode == "EDIT") $sql .= " WHERE $idfield = $id";
	
		if (@mysql_query($sql)) {
		  echo '<p>The database was updated successfully.</p>';
		} else {
		  $this->print_error();
		}
	
		if ($showquery) echo "<p>Query used: $sql</p>";
		return;
	} // function

	function delete($tablename, $id, $showquery = FALSE)
	{
		// get idfield based on first field in table
		$c = 1;
		while (list($field, $type) = each($this->table_info[$tablename])) {
			if ($c == 1) {
				$idfield = $field;
				break;
			}
			$c++;
		}
		reset($this->table_info[$tablename]); // move pointer back to start of array

		$sql = "DELETE FROM $tablename WHERE $idfield = '$id'";
	
		if (@mysql_query($sql)) {
		  echo '<p>The database record was successfully deleted.</p>';
		} else {
		  $this->print_error();
		}
	
		if ($showquery) echo "<p>Query used: $sql</p>";
		return;
	}

	function preg_match_between($a_sStart, $a_sEnd, $a_sSubject)
	{
	  $pattern = '/'. $a_sStart .'(.*?)'. $a_sEnd .'/';
	  preg_match($pattern, $a_sSubject, $result);
	
	  return $result[1];
	}

} // class db_info
?>

<?php
// demo usage:

//include ("class_dbinfo.php");

$dbinfo = new db_info("localhost", "tc1706", "root", "xampp");


$mode = "LIST";
$tbl = "";
$target = $_SERVER['PHP_SELF'];

if (isset($_GET['mode']) && $_GET['mode'] != '') $mode = $_GET['mode'];
if (isset($_GET['tbl']) && $_GET['tbl'] != '') $tbl = $_GET['tbl'];
if (isset($_GET['id']) && $_GET['id'] != '') $id = $_GET['id'];
if (isset($_GET['conf']) && $_GET['conf'] != '') $conf = $_GET['conf'];

switch (strtoupper($mode))
{
	case 'ADD':
		if (!isset($_POST['butSubmit'])) {
			echo "<h2>Adding record to table $tbl</h2>";
			$dbinfo->do_form("ADD",$tbl);
		} else {
			$dbinfo->form_update("ADD", $tbl, $_POST, NULL, TRUE);
			$dbinfo->list_table($tbl);
		}
	break;
	case 'EDIT':
		if (!isset($_POST['butSubmit'])) {
			echo "<h2>Editing record $id in table $tbl</h2>";
			$dbinfo->do_form("EDIT",$tbl,$id);
		} else {
			$dbinfo->form_update("EDIT", $tbl, $_POST, $id, TRUE);
			$dbinfo->list_table($tbl);
		}
	break;
	case 'DELETE':
		if (!isset($conf)) {
			echo "<p>About to delete record $id in table $tbl</p>";
			echo "<p><strong><span style=\"color:#FF0000\">WARNING:</span> This operation CANNOT be undone!</strong></p>";
			echo "<p>Please ensure that $id (the first field in the table) is a <strong>unique</strong> identifier otherwise multiple records may be deleted!</p>";
			echo "<p><a href=\"$target?mode=delete&tbl=$tbl&id=$id&conf=y\">Click here to confirm the deletion</a></p>";
		} else {
			$dbinfo->delete($tbl, $id, TRUE);
			$dbinfo->list_table($tbl);
		}
	break;
	case 'LIST':
		$dbinfo->list_table($tbl);
	break;
	case 'DEBUG':
		echo "<p>Contents of table_list:</p>\n<pre>" . print_r($dbinfo->get_table_list(), true) . "</pre>";
		echo "<p>Contents of table_info:</p>\n<pre>" . print_r($dbinfo->get_table_array(), true) . "</pre>";
		
		echo "<p>Displaying contents of members_confirmed:</p>";
		foreach ($dbinfo->get_table_array("members_confirmed") as $field => $type) {
			//echo "<p>Field: $field&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Type: $type</p>";
			echo "<p>Field: $field&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Type: " . $dbinfo->preg_match_between("^", "\(", $type) . " - " . $dbinfo->preg_match_between("\(", "\)", $type) . "</p>";
			//echo "<p>Field: $field&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Type: " . preg_match_between("\(", "\)", $type) . "</p>";
		}
	break;
	default:
	break;
}

echo "<a href=\"$target?mode=list\">View All Table Lists</a> | <a href=\"$target?mode=debug\">Show Debug Info</a>";
?>