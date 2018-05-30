<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Event Planning Demo App</title>

	<style type="text/css">

	#wrapper {
		width: 800px;
		border: 1px solid #7a7a7a;
		margin: auto;
		background: #fff;
	}

	#masthead {
		height: 80px;
		color: #fff;
		background: #009;
	}

	#content {
		padding: 1px 40px;
	}

	#pagefooter {
		height: 100px;
		color: #efefef;
		font-size: 90%;
		padding: 1px 0;
		background: #333333;
	}

	body {
		font-family: 'Helvetica Neue', Arial, sans-serif;
		background: #ccc;
	}

	form label {
		display: block;
		margin-bottom: 0.5em;
	}

	label span,
	label input,
	label select {
		display: inline-block;
	}

	label span {
		width: 100px;
		text-align: right;
		margin-right: 1em;
	}
	</style>

</head>
<body>

<div id="wrapper">
	<div id="masthead"></div>
	<div id="content">

		<?php echo $this->content_for_layout; ?>

	</div>
	<div id="pagefooter">
		<p>Copyright &copy; <?php echo date('Y'); ?> Creative Commons.</p>
	</div>
</div>

</body>
</html>