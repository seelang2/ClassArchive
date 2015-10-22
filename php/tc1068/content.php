<?php
require_once('startup.php');

require_once('security.php');


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<h1>Main Content Page</h1>
<p>Welcome <?php echo $user['firstname']; ?>.</p>
<p>You are record number <?php echo $user['id']; ?>.</p>
<p>This is the main content page.</p>
<p><a href="#">Link 1</a></p>
<p><a href="#">Link 2</a></p>
<p><a href="#">etc.</a>   </p>


</body>
</html>
