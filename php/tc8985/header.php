<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>

	<style type="text/css">
	body {
		font-family: Verdana, Arial, sans-serif;
		background: #dedede;
	}

	#wrapper {
		width: 800px;
		margin: auto;
		background: #ffffff;
		border: 1px solid #cccccc;
	}

	#pagehead {
		height: 80px;
		position: relative;
		background: #000099;
		color: #ffffff;
		padding: 1px 0;
	}

	#pagefoot {
		height: 120px;
		background: #666666;
		color: #efefef;
		font-size: 90%;
		padding: 1px 0;
	}

	#content {
		padding: 1px 40px;
	}

	#pagehead nav a {
		color: #ffffff;
		text-decoration: none;
	}

	#pagehead nav {
		position: absolute;
		bottom: 0;
	}

	#pagehead nav div {
		display: inline-block;
		border-right: 1px solid #ffffff;
		margin-left: 10px;
		padding-right: 10px;
	}
	</style>
</head>
<body>
<div id="wrapper">
	<header id="pagehead">
		<nav>
			<div>
				<a href="trucks.php?action=list">Manage Trucks</a>
			</div>
			<div>
				<a href="trucks.php?action=add">Add New Truck</a>
			</div>
			<div>
				<a href="atlas.php?action=list">Atlas</a>
			</div>
		</nav>
	</header>
	<div id="content">
