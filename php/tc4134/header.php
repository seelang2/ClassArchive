<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $page['title']; ?></title>
<meta name="description" content="<?php echo $page['description']; ?>" />
<meta name="keywords" content="<?php echo $page['keywords']; ?>" />
<meta name="author" content="<?php echo $page['fullname']; ?>" />

<style type="text/css">
body {
	font-family:Verdana, Geneva, sans-serif;
	font-size: 85%;
	color: #000;
	background: #dedede;
}

#wrapper {
	background: #fff;
	border: 1px solid #7a7a7a;
	width: 800px;
	margin: auto;
}

#header, #footer {
	color: #fff;
	background: #009;
	height: 75px;
}
</style>
</head>

<body>

<div id="wrapper">
	<div id="header">
    	My website.
    </div><!-- header -->
    <div id="menu">
    	<a href="showpage.php?pageid=3">My Brand New Page</a> | 
    	<a href="showpage.php?pageid=4">Aboot Us</a>
    </div>
    <div id="content">
