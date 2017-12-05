<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>TC Class 646 Demo</title>

<style type="text/css">
body {
	background: #7a7a7a;
	font-family:Geneva, Arial, Helvetica, sans-serif;
	font-size: 78%;
	text-align: center;
	margin: 0;
	padding: 0;
}

#wrapper {
	text-align: left;
	width: 800px;
	margin: 0 auto;
	padding: 0;
}

#header {
	background:#000099;
	color: #ffffff;
	height: 75px;
	overflow: hidden;
	margin: 0;
	padding: 0;
}

#content {
	float: left;
	width: 100%;
	background: #ffffff;
	margin: 0;
	padding: 0;
}

#footer {
	height: 40px;
	background:#000099;
	color: #ffffff;
	overflow: hidden;
	clear:both;
	margin: 0;
	padding: 0;
}

#menu {
	background:#DAD7FD;
	color: #000000;
	margin: 0;
	padding: 0 25px;
}

#maincolumn {
	float: right;
	width: 640px;
}

#sidebar {
	float: left;
	width: 150px;
}

form div {
	clear: both;
	margin-bottom: 5px;
	
}

form label {
	float: left;
	margin-right: 15px;
	text-align: right;
	width: 7em;
}



</style>

</head>
<body>

<div id="wrapper">
	<div id="header">
		<h1>TC class 646 Demo Application</h1>
	</div> <!-- header -->
	
	<div id="menu">
		<p>
			<a href="<?php echo $me; ?>?hamsandwich=add">Add new record</a> | 
			<a href="<?php echo $me; ?>?hamsandwich=list">List Records</a>
		</p>
	</div> <!-- menu -->
	
	<div id="content">
		<div id="maincolumn">
