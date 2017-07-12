<?php

function dumpvar($data) {
	return '<pre>'.print_r($data, true).'</pre>';
}

// reset mechanism
if (isset($_GET['reset'])) {
	// delete cookie and reset visits
	setcookie('pagevisits', '', 2); // two seconds past the epoch
	$visits = 0;
} else {
	// check cookies array
	$visits = isset($_COOKIE['pagevisits']) ? $_COOKIE['pagevisits'] : 0;

	// increment visit count
	$visits++;

	// update cookie
	// cookies must be set before sending any output to the user agent
	setcookie('pagevisits', $visits);
	// note that expiration date is in future seconds
	// i.e. 1 month from now: (60 * 60 * 24 * 7 * 52) / 12

}



?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<?php

echo "<p>This page has been visited $visits time(s).</p>";

echo dumpvar($_COOKIE);
?>
</body>
</html>