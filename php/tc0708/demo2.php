<?php

$title = 'Page Title - ' . date('l, F jS, Y');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title; ?></title>
</head>

<body>

<?php

echo "<p>Welcome to my first PHP program!</p>";


$a = 'Hello ';
$b = 'World!';

$c = $a . $b . 'Welcome! ';

echo $c;

echo "<p>Today's date is: " . date('m-d-Y') . "</p>\r\n";

echo "<p>Today's date is: ";
echo date('m-d-Y');
echo "</p>";

$today = date('l, F jS, Y');

echo "<p>Today's date is: $today</p>\r\n";

$c = 12324;

















?>



</body>
</html>
