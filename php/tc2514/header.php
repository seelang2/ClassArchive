<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<style type="text/css">
body {
	background: #cdcdcd;
	font-family:Verdana, Geneva, sans-serif;
	font-size: 85%;
	color: #000;
}

#wrapper {
	background #fff;
	width: 750px;
	margin: auto;
}

#content {
	background: #fff;
}

#header, #footer {
	background: #006;
	color: #fff;
	height: 75px;
	overflow: hidden;
}
#footer { 
	height: 30px;
	font-size: 90%;
}

form {
	width: 100%;
}

form label {
	display: block;
	margin-bottom:0.5em;
	clear: both;
	text-align: right;
}

form input, form select {
	width: 50%;
}
</style>



</head>

<body>

<div id="wrapper">
	<div id="header">
    	<p>TC Class 2514 Revised Version (BETA)</p>
        <?php
			if ($_SESSION['user_logged_in']) {
				echo '<div>Logged in as '.$_SESSION['user_name'].
					 ' <a href="'.$_SERVER['PHP_SELF'].'?logout=1">Log Out</a></div>';
			}
		?>
    </div><!-- header -->
    
    <div id="content">
    	<div id="menu">
        	<a href="default.php">Home</a> | 
        	<a href="admin-users.php?action=list">Manage Users</a> | 
        	<a href="profiles.php">View Profiles</a> | 
        	<a href="surveys.php">Manage Surveys</a>
        </div>


