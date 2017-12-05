<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo 'Demo1.php - our first php page'; ?></title>
</head>

<body>


<?php

echo '<p>This space for rent!</p>';

/*
	block comment - anything between the tags is ignored across multiple lines
*/

// line comment - anything after the slashes are ignored

$fullName = 'John Doe';

echo '<h1>Welcome ' . $fullName . '!</h1>';

echo '<p>Today is ' . date('l, F jS, Y g:ia') . '</p>'; // concantenation 

$someVar = 'Just some text';

echo '<p>' . $someVar . '</p>';


$days = array('math', 'science', 'reading', 'biology', 452, $fullName);

echo $days[2];

$days[] = 'history';



$days = array_merge($days, array('phys ed', 'study hall', 'etc'));

// good troubleshooting tool to dump array values
echo "\n<!-- \n<pre>" . print_r($days, true) . "</pre>\n-->\n";

$pillbox = array(
				 'mon' => 'white',
				 'tue' => 'orange',
				 'wed' => 'purple',
				 'thu' => 'red',
				 'fri' => 'blue',
				 'sat' => 'green',
				 'sun' => 'yellow'
				 );

echo $pillbox['tue'];

unset($pillbox['fri']);



?>



</body>
</html>