<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Project Title</title>

	<style type="text/css">
	body, button, input {
		font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
		font-size: 16px;
	}

	body { 
		background: #dedede;

	}

	#wrapper {
		width: 900px;
		margin: auto;
		border: 1px solid #7a7a7a;
		background: #ffffff;
	}

	#content {
		padding: 1em 25px;
	}

	#masthead {
		background: #009;
		color: #fff;
		display: flex;
		justify-content: space-between;
	}

	#masthead ul {
		list-style-type: none;
		margin: 0;
		padding: 0;
		display: flex;
	}

	#masthead li {
		padding: 0.5em;
	}

	#masthead a, #pagefooter a {
		text-decoration: none;
		color: #fff;
	}

	#pagefooter {
		background: #666666;
		color: #efefef;
		font-size: 90%;
		padding: 1px 1em;
	}

	table, th, td { border: 1px solid #7a7a7a; }
	table { border-collapse: collapse; }
	th, td { padding: 0.5em 1em; }

	label span, label input { display: inline-block; }
	label span { width: 125px; text-align: right; }
	form div { margin-bottom: 0.5em; }

	</style>
</head>
<body>
	<div id="wrapper">
		<header id="masthead">
			<nav id="topnav">
				<ul>
					<li><a href="<?php echo BASE_PATH; ?>content/view">Content</a></li>
					<li><a href="<?php echo BASE_PATH; ?>users/view">Users</a></li>
				</ul>		
			</nav>

			<ul>
				<li>Options:</li>
				<li>
					<?php if (Auth::isLoggedIn()): ?>
						<a href="<?php echo BASE_PATH; ?>users/logout">Log Out</a>
					<?php else: ?>
						<a href="<?php echo BASE_PATH; ?>users/login">Log In</a>
					<?php endif; ?>
				</li>
			</ul>		
		</header>

		<div id="content">
			<!-- Controller->method view template content goes here -->
			<?php echo $this->content_for_layout; ?>
			<!-- End view template content -->
		</div><!-- #content -->

		<footer id="pagefooter">
			<p><a href="https://creativecommons.org/licenses/by/4.0/" target="_blank">Creative Commons License. Attribution is nice, but not necessary.</a></p>
		</footer><!-- #pagefooter -->
	</div><!-- #wrapper -->
</body>
</html>