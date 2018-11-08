<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>"Multi Page" Form Demo</title>

	<style type="text/css">
	/* layout  */
	body {
		margin: 0;
		background: #dedede;
	}

	#wrapper {
		width: 80%;
		background: #ffffff;
		margin: auto;
		border: 2px solid #7a7a7a;
	}

	#masthead {
		height: 80px;
		background: #000099;
		color: #ffffff;
		padding: 1px 0;
	}

	#pagefooter {
		color: #efefef;
		background: #666666;
		font-size: 85%;
		padding: 1px 0;
	}

	#content {
		padding: 10px 40px;
		margin: auto;
	}

	/* ref: https://css-tricks.com/snippets/css/system-font-stack/ */
	/* Define the "system" font family */
	@font-face {
	  font-family: system;
	  font-style: normal;
	  font-weight: 300;
	  src: local(".SFNSText-Light"), local(".HelveticaNeueDeskInterface-Light"), local(".LucidaGrandeUI"), local("Ubuntu Light"), local("Segoe UI Light"), local("Roboto-Light"), local("DroidSans"), local("Tahoma");
	}
	body, input, select, textarea {
	  font-family: "system";
	  font-size: 18px;
	}

	.button {
		font-weight: bold;
		border: 2px solid #7a7a7a;
		border-radius: 7px;
		display: inline-block;
		padding: 0.5em 1em;
		cursor: pointer;
	}

	label {
		display: block;
		margin-bottom: 0.5em;
	}

	label span, label input {
		display: inline-block;
	}

	label span:first-child {
		width: 200px;
		text-align: right;
	}

	label span:first-child:after {
		content: ':';
		margin-right: 1em;
	}

	fieldset {
		margin-bottom: 0.5em;
	}

	table, th, td { border: 1px solid #7a7a7a; }
	table { border-collapse: collapse; }
	th, td { padding: 0.5em 1em; }


	.error { 
		color: #ff0000;
		font-weight: bold;
	}

	#flashmessage {
		background: #ffcccc;
		border: 1px solid #990000;
		padding: 1em;
	}

	</style>
</head>
<body>

<div id="wrapper">
	<header id="masthead">
	</header>
	<nav id="topnav">
		<a href="events.php?action=list">List Events</a> | 
		<a href="events.php?action=add">Add New Event</a> 
	</nav>
	<div id="content">
		<?php 
		if (!empty($_SESSION['flashmessage'])) {
			echo '<div id="flashmessage">';
			echo $_SESSION['flashmessage']; // immediately display flash message
			echo '</div>';
			unset($_SESSION['flashmessage']); // then remove it from the session
		} 
		?>
		<!-- begin content -->
