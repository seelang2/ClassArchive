<?php
// demoe-config.php - config file

include ("functions.php");

$me = $_SERVER[PHP_SELF];

$db = db_connect('localhost', 'demoe', 'root', 'portable');

// define status array
$visit_status = array(
				'Open',
				'Paid',
				'Referred',
				'Followup',
				'Past Due'
);

?>