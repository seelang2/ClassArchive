<?php
/**
 * Database connectivity
 */
$db = @new mysqli(DB_HOSTNAME, DB_USER, DB_PASSWORD, DB_NAME);
if ($db->connect_error) {
	system_log('DB connection error: ' . $db->connect_error);
	//redirect(ERROR_GENERAL);
	output(['status' => 'Error', 'statusmsg' => 'Database error']);
}

