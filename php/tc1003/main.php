<?php
require_once('config.php');

include('header.php');
?>

<h1>Application Main Page</h1>

<p><a href="/requests.php">Request System</a></p>

<p><a href="/adm-users.php">Manage Users</a></p>

<p><a href="/adm-cats.php">Manage Categories</a></p>

<p><a href="/main.php?logout=logout">Log Out</a></p>


<?php include('footer.php'); ?>