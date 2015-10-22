<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
</head>

<body>

<?php
if ($_GET['mode'] == 'process') {
	$names = 
	
}

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>?mode=process" method="post">
<p>Enter list of names to add (Firstname Lastname):<br />
<textarea name="names" style="width:400px;height:300px"></textarea></p>
<input type="submit" />
</form>


</body>
</html>