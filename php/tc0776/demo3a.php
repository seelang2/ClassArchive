<?php

$firstname = $_POST['fname'];
$lastname = $_POST['lname'];

$fullname = $firstname . ' ' . $lastname;



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Demo 2<?php echo $firstname . ' ' . $lastname; ?></title>
</head>
<body>

<h1>Welcome <?php echo $fullname; ?>!</h1>

<p>Today is <?php echo date('l, F j, Y'); ?></p>


</body>
</html>
