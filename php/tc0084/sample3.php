<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<?php

$me = $_SERVER['PHP_SELF'];

  // Connect to the database server
  $dbcnx = @mysql_connect('localhost', 'tc8401_dbuser', 'simple');
  if (!$dbcnx) {
    exit('<p>Unable to connect to the database server at this time.</p>');
  }

  // Select the jokes database
  if (!@mysql_select_db('tc8401_classdb')) {
    exit('<p>Unable to locate the database at this time.</p>');
  }


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
<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['address']}</td><td><a href="$me?mode=editform&id={$row['id']}">EDIT</a></td></tr>
END;
		  }
		  echo "</table>";
	  }		
	  echo "<p><a href=\"{$_SERVER['PHP_SELF']}?mode=addform\">Add new record</a></p>";
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
			echo "addrec";
		} else {
			echo "editrec&id=" . $row['id']; 
		}
	?>" method="post">
	Contact Name: <input type="text" name="name" value="<?php echo $row['name']; ?>" /><br  />
	Address: <input type="text" name="address" value="<?php echo $row['address']; ?>" />
	<input type="submit" name="butSubmit" value="Update Contact"  />
</form>
<?php		
	break;
	
	case 'EDITREC':
		$name = $_POST['name'];
		$address = $_POST['address'];
		$id = $_GET['id'];
		
		$query = "UPDATE contact SET name = '$name', address = '$address' WHERE id = '$id'";	
		if (!$result = mysql_query($query)) exit('<p>Error performing query: ' . mysql_error() . '</p>');

		echo "<p>Record successfully updated.</p>";
		echo "<p><a href=\"$me?mode=list\">List records</a></p>";

	break;
	
	case 'ADDREC':
		if (isset($_POST['butSubmit'])) {
			$addrec = true;
			if (isset($_POST['name']) && $_POST['name'] != '') $name = $_POST['name']; else $addrec = false;
			if (isset($_POST['address']) && $_POST['address'] != '') $address = $_POST['address']; else $addrec = false;
			
			if ($addrec) {
				// do database query
				$query = "INSERT INTO contact SET name = '$name', address = '$address'";
				if ($result = mysql_query($query)) {
					echo "<p>Contact Successfully added!</p>";
					
				} else {
					echo '<p>Error performing query: ' . mysql_error() . '</p>';
				}
				  echo "<p><a href=\"$me?mode=list\">List records</a></p>";
			  	  echo "<p><a href=\"$me?mode=addform\">Add another record</a></p>";

			} else {
				echo "<p>Required data missing. Please go back and ensure all fields are entered.</p>";
			}		
		} else exit('<p>Form data is missing.</p>');
	break;

	default:
		exit ("The mode selected is not valid.");
	break;
}


?>




</body>
</html>
