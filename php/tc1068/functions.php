<?php
/*
	functions.php - general function library
*/



function tableList($tablenames, $fieldlist, $headings, $extra_clauses = NULL) {

		// build query
		$query = 'SELECT ';
		
		$c = 1;
		foreach ($fieldlist as $field) {
			if ($c > 1) { $query .= ', '; }
			$query .= $field;
			$c++;
		}
		
		$query .= ' FROM ';

		$c = 1;
		foreach ($tablenames as $table) {
			if ($c > 1) { $query .= ', '; }
			$query .= $table;
			$c++;
		}
		
		if (!empty($extra_clauses)) $query .= ' ' . $extra_clauses;
		
		// send query
		$results = mysql_query($query);
		if (!$results) {
			// query error
			echo "<p>Query error. Query used:<br />$query</p>";
			return false;
		} else {
			if (mysql_num_rows($results) < 1) {
				// no rows returned from query
				return '<p>No rows present.</p>';
				
			} else {
				// display rows in a table
				$output = '<table><tbody><tr>';
				
				foreach ($headings as $colname) {
					$output .= '<th>' . $colname . '</th>';
				}
				
				$output .= '</tr>';
				
				// loop through result rows
				while ($row = mysql_fetch_array($results)) {
					$output .= '<tr>';
					foreach ($fieldlist as $field) {
						$d = strpos($field, '.');
						if ($d !== false) { $field = substr($field, $d + 1); }
						
						$output .= '<td>' . $row[$field] . '</td>';
					}
					$output .= '</tr>';
				} // while
				
				$output .= '<tbody></table>';
				
				return $output;
			} // if num_rows
		} // if results
} // function



?>