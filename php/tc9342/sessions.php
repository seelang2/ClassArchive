<?php

// initialize sessions
session_start();

// data is now available via the $_SESSION array
if (empty($_SESSION['mydata'])) {
	// initialize data
	$_SESSION['mydata'] = 1;
} else {
	// update data
	$_SESSION['mydata']++;
}

if (!empty($_GET['resetsession'])) {
	// reset session
	session_destroy(); // destroys session data
	// DO NOT unset($_SESSION)!!!
	$_SESSION = array(); // DO THIS INSTEAD to reset the entire session
	// also creates a new session id value
	session_regenerate_id();
}



?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>

	<style type="text/css">
	</style>
</head>
<body>
<?php
echo '<p>$_COOKIE:</p>';
echo '<pre>'.print_r($_COOKIE,true).'</pre>';

?>

<?php
echo '<p>$_SESSION:</p>';
echo '<pre>'.print_r($_SESSION,true).'</pre>';

?>

</body>
</html>