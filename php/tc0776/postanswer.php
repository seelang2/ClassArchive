<?php
require_once('config.php');

$question_id = $_POST['qid'];
$customer_id = $_POST['cid'];
$response_id = $_POST['response_id'];
if (!empty($_POST['textanswer'])) $textanswer = escape($_POST['textanswer']); else $textanswer = '';

$query = "INSERT INTO answers " .
		 "SET question_id = '$question_id', customer_id = '$customer_id', response_id = '$response_id', textanswer = '$textanswer'"; 

$result = mysql_query($query);
if (!$result) {
	// error with query
	//echo "<p>Error performing query: " . mysql_error() . "<br />Query: $query</p>";
} else {
	// successfull add
	//echo "<p>Database was successfully updated.<br />Query: $query</p>";
}

header('Location: http://localhost/runsurvey.php');
exit;

?>