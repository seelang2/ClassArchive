<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>

<style type="text/css">
body {
	background: #cfcfcf;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 85%;
	color: #000;
}

#wrapper {
	background: #fff;
	width: 800px;
	border: 1px solid #7a7a7a;
	margin: auto;
}

#header, #footer {
	background: #009;
	color: #fff;
	height: 50px;
	padding: 1px;
}
#footer {
	height: 30px;
}

</style>
</head>

<body>

<div id="wrapper">
	<div id="header">
    	<h1>Demo System</h1>
    </div><!-- header -->
    
    <div id="content">
    	<div id="submenu">
        	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=list">List Records</a> | 
            <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=add">Add New Record</a>
        </div>
