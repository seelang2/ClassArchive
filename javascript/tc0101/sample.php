<?php

include("database.php");

$tablename = "";


if (isset($_REQUEST['mode']) && $_REQUEST['mode'] != "") $mode = strtoupper($_REQUEST['mode']); else $mode = "LIST";


switch ($mode)
{
	case 'ADD':

// Pull $_POST into variables

//    $joketext = $_POST['joketext'];


	while (list($key, $val) = each($_POST)) {
		$$key = $val;
	}

// Build query string

    $sql = "INSERT INTO $tablename SET joketext='$joketext', jokedate=CURDATE()";


// Send query
// Check for errors
// Provide feedback to browser
    if (@mysql_query($sql)) {
      echo '<p>Your joke has been added.</p>';
    } else {
      echo '<p>Error adding submitted joke: ' .
          mysql_error() . '</p>';
    }



	break;
	case 'ADDFORM':
?>

<form action="<?php echo $me; ?>" method="post">
<input type="hidden" name="mode" value="add" />




</form>

<?php	
	break;
	case 'LIST':
	
	// build query
	$sql = "SELECT * FROM $tablename";

	// submit query
	$results = @mysql_query($sql);
	if (!$results) exit('<p>Error performing query: ' . mysql_error() . '</p>');
	
	
	echo "<table border=\"1\">";
	echo "<tr><td>First Name</td><td>Last Name</td><td>Date Joined</td><td>Email Address</td></tr>";
	
	// display results
	while ($row = mysql_fetch_array($results)) {
	
	echo "<tr><td>" . $row['firstname'] . "</td><td>" . $row['lastname'] . "</td><td>" . $row['date_joined'] . "</td><td>" . $row['email'] . "</td></tr>";
	
	}
	
	echo "</table>";
	echo "<p><a href=\"$me?mode=addform\">Add new record</a></p>";
	break;
	default:






	break;
}

?>