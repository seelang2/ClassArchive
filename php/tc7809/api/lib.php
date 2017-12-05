<?php
/*
	lib.php - library of helper functions, classes, etc.
*/

function pr($data) {
	return '<pre>' . print_r($data, true) . '</pre>';
}

// just a quick reusable/extendable way of returning a set query
function getQuery($params) {

	$querySet = array(
		'C' 	=> "SELECT * FROM {$params['col1']}",
		'CI'	=> "SELECT * FROM {$params['col1']} WHERE id = {$params['id1']}",
		'CIC' 	=> "SELECT {$params['col2']}.* FROM {$params['col1']} INNER JOIN {$params['col2']} ON {$params['localKey']} = {$params['remoteKey']} WHERE {$params['localKey']} = {$params['id1']}",
		'CC' 	=> "SELECT * FROM {$params['col1']} INNER JOIN {$params['col2']} ON {$params['localKey']} = {$params['remoteKey']}"
	);

	return $querySet[$pattern];
}