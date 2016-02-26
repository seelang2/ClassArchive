<?php
/**
 *	atlas.php - Truck status viewing app
 */

require('init.php');

include('header.php');

switch ($action) {
	case 'LIST': // get list of all trucks in service
		// get list of all trucks
		$query = 'SELECT trucks.id, trucks.number FROM trucks';

		$trucks = process_query($db, $query);
		if ($trucks === false) {
			// query error, bail
			break;
		}

		// display in list
		echo '<ul>';
		while($truck = $trucks->fetch_assoc()) {
			echo '<li><a href="atlas.php?action=view&id='.$truck['id'].'">'. $truck['number'] .'</a></li>';
		}
		echo '</ul>';
	break; // LIST

	case 'VIEW': // view truck detail information
		// verify id is present
		if (empty($id)) {
			// display feedback and bail
			echo '<p>Error: Invalid ID.</p>';
			break; // terminate case
		}
		// get truck info by id
		$query = "SELECT 
					trucks.number, 
					drivers.name AS driver, 
					clients.name AS client 
				  FROM trucks 
				  LEFT JOIN drivers ON trucks.driver_id = drivers.id 
				  LEFT JOIN clients ON trucks.client_id = clients.id 
				  WHERE trucks.id = '{$id}'
				 ";
		$truck = process_query($db, $query);
		if ($truck === false) break;
		$truck = $truck->fetch_assoc();

		// get location info 
		$query = "SELECT 
					activity.log_date, 
					activity.mile_post 
				  FROM activity 
				  WHERE activity.truck_id = {$id} 
				  ORDER BY activity.log_date DESC 
				  LIMIT 1 
				 ";
		$location = process_query($db, $query);
		if ($location === false) break;
		$location = $location->fetch_assoc();

		// display info
		?>
		<h1>Truck Details</h1>
		<h2>Truck #<?php echo $truck['number']; ?></h2>
		<p>
			<strong>Driver:</strong> 
			<span><?php echo $truck['driver']; ?></span>
		</p>
		<p>
			<strong>Client:</strong> 
			<span><?php echo $truck['client']; ?></span>
		</p>
		<p>
			<strong>Last Known Position:</strong> 
			Mile post 
			<span><?php echo $location['mile_post']; ?></span> 
			(as of <?php echo $location['log_date']; ?>)
		</p>
		<?php
	break; // VIEW

	case 'ACTIVITY': // view truck activity log

	break; // ACTIVITY
} // switch $action

include('footer.php');

?>