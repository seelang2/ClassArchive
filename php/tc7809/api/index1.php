<?php
// single point of entry for our web service

// define some basic config parameters
define('API_BASE_PATH', '/tc7809/api/');

// load additional modules
require('lib.php');

// store collections in an array for lookup later on
// describes collection relationships
$collectionSchema = array(
	// Collection names
	'boats' => array(
		'primaryKey' => 'id',
		'fields' => array('id', 'location_id', 'name', 'capacity');
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
	'categories',
	'locations'
);

// parse request URI into array of path segments
$pattern = '/'.preg_quote(API_BASE_PATH, '/').'/';
$request = preg_replace($pattern, '', $_SERVER['REQUEST_URI']);
$requestArray = explode('/', $request);

echo pr($requestArray);

// build query
$query = 'SELECT * ';

// while there are still parameters to process
	// extract the last parameters
	// is it a collection or identifier?
		// if it's a collection, add to from list
		// if it's an identifier, add to where list
		
		
		
	
		`
		

