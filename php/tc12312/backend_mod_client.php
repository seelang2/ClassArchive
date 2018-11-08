<?php
/**
 * Client module
 */

// possible actions: view/save/delete
switch($action) {
	case 'view':
		$query = 'SELECT '
	break;
	case 'save':

	break;
	case 'delete':
		// if id is not present, bail
		if (empty($id)) {
			output(['status' => 'Error', 'statusmsg' => 'Invalid id']);
			break; // terminate case
		}

		// delete client record
		$query = 'DELETE FROM clients WHERE id = '.$db->real_escape_string($id);
		$result = $db->query($query);
		if (!$result) {
			// error
			output(['status' => 'Error', 'statusmsg' => 'Error deleting record']);
			break; 
		}
		// delete clients entry from client info
		$query = 'DELETE FROM clients_funds WHERE client_id = '.$db->real_escape_string($id);
		$result = $db->query($query);
		if (!$result) {
			// error
			output(['status' => 'Error', 'statusmsg' => 'Error deleting record']);
			break; 
		}

	break;
	default:
		output(['status' => 'Error', 'statusmsg' => 'Invalid action']);
	break;
} // switch $action

