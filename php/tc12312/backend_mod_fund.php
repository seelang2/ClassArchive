<?php
/**
 * Fund module
 */

// module-specific parameters
// boolean to determine whether or not to include pricing detail
$nopricing = isset($_GET['nopricing']) ? true : false;

// number of pricing records to retrieve
if (!empty($_GET['range'])) 
	$range = (int)$db->real_escape_string($_GET['range']);
else 
	$range = 1;

// possible actions: view/save/delete
switch($action) {
	case 'view':
		// if id is present, look up specific fund; otherwise get all
		/*
			data schema:
			{
				id, fundid, name, fee,
				pricing: [
					{ update_date, price_usd, price_gbp, price_euro, price_change}
				]
			}
		*/

		$query = 'SELECT id, fundid, name, fee FROM funds';
		if (!empty($id)) $query .= ' WHERE id = '.$db->real_escape_string($id);

		$results = $db->query($query);
		if (!$results) {
			// query error
			system_log('Query error: '.$db->error.' '.$query);
			output(['status' => 'Error', 'statusmsg' => 'Query error']);
		}

		// loop through fund data and build data response array
		$responseData = [];

		while ($fund = $results->fetch_assoc()) {
			if ($nopricing == false) {
				// get pricing data for fund
				$query = 'SELECT update_date, price_usd, price_usd_change, price_gbp, price_gbp_change, price_euro, price_euro_change FROM pricing WHERE fund_id = '.$fund['id'].' ORDER BY update_date DESC LIMIT '. $range;

				$pricing_results = $db->query($query);
				if (!$pricing_results) {
					// query error
					system_log('Query error: '.$db->error.' '.$query);
					output(['status' => 'Error', 'statusmsg' => 'Query error']);
				}
				// fetch entire result set as an array
				$fund['pricing'] = $pricing_results->fetch_all(MYSQLI_ASSOC);
			}

			$responseData[] = $fund;
		} // while funds

		// now output funds to user agent
		output(['status' => 'Ok', 'data' => $responseData]);
	break;
	case 'save':
		// if id is not present, create new record, otherwise edit existing

		// data fields will be in $_POST array
		$fundid = $_POST['fundid'];
		$name = $_POST['name'];
		$fee = $_POST['fee'];
		// don't forget to do any data validation and ALWAYS SANITIZE DATA

		if (empty($id)) {
			// insert new record
			$query = 'INSERT INTO ';
		} else {
			// update existing record
			$query = 'UPDATE ';
		}

		$query .= ' funds SET '.
								"fundid = '".$db->real_escape_string($fundid)."', ".
								"name = '".$db->real_escape_string($name)."', ".
								"fee = ".$db->real_escape_string($fee)." ";

		if (!empty($id)) $query .= ' WHERE id = '.$db->real_escape_string($id);

		$result = $db->query($query);
		if (!$result) {
			// error
			output(['status' => 'Error', 'statusmsg' => 'Error saving record']);
			break; 
		}
		// it worked
		output(['status' => 'Ok', 'statusmsg' => 'Record was saved']);


	break;
	case 'delete':
		// if id is not present, bail
		if (empty($id)) {
			output(['status' => 'Error', 'statusmsg' => 'Invalid id']);
			break; // terminate case
		}
		// delete fund record
		$query = 'DELETE FROM funds WHERE id = '.$db->real_escape_string($id);
		$result = $db->query($query);
		if (!$result) {
			// error
			output(['status' => 'Error', 'statusmsg' => 'Error deleting record']);
			break; 
		}
		// delete fund pricing data
		$query = 'DELETE FROM pricing WHERE fund_id = '.$db->real_escape_string($id);
		$result = $db->query($query);
		if (!$result) {
			// error
			output(['status' => 'Error', 'statusmsg' => 'Error deleting record']);
			break; 
		}
		// delete fund entry from client info
		$query = 'DELETE FROM clients_funds WHERE fund_id = '.$db->real_escape_string($id);
		$result = $db->query($query);
		if (!$result) {
			// error
			output(['status' => 'Error', 'statusmsg' => 'Error deleting record']);
			break; 
		}
		// it worked
		output(['status' => 'Ok', 'statusmsg' => 'Record was deleted']);
	break;
	default:
		output(['status' => 'Error', 'statusmsg' => 'Invalid action']);
	break;
}

