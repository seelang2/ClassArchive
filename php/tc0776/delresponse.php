<?php
require_once('config.php');

$qid = $_GET['qid'];
$id = $_GET['id'];

$query = "DELETE FROM q2r WHERE response_id = '$id' AND question_id = '$qid'";

$result = mysql_query($query);
if (!$result) {
	// error with query
	//echo "<p>Error performing query: " . mysql_error() . "<br />Query: $query</p>";
} else {
	// successfull add
	//echo "<p>Database was successfully updated.<br />Query: $query</p>";
}

header('Location: http://localhost/mng-questions.php?mode=edit&id=' . $qid);
exit;

?>