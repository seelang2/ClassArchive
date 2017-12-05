<?php

$timeval = time();

// set cookie
//setcookie('testcookie', $timeval, time() + (3600 * 24 * 7 * 52));

// expire cookie
setcookie('testcookie', null, time() - (3600 * 24 * 7 * 52));


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body>


<?php
echo "<p>Contents of timeval: $timeval</p>";

echo '_COOKIE contents: <pre>' . print_r($_COOKIE, true) . '</pre><br /><br />';
?>

</body>
</html>
