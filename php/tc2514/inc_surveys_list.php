<?php
		// build query
		$query =   'SELECT surveys.id AS survey_id, surveys.name, count(surveyqs.id) AS qcount, count(user_id) AS rcount 
					FROM surveys
					LEFT JOIN surveyqs ON (surveyqs.survey_id = surveys.id)
					LEFT JOIN
					(SELECT user_id, survey_id
					FROM responses, surveyqs
					WHERE responses.surveyq_id = surveyqs.id
					AND surveyqs.survey_id = 1) AS users ON users.survey_id = surveys.id';
		
		
		// send query to server
		$results = @mysql_query($query);
		// check results
		if (!$results) {
			// query error
			echo '<p>There was a query error. No soup for you! *snap*</p>';
			break;
		}
		if (mysql_num_rows($results) == 0) {
			echo '<p>No records found.</p>';
			break;
		}
		
		echo '<table><tbody>' .
			 '<tr>' .
			 	'<th>ID</th>' .
			 	'<th>Name</th>' .
			 	'<th># Qs</th>' .
			 	'<th># Rs</th>' .
			 	'<th>Options</th>' .
			 '</tr>';
		while($row = mysql_fetch_array($results)) {
			echo '<tr>' .
					'<td>'.$row['survey_id'].'</td>' .
					'<td>'.$row['name'].'</td>' .
					'<td>'.$row['qcount'].'</td>' .
					'<td>'.$row['rcount'].'</td>' .
					'<td>' .
						'<a href="'.$_SERVER['PHP_SELF'].'?action=edit&sid='.$row['id'].'">Edit</a>' . ' | ' .
						'<a href="'.$_SERVER['PHP_SELF'].'?action=delete&sid='.$row['id'].'" onclick="return confirm(\'Are you sure you want to delete this record?\');">Delete</a>' .
					'</td>' .
				 '</tr>';
		}
		echo '</tbody></table>';
