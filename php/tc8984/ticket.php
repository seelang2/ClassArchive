<?php
// sample user data
$user = array('id' => 2, 'permissions' => 10);

require('init.php');

// set parameters from URI
$action = empty($_GET['action']) ? 'LIST' : strtoupper($_GET['action']);
$id = empty($_GET['id']) ? null : $_GET['id'];

include('header.php');

switch($action) {
	case 'LIST': // display open tickets for current user
		// check permissions to determine what set of tickets to return

		switch (true) {
			case $user['permissions'] < 10: // originator
				$tickets = getTicketsByOriginator($db, $user['id']);
				$message = 'Viewing your opened tickets:';
			break;
			case $user['permissions'] < 100: // tech
				$tickets = getTicketsByTech($db, $user['id']);
				$message= 'Viewing tickets assigned to you:';
			break;

		} // switch

		//dumpvar($tickets);

		echo '<p>'.$message.'</p>';

		echo '<table><tbody><thead>' . 
				'<tr>' . 
					'<th>ID</th>' .
					'<th>Request Date</th>' .
					'<th>Facility</th>' .
					'<th>Status</th>' .
					'<th>Tech Assigned</th>' .
					'<th>Description</th>' .
					'<th>Options</th>' .
				'</tr>' .
			 '</thead>';

		// loop through result set grabbing a row at a time
		foreach ($tickets as $ticket) {
			echo '<tr>' .
					'<td>' . $ticket['ticket_id'] . '</td>' .
					'<td>' . $ticket['request_date'] . '</td>' .
					'<td>' . $ticket['facility'] . '</td>' .
					'<td>' . $enum['ticket_status'][$ticket['status']] . '</td>' .
					'<td>' . $ticket['tech'] . '</td>' .
					'<td>' . $ticket['description'] . '</td>' .
					'<td>' .
						'<a href="ticket.php?action=view&id=' . $ticket['ticket_id'] . '">View</a> | ' .
						'<a href="ticket.php?action=delete&id=' . $ticket['ticket_id'] . '">Delete</a> ' .
					'</td>' .
				 '</tr>';
		}

		echo '</tbody></table>';


	break; // LIST

	case 'VIEW': // view ticket
		if (empty($id)) {
			echo '<p>Invalid record specified.</p>';
			break; // bail if no id is set
		}

		// get specific ticket (with comment info)
		$ticket = getTicketById($db, $id);

		dumpvar($ticket);

		// display ticket/comment template
		include('inc_view_ticket.php');

	break;

} // switch action



include('footer.php');
?>