<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<style type="text/css">
body {
	background: #7a7a7a;
	margin: 0;
	padding: 0;
	text-align: center;
	font: 78% normal Geneva, Arial, Helvetica, sans-serif;
}

#wrapper {
	width: 700px;
	margin: 0 auto;
	padding: 0;
	background: #ffffff;
	text-align:left;
}

#header {
	margin: 0;
	padding: 0;
	height: 75px;
	color: #ffffff;
	background: #000099;
	overflow:hidden;
}

#content, #menu {
	margin: 0;
	padding: 0;
}

#footer {
	margin: 0;
	padding: 0;
	height: 30px;
	color: #ffffff;
	background: #000099;
	overflow:hidden;
}

form label {
	float: left;
	width: 10em;
	text-align: right;
	margin-right: 1em;
}

form div {
	clear: both;
	margin-bottom: 0.5em;
}

</style>

</head>
<body>

<div id="wrapper">
	<div id="header">
		<h1>Demo Product Application</h1>
	</div> <!-- header -->

	<div id="menu">
		<p>
			<a href="main.php">Home</a> |
			<a href="adm-products.php">Manage Products</a> |
			<a href="adm-cats.php">Manage Categories</a> |
			<a href="adm-users.php">Manage Users</a>
			<?php
				if ($_SESSION['logged_in']) {
					echo ' | <a href="main.php?logout=true">Log Out</a>';
				}
			?>
		</p>			
	</div> <!-- content -->

	<div id="content">
