<?php 
require_once('config.php');
include('header.php'); ?>

<p>
	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=list">List Records</a>&nbsp;|&nbsp;
	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=add">Add New Record</a>&nbsp;|&nbsp;
</p>


<?php


/*

// connect to db server
$dbcnx = @mysql_connect('localhost', 'root', 'portable');

if (!$dbcnx) exit('<p>Error connecting to database server.</p>');

// select database
$dbh = @mysql_select_db('tc776', $dbcnx);

if (!$dbh) exit('<p>Error selecting database.</p>');

*/



$mode = 'LIST'; // default setting
if (!empty($_GET['mode'])) $mode = strtoupper($_GET['mode']);
if (!empty($_GET['id'])) $id = $_GET['id']; else unset($id);

switch($mode)
{
	case 'LIST':
		
		// build query
		$query = "SELECT questions.id, surveys.name, questiontext, sortorder FROM questions, surveys " . 
				 "WHERE surveys.id = questions.survey_id ORDER BY surveys.name, sortorder ASC";
		
		// send query
		$results = @mysql_query($query);
		
		// check response
		if (!$results) {
			// error with query
			echo "<p>Error performing query: " . mysql_error() . "<br />Query: $query</p>";
		} else {
			// query ok, continue
			if (mysql_num_rows($results) < 1) {
				// no rows present
				echo "<p>No rows present.</p>";
			} else {
				// process results
				
				echo '<table>' . 
					 '<tr>' . 
					 '<th>Survey</th>' .
					 '<th>Question</th>' .
					 '<th>Sortorder</th>' .
					 '<th>Options</th>' .
					 '</tr>';
				
				$c = 1;
				while($row = mysql_fetch_array($results)) {
					echo '<tr ';
					if ($c % 2 == 0) echo 'class="evenrow"'; else echo 'class="oddrow"';
					echo '>';
					$c++;

					echo '<td>' . $row['name'] . '</td>' . 
						 '<td>' . $row['questiontext'] . '</td>' . 
						 '<td>' . $row['sortorder'] . '</td>' . 
						 '<td>' .
						 	'<a href="' . $_SERVER['PHP_SELF'] . '?mode=edit&id=' . $row['id'] . '">Edit</a> | ' .
						 	'<a href="' . $_SERVER['PHP_SELF'] . '?mode=delete&id=' . $row['id'] . '">Delete</a>' .
						 '</td>' . 
						 '</tr>';
				}
				
				echo '</table>';
				
			} // num rows
		} // if results
	
	break;
	
	case 'DELETE':
		if (!isset($id)) {
			// no id passed - display error
			echo "<p>No valid ID is present.</p>";
		} else {
			// continue with delete operation
			
			$query = "DELETE FROM questions WHERE id = '$id'";
			
			$result = @mysql_query($query);
			if (!$result) {
				// error with query
				echo "<p>Error performing query: " . mysql_error() . "<br />Query: $query</p>";
			} else {
				if (mysql_affected_rows() < 1) {
					// no rows deleted
					echo '<p>Warning: No rows were deleted.</p>';
				} else {
					echo '<p>Record was deleted successfully.</p>';
				}
			}
		}
	break;
	
	case 'EDIT':
	
		$query = "SELECT * FROM questions WHERE id='$id' LIMIT 1";
		
		$result = @mysql_query($query);
		if (!$result || mysql_num_rows($result) != 1) {
			// no row located
			echo '<p>The specified record could not be found.</p>';
		} else {
			// found row
			
			$row = mysql_fetch_array($result);
			
			$querystring = '?mode=processedit&id=' . $id;
		}
	
	case 'ADD':
	
		$query = "SELECT * FROM surveys";
		$results = @mysql_query($query);
		
		$survey_select = '<select name="survey_id">';
		
		while($select_row = mysql_fetch_array($results)) {
			$survey_select .= '<option value="' . $select_row['id'] . '"';
			if($select_row['id'] == $row['survey_id']) $survey_select .= ' selected="selected"';
			$survey_select .= '>' . $select_row['name'] . '</option>';
		}
		$survey_select .= '</select>';
		
		if (!isset($querystring)) $querystring = '?mode=processadd';
?>
		<form action="<?php echo $_SERVER['PHP_SELF'] . $querystring; ?>" method="post">
			<div>
				<label for="survey_id">Survey Name:</label>
				<?php echo $survey_select; ?>
			</div>
			<div>
				<label for="type">Question Type:</label>
				<select name="type">
					<option value="1" <?php echo ($row['type'] == 1) ? ' selected="selected" ' : NULL; ?>>Multiple Choice</option>
					<option value="2" <?php echo ($row['type'] == 2) ? ' selected="selected" ' : NULL; ?>>Text Answer</option>
				</select>
			</div>
			<div>
				<label for="questiontext">Question Text:</label>
				<input type="text" name="questiontext" value="<?php echo $row['questiontext']; ?>" size="50" maxlength="60" />
			</div>
			<div>
				<label for="sortorder">Sort Order:</label>
				<input type="text" name="sortorder" value="<?php echo $row['sortorder']; ?>" size="50" maxlength="60" />
			</div>
			<input type="submit" name="butSubmit" value="Add/Update Record" />
		</form>
<?php	
		if (isset($id)) {
			// display response listings associated with this question
			
			$query = "SELECT * FROM q2r, responselist WHERE q2r.response_id = responselist.id AND q2r.question_id = '$id' ORDER BY sortorder ASC";
			$results = @mysql_query($query);
			
			echo '<h2>Responses Associated</h2>';
			
			if (mysql_num_rows($results) > 0) {
				echo '<table>' . 
					 '<tr>' . 
					 '<th>Response Label</th>' .
					 '<th>Value</th>' .
					 '<th>Sortorder</th>' .
					 '<th>Options</th>' .
					 '</tr>';
				while($response_row = mysql_fetch_array($results)) {
					echo '<td>' . $response_row['responsetext'] . '</td>' . 
						 '<td>' . $response_row['responsevalue'] . '</td>' . 
						 '<td>' . $response_row['sortorder'] . '</td>' . 
						 '<td>' .
							'<a href="delresponse.php?id=' . $response_row['id'] . '&qid=' . $id . '">Delete</a>' .
						 '</td>' . 
						 '</tr>';
				}
				echo '</table>';
			}
			
			$query = "SELECT * FROM responselist";
			$results = @mysql_query($query);
			
			$response_select = '<select name="response_id">';
			
			while($select_row = mysql_fetch_array($results)) {
				$response_select .= '<option value="' . $select_row['id'] . '"';
				$response_select .= '>' . $select_row['responsetext'] . '</option>';
			}
			$response_select .= '</select>';
			
?>
			<form action="addresponse.php" method="post">
				<?php echo $response_select; ?>&nbsp;
				Sort Order: <input type="text" name="sortorder" />
				<input type="hidden" name="question_id" value="<?php echo $id; ?>" />
				<input type="submit" name="butSubmit" value="Add to question" />
			</form>
<?php

			
		}
		
	break;
	
	case 'PROCESSEDIT':
	
		if (!isset($id)) {
			echo '<p>No record specified. No soup for you!</p>';
			break;
		}
	
	case 'PROCESSADD':
	
		$formdata = array();
		foreach($_POST as $key => $value) {
			$formdata[$key] = escape($value);
		}
		
		reset($_POST);
		
		if (isset($id)) { 
			$query = 'UPDATE '; 
		} else { 
			$query = 'INSERT INTO '; 
		}
		
		$query .= 'questions SET ';
		
		$c=0;
		foreach($formdata as $column => $value) {
			if ($column != 'butSubmit') {
				if ($c > 0) $query .= ', ';
				$query .= "$column = '$value'";
				$c++;
			}
		}
		
		if (isset($id)) $query .= " WHERE id='$id'";
		
		$result = mysql_query($query);
		if (!$result) {
			// error with query
			echo "<p>Error performing query: " . mysql_error() . "<br />Query: $query</p>";
		} else {
			// successfull add
			echo "<p>Database was successfully updated.<br />Query: $query</p>";
		}
		
	break;


} // switch

include('footer.php'); 
?>