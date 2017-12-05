<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<style type="text/css">
body {
	font-size: 78%;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	background: #7a7a7a;
	margin: 0;
	padding: 0;
}

#wrapper {
	margin: 0 auto;
	padding: 0;
	background: #ffffff;
	width: 70%;
}

#header {
	height: 75px;
	background: #0066CC;
	overflow: hidden;
	color: #ffffff;
}

#header a {
	color: #ffffff;
}

#footer {
	height: 30px;
	background: #0066CC;
	overflow: hidden;
}

#content {
	padding: 25px;	
}

form label {
	width: 13em;
	margin-right: 1em;
	float: left;
	text-align: right;
}

form div {
	clear: left;
	margin-bottom: 5px;
}

#loginstatus {
	float: right;
	text-align: right;
}

#loginbox {
	width: 20em;
	margin: 0 auto;
	padding: 2em;
	border: 1px solid #0066FF;
}

#loginbox label {
	width: 7em;
}

/* Typography */
h1 {
	margin-top: 0.25em;
}

h2 {
	text-align: center;
	color: #000099;
}
</style>

</head>
<body>

<div id="wrapper">
	<div id="header">
		<div id="loginstatus">
			<?php
				if ($_SESSION['is_logged_in']) {
					echo 'Logged in as ' . $_SESSION['username'] .
						 ' <a href="main.php?logout=1">Log Out</a>';
				} else {
					echo 'You are not logged in';
				}
			?>
		</div>
		<h1>TC Class 854</h1>
		<div>
			<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=add">Add New Record</a> | 
			<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=list">List Records</a> | 
			<a href="#">New Link</a>
		</div>

	</div>
	
	<div id="content">

