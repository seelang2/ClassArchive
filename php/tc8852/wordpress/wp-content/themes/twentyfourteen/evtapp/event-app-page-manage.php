<h2>Manage Events</h2>
<?php
/*
ref:
http://www.kylejlarson.com/blog/2013/how-to-create-a-wordpress-database-table/
http://codex.wordpress.org/Class_Reference/wpdb

*/

//echo '<h2>$_GET:</h2><pre>'.print_r($_GET,true).'</pre>';
//echo '<h2>$_SERVER:</h2><pre>'.print_r($_SERVER,true).'</pre>';

// set action parameter
$action = empty($_GET['action']) ? 'list' : strtolower($_GET['action']);

switch($action) {
	default:
	case 'list':
		get_template_part( 'evtapp/event-app-page', 'manage-list' );
	break; // list

	case 'edit': 
		if (empty($_GET['id'])) {
			echo '<p><strong>Error:</strong> Invalid ID.</p>';
			break;
		};
		
		global $evtappId, $evtappData; // set up global vars
		
		$evtappId = esc_sql($_GET['id']); // always sanitize data used in raw queries!
		
		// retrieve record
		$evtappData = $wpdb->get_results("SELECT * FROM evtapp_events WHERE id = '$evtappId'");
		//echo '<pre>'.print_r($data,true).'</pre>';
		$evtappData = $evtappData[0]; // reset array to first element only
		
	// break intentionally left out
	
	case 'add':
		get_template_part( 'evtapp/event-app-page', 'manage-add' );
	break; // add

	case 'save':
		// save record to database
		if (empty($_POST)) break; // bail out of case if no data to save

		if (!empty($_GET['id'])) 
			$evtappId = esc_sql($_GET['id']); 
			else unset($evtappId);
		
		$data = array(
			'event_date' => $_POST['event_date'],
			'event_name' => $_POST['event_name'],
			'duration' => $_POST['duration'],
			'capacity' => $_POST['capacity']
		);
		
		$dataF = array(
			'%s',
			'%s',
			'%d',
			'%d'
		);

		if (isset($evtappId)) {
			// updating existing record
			$result = $wpdb->update(
				'evtapp_events',
				$data,
				array('ID' => $evtappId),
				$dataF,
				array( '%d' )
			); 
		} else {
			// inserting new record
			$result = $wpdb->insert(
				'evtapp_events',
				$data,
				$dataF
			); 
		}
		
		echo '<pre>'.print_r($data,true).'</pre>';
		
		if ($result === false) {
			echo '<p>The record was not saved.</p>';
		} else {
			echo '<p>The record has been saved.</p>';
		}	
	break; // save
}



?>