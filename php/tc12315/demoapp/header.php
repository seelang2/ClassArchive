<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Demo App</title>

	<style type="text/css">
	/* Define the "system" font family */
	@font-face {
	  font-family: system;
	  font-style: normal;
	  font-weight: 300;
	  src: local(".SFNSText-Light"), local(".HelveticaNeueDeskInterface-Light"), local(".LucidaGrandeUI"), local("Ubuntu Light"), local("Segoe UI Light"), local("Roboto-Light"), local("DroidSans"), local("Tahoma");
	}

	/* Now, let's apply it on an element */
	body {
	  font-family: "system", sans-serif;
	  backround: #cccccc;

	}

	#wrapper {
		width: 960px;
		margin: auto;
		border: 2px solid #7a7a7a;
	}

	#masthead {
		background: #000099;
		color: #ffffff;
		height: 80px;
		padding: 1px 1em;
	}

	#pagefooter {
		background: #666666;
		color: #efefef;
		font-size: 90%;
		height: 50px;
		padding: 1px 1em;
	}

	#masthead + nav {
		background: #ffffcc;
		display: flex;
	}

	#masthead + nav a {
		display: block;
		padding: 0.5em;
		text-decoration: none;
		color: #000000;
	}

	#masthead + nav a:hover {
		background: #efefef;
	}

	#main {
		padding: 1px 50px;
	}

	form label {
		display: block;
		margin-bottom: 0.5em;
	}

	form label span, form label input {
		display: inline-block;
	}

	form label span {
		width: 250px;
	}


	</style>
	
</head>
<body>

<div id="wrapper">
	<div id="masthead">
		<h1>Demo Application.</h1>
	</div>
	<nav>
		<a href="index.php">Main</a>
		<a href="index.php?module=properties">Manage Properties</a>
		<a href="index.php?module=properties">Manage Tenants</a>
	</nav>

	<div id="main">
