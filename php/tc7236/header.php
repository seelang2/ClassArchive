<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>
	
	<?php
		if (date('D') == 'Mon')
			$stylesheet = 'monstyle.css';
		else
			$stylesheet = 'style.css';
	?>
	
	<link href="<?php echo $stylesheet; ?>" rel="stylesheet" type="text/css" />
	
	<style type="text/css">
	</style>
</head>
<body>

<div id="wrapper">
	<header>
		<h1>Sample Application</h1>
	</header>
	
	<nav>
		<a href="<?php echo $self; ?>?action=list">List Contacts</a> | 
		<a href="<?php echo $self; ?>?action=add">Add New Contact</a> 
	</nav>
	
	<div id="content">
