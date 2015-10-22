<?php

$namelist = array(
				'Fred' => 19,
				'Alan' => 34,
				'Alice' => 26,
				'Marcus' => 34,
				'Josie' => 55,
				'Eleanor' => 11,
				'Martha' => 67,
				'Patrick' => 45,
				'Stewart' => 37,
				'Chad' => 23,
				'Millicent' => 12
				);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body>

<table border="1" cellpadding="0" cellspacing="0">
<?php
	foreach ($namelist as $name => $age) {
		echo "<tr><td>$name</td><td>$age</td></tr>";
	}
?>
</table>

</body>
</html>
