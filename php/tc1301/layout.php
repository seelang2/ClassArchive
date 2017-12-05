<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Demo Application</title>

<style type="text/css">
body {
	font-size: 76%;
	font-family:Geneva, Arial, Helvetica, sans-serif;
	background: #7a7a7a;
	margin: 0;
	padding: 0;
	text-align:center;
}

#wrapper {
	width: 700px;
	margin: 20px auto;
	text-align:left;
	background: #ffffff;
}

#header {
	height: 75px;
	background: #000099;
	color: #ffffff;
	overflow: hidden;
	margin: 0;
	padding: 0;
}

#footer {
	height: 35px;
	background: #000099;
	color: #ffffff;
	overflow: hidden;
	text-align: center;
	padding: 10px auto;
	margin: 0;
}

#content {
	margin: 0;
	padding: 0;
	background: #ffffff;

}

#menu {
	margin: 0;
	padding: 0;
	background: #000099;
	border: 1px solid #000099;	
	color: #ffffff;
}

#menu ul {
	list-style-type: none;
	float: right;
}

#menu ul li {
	float: left;
	margin: 0 1em;
}

#menu a {
	text-decoration: none;
	font-weight: bold;
	color: #ffffff;
	width: 100%;
	background: #000099;
}

#menu a:hover {
	background: #ffffff;
	color: #000099;
}

.clearing { 
	clear:both; 
	height: 1px;
	overflow: hidden;
}

</style>

</head>
<body>

<div id="wrapper">
	<div id="header">
		<h1>TC Class 1301 Demo Application</h1>
	</div> <!-- header -->
	
	<div id="menu">
		<ul>
			<li><a href="#">Link</a></li>
			<li><a href="#">Link</a></li>
			<li><a href="#">Link</a></li>
		</ul>
		<div class="clearing"></div>
	</div>
	
	<div id="content">
		<p>Foo.</p>
	</div> <!-- content -->
	
	<div id="footer">
		<span>Copyright <?php echo date('Y'); ?> Training Connection Class 1301.</span>
	</div> <!-- footer -->

</div> <!-- wrapper -->


</body>
</html>
