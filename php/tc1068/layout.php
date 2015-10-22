<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Demo Application</title>

<style type="text/css">
body {
	font-size: 78%;
	background: #7a7a7a;
	text-align: center;
	font-family:Geneva, Arial, Helvetica, sans-serif;
}

#wrapper {
	margin: 0 auto;
	padding: 0;
	text-align: left;
	background: #ffffff;
	width: 750px;
}

#header {
	margin: 0;
	padding: 0;
	height: 120px;
	overflow: hidden;
	color: #ffffff;
	background: #000099;
}

#footer {
	margin: 0;
	padding: 0;
	height: 30px;
	overflow: hidden;
	color: #ffffff;
	background: #000099;
	clear: both;
}

#menu {
	margin: 0;
	padding: 0;
	float: left;
	width: 200px;
}

#content {
	float: right;
	width: 500px;
	padding: 24px;
}

</style>

</head>
<body>

<div id="wrapper">
	<div id="header">
		<h1>Demo Application</h1>
	</div>
	
	<div id="menu">
		<ul>
			<li><a href="#">Link</a></li>
			<li><a href="#">Link</a></li>
			<li><a href="#">Link</a></li>
			<li><a href="#">Link</a></li>
		</ul>
	</div>
	
	<div id="content">
		<p>Main content goes here</p>
	</div>
	
	<div id="footer">
		<span>Copyright <?php echo date('Y'); ?> Training Connection. Some rights reserved.</span>
	</div>

</div>

</body>
</html>
