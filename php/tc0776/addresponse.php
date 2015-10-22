<?php
require_once('config.php');

$formdata = $_POST;

$query = 'INSERT INTO '; 
$query .= 'q2r SET ';

$c=0;
foreach($formdata as $column => $value) {
	if ($column != 'butSubmit') {
		if ($c > 0) $query .= ', ';
		$query .= "$column = '$value'";
		$c++;
	}
}

$result = mysql_query($query);
if (!$result) {
	// error with query
	//echo "<p>Error performing query: " . mysql_error() . "<br />Query: $query</p>";
} else {
	// successfull add
	//echo "<p>Database was successfully updated.<br />Query: $query</p>";
}

header('Location: http://localhost/mng-questions.php?mode=edit&id=' . $formdata['question_id']);
exit;

?>