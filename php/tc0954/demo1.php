<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo 'My New Title'; ?></title>
</head>

<body>

<?php

echo '<p>My first script at last!</p>';

$dateformat = 'l, F jS, Y g:ia';

echo '<p>Today is ' . date($dateformat) . '</p>';

$myname = 'John' . ' ' . 'Doe';

echo '<p>Welcome, ' . $myname . '!</p>';

?>


<p>The name on the query string is <?php echo $_GET['firstname'] . ' ' . $_GET['lastname']; ?></p>


</body>
</html>
