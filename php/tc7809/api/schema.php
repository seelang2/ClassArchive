<?php
/*****
   schema.php - Data schema information
   Array structure that defines the collections
   and relationships of the database.
 **/
 
 // store collections in an array for lookup later on
// describes collection relationships
$schema = array(
	// Collection names
	'boats' => array(
		'primaryKey' => 'id',
		'tablename' => 'T_BOATS',
		'fields' => array(
			'id' => 'F_ID', 'location_id', 'name', 'capacity'
		),
		// Related collections
		'relationships' => array(
			'bookings' => array(
				'localKey' 		=> 'boats.id',
				'remoteKey' 	=> 'bookings.boat_id'
			),
			'categories' => array(
				// when using a link table, the local and remote key entries
				// refer to the fields in the link table corresponding to the
				// local and remote tables respectively
				'localKey' 		=> 'boatscategories.boat_id',
				'remoteKey' 	=> 'boatscategories.category_id',
				'linkTable' 	=> 'boatscategories'
			)
		)
	),
	'bookings' => array(
		'relationships' => array(
			'boats' => array(
				'localKey' 		=> 'bookings.boat_id',
				'remoteKey' 	=> 'boats.id'
			)
		)
	),
	'categories' => array(
		'relationships' => array(
			// remember to correct the bookings relationship data
			'bookings' => array(
				'localKey' 		=> 'boatscategories.boat_id',
				'remoteKey' 	=> 'boatscategories.category_id',
				'linkTable' 	=> 'boatscategories'
			),
			'boats' => array(
				'localKey' 		=> 'boatscategories.category_id',
				'remoteKey' 	=> 'boatscategories.boat_id',
				'linkTable' 	=> 'boatscategories'
			)
		)
	),
	'locations' => array()
);

