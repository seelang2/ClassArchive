<?php
/*
	comment_svc.php - Messaging system backend service
	Auth: Chris Langtiw <chris@sitebabble.com>
	

*/

$limit = 10; // default limit

function escape($string) {
	return mysql_real_escape_string($string);
}

require_once "JSON.php";

$json = new Services_JSON();

if (!$dbcnx = @mysql_connect('localhost','root','xampp')) exit('Error: cannot connect to db');
if (!$dbh = @mysql_select_db('tc1945')) exit('Error: cannot select db');
$now = time(); // microtime(true); // get timestamp @ start of request

switch(strtoupper($_GET['action']))
{
	case 'LOGIN':
		if (empty($_POST['username'])) exit('Error: No username specified.');
		
		// check to see if login exists
		$query = "SELECT id, username FROM c_users WHERE username = '".escape($_POST['username'])."' LIMIT 1";
		$result = @mysql_query($query);
		if (!$result || mysql_num_rows($result) != 0) exit('Error: Username already in use.');
		
		// generate token
		$token = sha1(microtime()); // 40 char string
		
		// store login and token to db
		$query = "INSERT INTO c_users SET token = '$token', username = '".escape($_POST['username'])."'";
		$result = @mysql_query($query);
		if (!$result) exit('Error: Unable to save user.');
		
		// return(output) token to client
		echo $token;
	break;
	case 'LOGOUT':
		if (empty($_REQUEST['token'])) exit('Error: No token specified.');
		// remove login info from db
		$query = "DELETE FROM c_users WHERE token = '".escape($_REQUEST['token'])."'";
		$result = @mysql_query($query);
		// return success/fail message to client
		if (!$result) exit('Error: Unable to remove user.');
		exit('Ok');
	break;
	case 'ADDCOMMENT':
		// get comment and token
		if (empty($_REQUEST['token'])) exit('Error: No token specified.');
		if (empty($_POST['comment'])) exit('Error: No comment specified.');
		// lookup user
		$query = "SELECT id, username FROM c_users WHERE token = '".escape($_REQUEST['token'])."' LIMIT 1";
		$result = @mysql_query($query);
		if (!$result || mysql_num_rows($result) == 0) exit('Error: User not found.'.$query);
		$row = mysql_fetch_array($result);
		
		$userid = $row['id'];
		// add comment to db
		$query = "INSERT INTO c_messages SET user_id = '$userid', comment = '".
				 escape($_POST['comment'])."', comment_timestamp = '$now'";
		$result = @mysql_query($query);
		if (!$result) exit('Error: Unable to add comment.'.$query);
		//echo 'Ok. '.$query;
	//break;
	case 'GETCOMMENTS':
		if (empty($_REQUEST['token'])) exit('Error: No token specified.');
		if (!empty($_GET['limit'])) $limit = escape($_GET['limit']);
		// get user last req ts
		$query = "SELECT last_request_ts FROM c_users WHERE token = '".escape($_REQUEST['token'])."' LIMIT 1";
		$result = @mysql_query($query);
		if (!$result || mysql_num_rows($result) == 0) exit('Error: User not found.'.$query);
		$row = mysql_fetch_array($result);
		
		$last_request_ts = $row['last_request_ts'];
		// query messages newer than user's last request timestamp to limit
		$query = "SELECT comment_timestamp, username, comment FROM c_users, c_messages WHERE " .
				 "c_messages.user_id = c_users.id " .
				 " AND comment_timestamp >= '$last_request_ts' ".
				 " ORDER BY comment_timestamp DESC".
				 " LIMIT ".$limit;
		$results = @mysql_query($query);
		if (!$results || mysql_num_rows($results) == 0) exit('Error: Query error or no messages '.$query);
		
		// update user request timestamp
		$query = "UPDATE c_users SET last_request_ts = '$now' WHERE token = '".escape($_REQUEST['token'])."' ";
		$result = @mysql_query($query);
		if (!$result) exit('Error: Unable to update timestamp.'.$query);
		//echo 'Ok. '.$query;
		
		// return message data to client
		
		$result_array = array();
		while ($row = mysql_fetch_array($results,MYSQL_ASSOC)) {
			$result_array[] = $row;
		}
		
		//echo '<pre>' . print_r($result_array, true) . '</pre>';
		$out = $json->encode($result_array);
		echo $out;
	break;
	default:
		echo 'Error: Invalid action specified.';
	break;
}

?>