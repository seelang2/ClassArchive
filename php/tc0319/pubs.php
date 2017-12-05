<?php
require_once("config.php");

if ( isset($_GET['mode']) && $_GET['mode'] != '' ) $mode = strtoupper($_GET['mode']); else $mode = 'LIST';

include("header.php");

?>
<p>
<a href="<?php echo $me; ?>?mode=showform">Add publication</a> |
<a href="<?php echo $me; ?>?mode=list">List publications</a>
</p>

<?php

switch($mode)
{
	case 'EDIT':
		if ( isset($_GET['id']) ) $id = escape($_GET['id']);
		
		$query = "SELECT name, description, author_id FROM publications WHERE id = $id";
		
		$result = mysql_query($query);
		if (!$result) {
			echo "<p>No record matching id.</p>";
		} else {
			$row = mysql_fetch_array($result);
			$formmode = "editprocess&id=$id";
		}

	case 'SHOWFORM':
		if (!isset($formmode)) $formmode = 'process';
		
		// build user select dropdown
		$select_user = "<select name=\"author_id\">";
		
		$query2 = "SELECT id, firstname, lastname FROM users";
		$result2 = mysql_query($query2);
		if (!$result2) {
			$select_user .= "<option value=\"\" selected=\"selected\">No Authors Available</option>";
		} else {
			while($users = mysql_fetch_array($result2)) {
				$select_user .= "<option value=\"{$users['id']}\"";
				if ($users['id'] == $row['author_id']) $select_user .= "selected=\"selected\"";
				$select_user .= ">{$users['firstname']} {$users['lastname']}</option>";
			}
		}
		$select_user .= "</select>";
?>
		<form action="<?php echo $me; ?>?mode=<?php echo $formmode; ?>" method="post">
			<table border="0" cellpadding="2" cellspacing="0">
			<tr><td>Publication Name: </td><td><input type="text" name="name" value="<?php echo $row['name']; ?>" size="50" maxlength="75" /></td></tr>
			<tr><td>Description: </td><td><input type="text" name="description" value="<?php echo $row['description']; ?>" size="50" maxlength="255" /></td></tr>
			<tr><td>Author: </td><td><?php echo $select_user; ?></td></tr>
			<tr><td colspan="2"><input type="submit" value="Submit Record" /></td></tr>
			</table>
		</form>

<?php 
	break;
	
	case 'EDITPROCESS':
		if ( isset($_GET['id']) ) $id = mysql_real_escape_string($_GET['id']);
	
	case 'PROCESS':
		if ( isset($_POST['name']) ) $name = mysql_real_escape_string($_POST['name']);
		if ( isset($_POST['description']) ) $description = mysql_real_escape_string($_POST['description']);
		if ( isset($_POST['author_id']) ) $author_id = mysql_real_escape_string($_POST['author_id']);

		$create_date = date('Y-m-d');
		
		if (isset($id)) $query = "UPDATE"; else $query = "INSERT INTO";
		
		$query .= " publications SET name = '$name'," .
				 " description = '$description'," .
				 " author_id = '$author_id'," .
				 " create_date = '$create_date'";
		
		if (isset($id)) $query .= " WHERE id = $id";
		
		$result = @mysql_query($query);
		
		if (!$result) {
			// do your preferred error handling routine here
			echo '<p>Error creating or updating new record.</p>';
			echo "<p>Query used: $query</p>";
		} else {
			// display happy success message
			echo '<p>Created or updated record in database.</p>';
		}
		
	break;
	
	case 'LIST':
	default:
	
		$query = "SELECT p.id, p.name, p.description, p.create_date, u.firstname, u.lastname FROM publications AS p, users AS u WHERE p.author_id = u.id";
		
		$result = mysql_query($query);
		
		if (!$result) {
			// do error checking
			echo "<p>No Publications Available</p>";
		
		} else {
			// process results
			
			echo "<table>" .
				 "<tr><td>ID</td><td>Name</td><td>Description</td><td>Author</td><td>Created</td><td>Options</td></tr>";
			while($row = mysql_fetch_array($result)) {
				echo "<tr>" . 
					 "<td>" . $row['id'] . "</td>" . 
					 "<td>" . $row['name'] . "</td>" . 
					 "<td>" . $row['description'] . "</td>" . 
					 "<td>" . $row['firstname'] . ' ' . $row['lastname'] . "</td>" . 
					 "<td>" . $row['create_date'] . "</td>" . 
					 "<td><a href='$me?mode=edit&id=" . $row['id'] . "'>Edit</a>&nbsp;" .
					 "<a href='$me?mode=delete&id=" . $row['id'] . "' onClick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a></td>" .
					 "</tr>";
			}
			echo "</table>";
			
		}
		
		// echo "<p><a href='export.php' target='_blank'>Click here to export this list as a CSV</a></p>";
	
	break;
	
	case 'DELETE':
		if ( isset($_GET['id']) ) $id = mysql_real_escape_string($_GET['id']);
		
		$query = "DELETE FROM publications WHERE id = $id";
		
		$result = mysql_query($query);
		
		if (!$result) {
			// something went wrong
			echo "<p>Error attempting to delete record from database.</p>";
			echo "<p>Query used was $query</p>";
		} else {
			echo "<p>Record was deleted successfully.</p>";
		}

	break;
	
} // switch


include("footer.php");
?>