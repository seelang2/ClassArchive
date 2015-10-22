<?php
require_once('config.php');

include('header.php');

$customer_id = 1;
$survey_id = 1;

$query = "SELECT COUNT(*) AS count FROM questions WHERE survey_id = '$survey_id'";
$result = @mysql_query($query);
$row = mysql_fetch_array($result);
$question_count = $row['count'];



if (isset($_SESSION['current_question'])) {
	$_SESSION['current_question']++;
} else {
	$_SESSION['current_question'] = 1;
}

if ($_SESSION['current_question'] <= $question_count) {

	$query = "SELECT questions.id, questiontext, questions.type, responselist.id AS responseid, responsetext, responsevalue " .
			 " FROM questions, q2r, responselist " . 
			 " WHERE questions.survey_id = '$survey_id' AND questions.sortorder = '" . $_SESSION['current_question'] . "'" . 
			 " AND questions.id = q2r.question_id AND q2r.response_id = responselist.id" .
			 " ORDER BY questions.sortorder ASC, q2r.sortorder ASC";
	
	echo "<p>$query</p>";
	
	$results = @mysql_query($query);
	
	$response_list = '';
	while($row = mysql_fetch_array($results)) {
		$question_id = $row['id'];
		$question_text = $row['questiontext'];
		$question_type = $row['type'];
		
		$response_list .= '<p><input name="response_id" type="radio" value="' . $row['responseid'] . '" />' . 
						  $row['responsetext'] . '</p>';
	
	}
	
	
	echo '<p>Question ' . $_SESSION['current_question'] . '</p>';
	
	echo '<p>' . $question_text . '</p>';
	
	echo '<form action="postanswer.php" method="post">';
	
	switch($question_type) {
		case '1':
			echo $response_list;
		break;
		case '2':
			echo '<textarea name="textanswer" cols="50" rows="4"></textarea>';
		break;
	}
	
	echo '<input type="hidden" name="qid" value="' . $question_id . '" />';
	echo '<input type="hidden" name="cid" value="' . $customer_id . '" />';
	echo '<input type="submit" />';

} else {
	// no more questions, do something else
	echo '<p>The survey is complete. Thank you.</p>';
	
	
} // if question count

include('footer.php');
?>