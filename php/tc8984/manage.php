<?php
require('init.php');

// set parameters from URI
$table = empty($_GET['table']) ? null : strtolower($_GET['table']);
$action = empty($_GET['action']) ? 'LIST' : strtoupper($_GET['action']);
$id = empty($_GET['id']) ? null : $_GET['id'];

if (empty($table)) {
	exit('<p>Invalid table specified.</p>');
}

include('header.php');
?>
<h2><?php echo strtoupper($table); ?> Management</h2>
<p>
	<a href="manage.php?table=<?php echo $table; ?>&action=list">List records</a> | 
	<a href="manage.php?table=<?php echo $table; ?>&action=add">Add new record</a>
</p>

<?php

switch($action) {
	case 'EDIT': // edit existing record
		if (empty($id)) {
			echo '<p>Invalid record specified.</p>';
			break; // bail if no id is set
		}
		// retrieve specific record
		$query = 'SELECT ' . implode(',', $schema[$table]['fields']) . 
				 ' FROM ' . $table .
				 " WHERE id = '{$id}'";
		
		$result = $db->query($query);

		if ($result === false) {
			// query error
			echo '<p>Query Error. Original query: '.$query.'</p>';
			$dbErr = $db->errorInfo();
			dumpvar($dbErr);
		}

		// get record
		$row = $result->fetch(PDO::FETCH_ASSOC);

		// this break intentionally left off

	case 'ADD': // add new record - display data entry form
?>
	<h1><?php echo strtoupper($table); ?> Data Entry Form</h1>

	<form action="manage.php?table=<?php echo $table; ?>&action=save<?php 
		echo empty($id) ? '' : '&id='.$id;
	?>" method="post">
		<?php 
		$count = count($schema[$table]['fields']);

		for($c = 0; $c < $count; $c++) {
			$label = $schema[$table]['labels'][$c];
			$field = $schema[$table]['fields'][$c];

			if ($field == 'id') continue; // skip the rest and go the the next item
		?>
			<p>
				<span><?php echo $label; ?>:</span>
				<input name="<?php echo $field; ?>" type="text" 
				value="<?php echo empty($id) ? '' : $row[$field]; ?>"
				 />
			</p>
		<?php
		}
		?>
		<p><input type="submit" value="Save" />
	</form>
	
<?php
	break; // ADD

	case 'SAVE': // save data to database
		//dumpvar($_POST);

		// build query
		$query = empty($id) ? 'INSERT INTO ' : 'UPDATE ';

		$query .= ' ' . $table . ' SET ';

		// loop through form fields
		$c = 0;
		foreach ($_POST as $fieldName => $fieldValue) {
			$query .=  $c > 0 ? ',' : '';
			$c++;
			// ALWAYS SANITIZE USER DATA USED IN SQL QUERIES!
			$query .= " $fieldName = " . $db->quote($fieldValue) . " ";
		} 

		if (!empty($id)) $query .= " WHERE id = '{$id}' ";

		//echo $query;

		// send query to DB server
		$result = $db->query($query);

		// check result
		if ($result === false) {
			// query error
			echo '<p>Query Error. Original query: '.$query.'</p>';
			$dbErr = $db->errorInfo();
			dumpvar($dbErr);

			// display message based on error code
			switch(true) {
				// Duplicate entry on unique index
				case $dbErr[0] == '23000' && $dbErr[1] == '1062':
					echo '<p><b>Error:</b> The site ID you entered already exists.</p>';
				break;

			} // switch

			break; // terminate case
		} // if result

		// process results (check how many rows processed in this case)
		if ($result->rowCount() > 0) {
			// success! display feedback
			echo '<p>The record has been saved.</p>';
		}

	break; // SAVE

	default: 
	case 'LIST': // display list of records

		// get the table data
		$query = 'SELECT ' . implode(',', $schema[$table]['fields']) . ' FROM ' . $table;

		$results = $db->query($query);

		if ($results === false) {
			// query error
			echo '<p>Query Error. Original query: '.$query.'</p>';
			$dbErr = $db->errorInfo();
			dumpvar($dbErr);
		}

		// process result set

		// build table head
		echo '<table><tbody><thead><tr>';

		// loop through label array for table
		foreach ($schema[$table]['labels'] as $label) {
			echo '<th>'. $label .'</th>';
		}
		
		echo '<th>Options</th>';
		echo '</tr></thead>';

		// loop through result set grabbing a row at a time
		while($row = $results->fetch(PDO::FETCH_ASSOC)) {
			echo '<tr>';

			// loop through fields array and create field columns
			foreach ($schema[$table]['fields'] as $fieldName) {
				echo '<td>'. $row[$fieldName] .'</td>';
			}

			echo '<td>' .
						'<a href="manage.php?table=' . $table . '&action=edit&id=' . $row['id'] . '">Edit</a> | ' .
						'<a href="manage.php?table=' . $table . '&action=delete&id=' . $row['id'] . '">Delete</a> ' .
					'</td>' .
				 '</tr>';
		}

		echo '</tbody></table>';
	break; // LIST

	case 'DELETE': // delete record
		if (empty($id)) {
			echo '<p>Invalid record specified.</p>';
			break; // bail if no id is set
		}
		// delete specific record
		$query = "DELETE FROM facilities WHERE id = '{$id}'";
		$result = $db->query($query);

		if ($result === false) {
			// query error
			echo '<p>Query Error. Original query: '.$query.'</p>';
			$dbErr = $db->errorInfo();
			dumpvar($dbErr);
		}

		// process results (check how many rows processed in this case)
		if ($result->rowCount() > 0) {
			// success! display feedback
			echo '<p>The record has been deleted.</p>';
		}

	break; // DELETE


} // switch $action

include('footer.php');
?>