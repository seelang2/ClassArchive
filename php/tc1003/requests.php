<?php
require_once('config.php');

function listRecords() {
		global $permissionTypes;
		
		$query = 'SELECT requests.id, subject, request_date, firstname, lastname, name ' . 
				 'FROM requests, users, categories ' .
				 'WHERE user_id = users.id AND category_id = categories.id';
		
		if (!$results = mysql_query($query)) {
			// query error
			echo "Error processing query $query";
		} else {
			if (mysql_num_rows($results) < 1) {
				echo '<p>No rows present.</p>';
			} else {
				// process result set
				
				echo '<table cellpadding="3" cellspacing="0">';
				echo '<tr><th>ID</th><th>Name</th><th>Subject</th><th>Category</th><th>Request Date</th><th>Options</th></tr>';
				while($row = mysql_fetch_array($results)) {
					echo '<tr>' .
						'<td>' . $row['id'] . '</td>' .
						'<td>' . $row['lastname'] . ', ' . $row['firstname'] . '</td>' .
						'<td>' . $row['subject'] . '</td>' .
						'<td>' . $row['name'] . '</td>' .
						'<td>' . $row['request_date'] . '</td>' .
						'<td>' . 
						'<a href="' . $_SERVER['PHP_SELF'] . '?mode=edit&id=' . $row['id'] . '">Edit</a> | ' .
						'<a href="' . $_SERVER['PHP_SELF'] . '?mode=delete&id=' . $row['id'] . '">Delete</a>' .
						'</td>' .
						'</tr>';
				}
				echo '</table>';
			}
		}
}



$mode = 'DEFAULT';
if (!empty($_GET['mode'])) $mode = strtoupper($_GET['mode']);
if (!empty($_GET['id'])) $id = mysql_real_escape_string($_GET['id']); else unset($id);


include('header.php');

?>

<p>
	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=list">List records</a> | 
	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=add">Add new record</a>
</p>

<?php


switch($mode) {
	default:
?>
		<h2>Main Menu</h2>
		
		<p><a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=list">View Requests</a></p>
		<p><a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=add">Add New Request</a></p>
<?php
	break;

	case 'LIST':
		listRecords();
	break;

	case 'UPDATE':
		if (!isset($id)) {
			// error
			echo 'No id present.';
			break;
		}
	
	case 'INSERT':
		if (isset($_POST['butSubmit'])) {
			// processing form data
			
			$validated = true;
			$errmsg = '';
			
			// run validation rules
			
			
			if ($validated) {
				
				if (isset($id)) $query = 'UPDATE '; else $query = 'INSERT INTO ';
				
				$query .= 'requests SET ';
				
				$c = 1;
				foreach ($_POST as $field => $value) {
					if ($field != 'butSubmit') {
						if ($c > 1) $query .= ', ';
						$value = mysql_real_escape_string($value);
						$query .= "$field = '$value'";
					}
					$c++;
				}
				
				if (isset($id)) $query .= " WHERE id = '$id'";
				
				$result = mysql_query($query);
				if (!$result) {
					// error occurred
					echo "Error processing query $query";
				} else {
					// process results
					echo 'Record successfully updated.';
					listRecords();
					
				}
				
			} else {
				// validation failed
				echo "The following error(s) have occurred:<br />$errmsg" .
					 "<br />Please click the Back button on your browser to correct.";
			}
				
		} else {
			// no form data posted
			echo '<p>Error: No form data present.</p>';
		}
	break;

	case 'EDIT':
		if (!isset($id)) {
			// error
			echo 'No ID specified.';
			redirect($base_url . $_SERVER['PHP_SELF']);
		} else {
			$query = "SELECT lastname, firstname, user_id, request_date, subject, description, category_id " .
					 " FROM requests, users WHERE requests.id = '$id' AND user_id = users.id";
			$result = mysql_query($query);
			if (!$result || mysql_num_rows($result) != 1) {
				// error
				echo "Error processing query $query";
				break;
			} else {
				$row = mysql_fetch_array($result);
				$newmode = 'update&id=' . $id;
			}
		}
	
	case 'ADD':
		// display entry form

		// check to see if this is an update
		$fieldDisabled = '';
		if (isset($id)) {
			// do not allow editing unless this is the request owner or has manager permission or better
			if ($row['user_id'] != $_SESSION['user_id'] || $_SESSION['permission'] < MANAGER) {
				$fieldDisabled = ' disabled="disabled" class="disabled" ';
			}
		}

		if (!isset($newmode)) $newmode = 'insert';
?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?mode=<?php echo $newmode; ?>" method="post">
			<div>
			<label>Requested By:</label>
			<?php echo $row['firstname'] . ' ' . $row['lastname']; ?>
			</div>
			<div>
			<label for="request_date">Request Date:</label>
			<input type="text" name="request_date" 
				<?php echo $fieldDisabled; ?>
				value="<?php echo (isset($row['request_date'])) ? $row['request_date'] : date('Y-m-d H:i:s'); ?>" 
				size="50" maxlength="100" 
			/>
			</div>

			<div>
			<label for="category_id">Category:</label>
<?php

			echo '<select name="category_id" ' . $fieldDisabled . ' >';

			$query = "SELECT * from categories";
			if (!$results = @mysql_query($query)) {
				// query error
			} else {
				if (mysql_num_rows($results) < 1) {
					echo '<option value="">No Categories Present</option>';
				} else {
					while ($cat = mysql_fetch_array($results)) {
						echo '<option value="' . $cat['id'] . '"';
						if ($cat['id'] == $row['category_id']) echo ' selected="selected"';
						echo '>' . $cat['name'] . '</option>';
					}
				}
			}

			echo '</select>';
?>
			</div>

			<div>
			<label for="subject">Subject:</label>
			<input type="text" <?php echo $fieldDisabled; ?> name="subject" value="<?php echo $row['subject']; ?>" size="50" maxlength="100" />
			</div>
			<div>
			<label for="description">Description:</label>
			<textarea name="description" <?php echo $fieldDisabled; ?> rows="10" cols="50"><?php echo $row['description']; ?></textarea>
			</div>
			
			<input type="hidden" <?php echo $fieldDisabled; ?> name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />

<?php
		if ($fieldDisabled == '') {
?>		
			<input name="butSubmit" 
				 type="submit" value="Enter Record" 
			/>
<?php
}
?>
		</form>
		
		<h2>Comments</h2>
<?php 
		// display comments for existing records only
		if (isset($id)) {
			$query = "SELECT c.id, c.comment_date, c.user_id, c.comment, c.parent_id, firstname, lastname " .
					 "FROM comments AS c, users " .
					 "WHERE c.user_id = users.id AND c.request_id = '$id' ";
			$results = @mysql_query($query);
			if (!$results) {
				// query error
			} else {
				if (mysql_num_rows($results) < 1) {
					echo "<p>No comments</p>";
				} else {
					// comments present
					while($comment = mysql_fetch_array($results)) {
						// loop and display comments
						echo '<div class="comment">';
						echo '<p>Posted ' . $comment['comment_date'] . 
							 ' by ' . $comment['firstname'] . $comment['lastname'] .
							 '</p>';
						echo '<p>' . $comment['comment'] . '</p>';
						echo '</div>';
					}
				}
			}
			
			//echo "<p>Comment query: $query</p>";
			
			// display comment form
?>
			<h3>Add Comment</h3>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>?mode=insertcomment" method="post">
				<input type="hidden" name="comment_date" value="<?php echo date('Y-m-d H:i:s'); ?>" />
				<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
				<input type="hidden" name="request_id" value="<?php echo $id; ?>" />
				<input type="hidden" name="parent_id" value="" />
				<textarea name="comment" cols="50" rows="6"></textarea>
				<input type="submit" name="butSubmit" value="Add Comment" />
			</form>
<?php			
		}
	
	
	break; // ADD
	
	case 'DELETE':
		// check user mermission - must be manager or better
		if ($_SESSION['permission'] > BASIC_USER) {
			if (!isset($id)) {
				// no id present, display error
				echo 'No id present.';
				break;
			} else {
				// process delete
				$query = "DELETE FROM requests WHERE id = '$id'";
				if (!$result = mysql_query($query)) {
					// error during delete
					echo "Error processing query $query";
					break;
				} else {
					// successful delete
					echo 'Record successfully deleted.';
					//listRecords();
				}
			}
		} else {
			// not enough permissions to do that.
			echo '<p>You do not have permissions to do that.</p>';
		}
		listRecords();
		
	break;
	
	case 'INSERTCOMMENT':
		if (isset($_POST['butSubmit'])) {
			// processing form data
			
			$validated = true;
			$errmsg = '';
			
			// run validation rules
			if (empty($_POST['parent_id'])) unset($_POST['parent_id']);
			
			if ($validated) {
				
				if (isset($id)) $query = 'UPDATE '; else $query = 'INSERT INTO ';
				
				$query .= 'comments SET ';
				
				$c = 1;
				foreach ($_POST as $field => $value) {
					if ($field != 'butSubmit') {
						if ($c > 1) $query .= ', ';
						$value = mysql_real_escape_string($value);
						$query .= "$field = '$value'";
					}
					$c++;
				}
				
				if (isset($id)) $query .= " WHERE id = '$id'";
				
				$result = mysql_query($query);
				if (!$result) {
					// error occurred
					echo "Error processing query $query";
				} else {
					// process results
					echo 'Record successfully updated.';
					//listRecords();
/*					
					$to      = 'seelang2@gmail.com';
					$subject = 'New Comment';
					$message = "A new comment was posted\r\n" .
								"to your request #xxx\r\n";
					$headers = 'From: chris@sitebabble.net' . "\r\n";
					
					if (mail($to, $subject, $message, $headers)) {
						echo '<p>Email sent ok!</p>';
					} else {
						echo '<p>There was a problem sending the email message.</p>';
					}
*/					
				}
				
			} else {
				// validation failed
				echo "The following error(s) have occurred:<br />$errmsg" .
					 "<br />Please click the Back button on your browser to correct.";
			}
				
		} else {
			// no form data posted
			echo '<p>Error: No form data present.</p>';
		}
	break;



} // switch $mode

include('footer.php'); 
?>