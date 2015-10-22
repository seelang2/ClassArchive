<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Demo Application</title>

<link rel="stylesheet" href="style.css" media="all" />

</head>
<body>

<div id="wrapper">
	<div id="header">
		<h1>TC Class 1301 Demo Application</h1>
		
		<?php
			if (isset($_SESSION['userid'])) {
				echo '<p>You are logged in as ' . $_SESSION['username'] . '. <a href="main.php?logout=true">Log out</a></p>';
			}
		?>
	</div> <!-- header -->
	
	<div id="menu">
		<ul>
			<li><a href="admin-cats.php">Manage Categories</a></li>
			<li><a href="admin-depts.php">Manage Departments</a></li>
			<li><a href="admin-inv.php">Manage Inventory</a></li>
			<li><a href="admin-contacts.php">Manage Contacts</a></li>
		</ul>
		<div class="clearing"></div>
	</div>
	
	<div id="content">
