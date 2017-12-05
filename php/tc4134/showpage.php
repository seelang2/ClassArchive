<?php
// connect to database server
$dbLink = @mysql_connect('localhost','root','xampp');
if (!$dbLink) {
	exit('Error connecting to database server.');
}

// select database
if (!@mysql_select_db('tc4134')) {
	exit('Error selecting database.');
}


if (!empty($_GET['pageid'])) { $page_id = $_GET['pageid']; }

if (!isset($page_id)) { exit('Invalid page specified.'); }

$query = "SELECT " .
		 	"pages.name, ". 
		 	"pages.title, ".
		 	"pages.description, ".
		 	"pages.keywords, ".
		 	"users.fullname, ".
		 	"pagecontent.content ".
		 "FROM pages, users, pagecontent ".
		 "WHERE pagecontent.page_id = pages.id ".
		 	"AND pages.user_id = users.id ".
		 	"AND pages.id = ".$page_id;

$result = @mysql_query($query);
if (!$result || mysql_num_rows($result) != 1) {
	// query error or no page found
	echo '<p>Query error. No soup for you! *snap*</p>';
	exit();
}

$page = mysql_fetch_array($result);

// generate page
include('header.php');
echo $page['content']; 
include('footer.php');
?>