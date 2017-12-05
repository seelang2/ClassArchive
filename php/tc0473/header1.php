<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $pagetitle; ?></title>

<?php echo $page_extra_head_content; ?>

<style type="text/css">
body {
	font-size: 78%;
	font-family:Geneva, Arial, Helvetica, sans-serif;
	background: #7a7a7a;
	text-align: center;
}

#wrapper {
	width: 750px;
	text-align: left;
	margin: 0 auto;
	padding: 0;
	background: #ffffff;
}

#header {
	height: 75px;
	overflow: hidden;
	background: #D0E6FD;
}

#footer {
	height: 30px;
	overflow: hidden;
	background: #D0E6FD;
	clear:both;
}

#maincol {
	float: right;
	width: 540px;
	margin: 0;
	padding: 0;
}

#sidecol {
	float: left;
	width: 200px;
	margin: 0;
	padding: 0;
}

.columnpad {
	padding: 5px 10px;
}

h1 {
	margin: 0;
}

form label {
	float: left;
	text-align: right;
	margin-right: 15px;
	width: 20%;
}

form div {
	clear: left;
	margin-bottom: 5px;
}

</style>
</head>
<body>
<div id="wrapper">
	<div id="header">
		<span>Demo Application</span>
	</div>
	<h1><?php echo $pageheading; ?></h1>
	<div id="maincol">
