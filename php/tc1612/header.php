<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if (!empty($pageTitle)) echo $pageTitle; else echo 'TC Class 1612'; ?></title>

<style type="text/css">

body {
	background: #7a7a7a;
	margin: 0;
	padding: 0;
	font-size: 78%;
	font-family:Verdana, Geneva, sans-serif;
}

#wrapper {
	background: #ffffff;
	margin: 0 auto;
	width: 700px;
}

#header, #footer {
	height: 75px;
	overflow: hidden;
	background: #000099;
	color: #ffffff;
}

#content {
	margin: 0;
	padding: 2em 3em;
}

#footer {
	height: 30px;
}

/* tableless forms */
form {
	margin: 0 auto;
	width: 75%;
}

form label {
	float: left;
	margin-right: 1em;
	text-align: right;
	width: 25%;
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
    	<h1>TC Class 1612</h1>
    </div> <!-- header -->
    
    <div id="content">
    	<div id="menu">
        	<p>
                <a href="adm-categories.php?action=list">Manage Categories</a>
            </p>
            <p>
            	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=list">List records</a>&nbsp;|&nbsp;
            	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=add">Add new record</a>&nbsp;
            </p>
        </div>
    	<!-- begin content -->
