<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<?php

include("config.php");

if (!$dbcnx = db_connect('tc8401_classdb', 'tc8401_dbuser', 'simple')) exit('Error connecting to database.');


if (isset($_GET['mode']) && $_GET['mode'] != '') $mode = strtoupper($_GET['mode']); else $mode = 'LIST';

switch($mode) {
	case 'LIST':
	  $result = @mysql_query('SELECT * FROM contact');
	  if (!$result) {
		exit('<p>Error performing query: ' . mysql_error() . '</p>');
	  }
	  
	  if (mysql_num_rows($result) < 1) {
	  	echo "<p>No Rows Present.</p>";
	  } else {
		  echo "<table>";
		  while ($row = mysql_fetch_array($result)) {
echo <<<END
<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['address']}</td><td><a href="$me?mode=editform&id={$row['id']}">EDIT</a> <a href="$me?mode=del&id={$row['id']}">DELETE</a></td></tr>
END;
		  }
		  echo "</table>";
	  }		
	  echo "<p><a href=\"{$_SERVER['PHP_SELF']}?mode=addform\">Add new record</a></p>";
	break;
	
	case 'DEL':
		$id = $_GET['id'];
		$query = "DELETE FROM contact WHERE id = '$id'";
		if (!$result = mysql_query($query)) exit('<p>Error performing query (can\'t locate record): ' . mysql_error() . '</p>');

		echo "<p>Record Deleted.</p>";
		echo "<p><a href=\"$me?mode=list\">List records</a></p>";
	break;
	
	case 'EDITFORM':
		$id = $_GET['id'];
		
		$query = "SELECT * FROM contact WHERE id = '$id'";
		if (!$result = mysql_query($query)) exit('<p>Error performing query (can\'t locate record): ' . mysql_error() . '</p>');
		
		$row = mysql_fetch_array($result);
		
	case 'ADDFORM':
?>
	<form action="<?php
		echo $me . "?mode="; 
		
		if (isset($id)) {
			echo "editrec&id=" . $row['id']; 
		} else {
			echo "addrec";
		}
	?>" method="post">
	Contact Name: <input type="text" name="name" value="<?php echo $row['name']; ?>" /><br  />
	Address: <input type="text" name="address" value="<?php echo $row['address']; ?>" />
	<input type="submit" name="butSubmit" value="Update Contact"  />
</form>
<?php		
	break;
	
	case 'EDITREC':
		$id = $_GET['id'];
		
	case 'ADDREC':
		
		
		if (!$result = table_update('add', 'contact', $_POST))
			echo "<p>There was a problem updating the database.</p>";
		else
			echo "<p>The database was updated successfully.</p>";
			
		
		



	break;

	default:
		exit ("The mode selected is not valid.");
	break;
}
echo "<p><a href=\"$me?mode=list\">List records</a></p>";
echo "<p><a href=\"{$_SERVER['PHP_SELF']}?mode=addform\">Add new record</a></p>";

?>




</body>
</html>
