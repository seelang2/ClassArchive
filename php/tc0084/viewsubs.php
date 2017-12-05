<?php
require("config.php");

include("header.php");


if (isset($_GET['mode']) && $_GET['mode'] != "") $mode = strtoupper($_GET['mode']); else $mode = "";

if ($mode == 'ADD') {
	$sub_id = $_POST['subs'];
	$c_id = $_SESSION['id'];

//dump_global_vars();
	
	$query = "SELECT * FROM c_to_s WHERE s_id = '$sub_id' AND c_id = '$c_id'";
	if ($result = get_results($query)) 
		echo "<p>A duplicate entry exists for this subscription.</p>";
	else {
	
		$query = "INSERT INTO c_to_s SET c_id = '$c_id', s_id = '$sub_id'";
		
		echo "<p>Query: $query</p>";
	
		$result = @mysql_query($query);
		if (!$result) echo "<p>There was a problem updating the database.<br />MySQL Error: " . mysql_error() . "</p>";
		else echo "<p>Subscription was added successfully.</p>";

	}	
}

$query = "SELECT subs.id, name FROM subs, c_to_s WHERE subs.id = s_id AND c_id = '{$_SESSION['id']}'";

if (!$result = get_results($query))
	echo "<p>No Subscriptions Found.</p>";
else {
	echo "<h2>Available Subscriptions:</h2>";
	print_results1($result);

}



$query = "SELECT subs.id, name FROM subs WHERE NOT EXISTS (SELECT * FROM c_to_s WHERE subs.id = s_id AND c_id = '{$_SESSION['id']}')";

if (!$all_subs = get_results($query))
	echo "<p>No additional subscriptions are available.</p>";
else {
	echo "<form action=\"$me?mode=add\" method=\"post\"><select name=\"subs\">";
	
	foreach ($all_subs as $row) {
		echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
	}
	
	echo "</select> <input type=\"submit\" name=\"butSubmit\" value=\"Add\" /></form>";

}



?>




<?php include("footer.php"); ?>