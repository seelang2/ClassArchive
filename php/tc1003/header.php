<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<style type="text/css">
body {
	background: #7a7a7a;
	font-family:Geneva, Arial, Helvetica, sans-serif;
	font-size: 78%;
	text-align: center;
}

#wrapper {
	margin: 0 auto;
	text-align: left;
	background: #ffffff;
	width: 75%;
}

#header {
	margin: 0;
	padding: 0;
	height: 75px;
	overflow: hidden;
	background: #000099;
	color: #ffffff;
}

#content {
	margin: 0;
	padding: 10px 20px;
}

#footer {
	margin: 0;
	padding: 5px 10px;
	height: 40px;
	overflow: hidden;
	background: #000099;
	color: #ffffff;
}

form label {
	float: left;
	width: 10em;
	text-align: right;
	margin-right: 15px;
}

form div {
	clear: left;
}

#userinfo {
	float: right;
	text-align:right;
}

.disabled {
	background: #ffffff;
	color: #333333;
}

</style>

</head>
<body>

<div id="wrapper">
	<div id="header">
<?php
if (!empty($_SESSION['user_id'])) {
	echo '<div id="userinfo">You are currently logged in as ' . $_SESSION['username'] . '</div>';
}
?>
		<h1>Sample Application</h1>
	</div>
	
	<div id="content">
