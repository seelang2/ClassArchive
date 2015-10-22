<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>

<style type="text/css">
body { 
	font-family: Verdana, Geneva, sans-serif; 
	font-size: 85%; 
	background: #ccc;
}

#wrapper {
	width: 800px;
	background: #fff;
	border: 1px solid #7a7a7a;
	margin: auto;
}

#header {
	background: #009;
	color: #fff;
	height: 80px;
}

#footer {
	background: #333;
	color: #efefef;
	font-size:90%;
	height: 125px;
}

#header a { color: #fff; }

#content {
	padding: 10px 25px;
}

form { width: 80%; margin: auto; }
form label { display: block; margin-bottom: 0.5em; }
form [type=text] { width: 100%; }
form textarea { width: 100%; min-height:100px; }


</style>

</head>

<body>

<div id="wrapper">
	<div id="header">
    	<div style="float:right; width: 150px;">
        	<?php
			if (!empty($_SESSION['userdata'])) {
				echo 'Logged in as '.$_SESSION['userdata']['name'];
			} else {
				echo '<a href="login.php">Please log in</a>';
			}
			?>
        </div>
        
        Demo App: Blog
    </div><!-- header -->
    
    <div id="menu">
    	<?php if ($_SESSION['userdata']['permissions'] == 255): ?>
        <a href="admin-authors.php?action=list">List Authors</a> | 
    	<a href="admin-authors.php?action=add">Add New Author</a> | 
    	<?php endif; ?>
        <a href="posts.php?action=list">Posts</a> | 
    	<a href="posts.php?action=add">Create New Post</a>
    </div>
    <div id="content">
    
