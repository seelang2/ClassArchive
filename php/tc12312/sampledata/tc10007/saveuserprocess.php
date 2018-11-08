<?php
require_once('init.php');

//echo '<pre>'.print_r($_POST,true).'</pre>';

// validation/ sanitization stuff goes here
$username = $db->real_escape_string($_POST['username']);
if (!empty($_POST['password'])) $password = sha1($db->real_escape_string($_POST['password']) . SECURITY_SALT);
$name = $db->real_escape_string($_POST['name']);
$phone = $db->real_escape_string($_POST['phone']);
$email = $db->real_escape_string($_POST['email']);
$status = $db->real_escape_string($_POST['status']);
$type = $db->real_escape_string($_POST['type']);

// build query

$query = empty($id) ? 'INSERT INTO ': 'UPDATE ';

$query .= ' users SET ' .
	"username = '$username', " .
	(!empty($password) ? "password = '$password', ": '') .
	"name = '$name', " .
	"phone = '$phone', " .
	"email = '$email', " .
	"status = $status, " .
	"type = $type ";

$query .= empty($id) ? '': " WHERE id = $id";

$result = $db->query($query);
if (!$result) {
	// houston we have a problem...
	echo '<p>'.$query.'</p>';
	return;
}

// success!
$_SESSION['FLASH'] = 'The record has been saved.';
$location = 'index.php?controller=users&action=';
$location .= empty($id) ? 'list' : 'view&id='.$id;
header('Location: '.$location);
exit();			


