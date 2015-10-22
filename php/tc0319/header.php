<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sample Publication System</title>

<style>
body {
	font-size: 76%;
	font-family:Geneva, Arial, Helvetica, sans-serif;
	background: #7a7a7a;
	text-align: center;
}

#content {
	width: 750px;
	background: #ffffff;
	margin: 0 auto;
	text-align: left;
	padding: 10px 25px;
}

.oddrow {
	background:#D2D6F7;
}

.evenrow {
	background:#ECEDFB;
}

</style>

</head>
<body>


<div id="content">
<div id="header">

<h1>Sample Publication System</h1>

<p>Today is <?php echo date('l, F j, Y'); ?></p>

<p>
<a href="main.php">Home</a> | 
<a href="users.php">Manage Users</a> | 
<a href="pubs.php">Manage Publications</a> | 
<a href="subs.php">Manage Subscribers</a>
</p>

</div>