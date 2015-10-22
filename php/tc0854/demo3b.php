<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<h1>Welcome, <?php echo $_POST['firstname'] . ' ' . $_POST['lastname']; ?>!</h1>

<p>Good to see you again...</p>

<p>The page mode is <?php echo $_GET['mode']; ?></p>

<p>Today's date is <?php echo date('l, F j, Y H:ia',time()); ?></p>

<p>An hour from now the time will be <?php echo date('H:i:s', time() + (3600 * 24) ); ?></p>

</body>
</html>
