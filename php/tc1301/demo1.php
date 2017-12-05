<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body>

<?php


echo '<p>Hello World!</p>' . "\n";
echo "<p>Hello World!</p>\n";
echo '<p>Don\'t do this!</p>';
echo "<p>And he said \"Don't worry about it.\"</p>";

$full_name = 'John Doe';

echo '<p>Welcome ' . $full_name . '!</p>';
echo "<p>Another way to say hello to $full_name.</p>";

$welcome_message = 'Welcome back ' . $full_name . '!';

$welcome_message .= ' You\'ve been here ' . 3 . ' times already!';

echo $welcome_message;

$pillbox = array('Sun', 'Mon', 'Tue', 333, 'Thu', $welcome_message, 'Sat');

echo '<p>' . $pillbox[2] . '</p>';

$pillbox[] = 'Another value';

$better_pillbox = array(
						'Sun' => 'aspirin',
						'Mon' => 'orange',
						'Tue' => 'green',
						'Wed' => 'purple',
						'Thu' => 'none',
						'Fri' => 'white',
						'Sat' => 'b12'
						);

echo '<p>Wednesday\'s pill is ' . $better_pillbox['Wed'] . '! Woohoo!!</p>';

$day = 'Fri';

echo $better_pillbox[$day];





?>
















</body>
</html>
