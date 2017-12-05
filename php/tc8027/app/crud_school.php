<?php
require('setup.php');

include('header.php');

/****
Basic processing page that displays/saves table data

 */
 

switch($action) {
	default:
	case 'LIST':
		// display table data
		
		// build query
		$query = 'SELECT id, name FROM schools';
		
		// send query to server
		$results = $dbh->query($query);
		
		if ($results === false) {
			// display feedback
			echo '<p>There was a query error.</p>';
			break; // terminate case
		}
		
		if ($results->rowCount() < 1) {
			echo '<p>No data in table.</p>';
			break;
		}
		
		while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
			echo '<p>' . $row['id'] . ' => ' . $row['name'] . 
			' <a href="crud_school.php?action=edit&id='.$row['id'].'">Edit</a>' .
			'</p>';
		}
		
		/*
		$data = $results->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($data);
		*/
	
	break; 

	case 'SAVE':
		// save posted data to table
		if (empty($_POST)) {
			echo '<p>No data sent to server.</p>';
			break;
		}
		
		// ALWAYS sanitize data before using in a query
		$name = $dbh->quote($_POST['name']);
		
		// note that the quotes around the string are omitted
		// because PDO::quote() will add them if necessary
		$query = 'INSERT INTO schools SET ' .
				 "name = {$name} "; // using string interpolation
		
		$result = $dbh->query($query);
		
		if ($result === false) {
			// display feedback
			echo '<p>There was a query error.<br />'.$query.'</p>';
			break; // terminate case
		}
		if ($result->rowCount() != 1) {
			echo '<p>There was another error.</p>';
			break;
		}
		
		// otherwise display positive feedback
		echo '<p>The record has been saved.</p>';
	break;

}

include('footer.php');
