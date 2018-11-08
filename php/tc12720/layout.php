<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>"Multi Page" Form Demo</title>

	<style type="text/css">
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

	</style>
</head>
<body>

<div id="wrapper">
	<header id="masthead">
	</header>
	<nav id="topnav">
	</nav>
	<div id="content">
		<!-- begin content -->

		<!-- end content -->
	</div><!-- #content -->
	<footer id="pagefooter">
		
	</footer>
</div><!-- #wrapper -->

</body>
</html>