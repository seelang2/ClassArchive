<?php

$authorID = 2; // manually set author for now
$permissions = 2; // hardcoded permission for testing

// connect to database server
$dbLink = @mysql_connect('localhost','root','xampp');

if (!$dbLink) exit('Error connecting to database server.');

// select database
if (!@mysql_select_db('tc5047')) exit('Error selecting database.');

// extract action from query string
if (!empty($_GET['action'])) $action = strtoupper($_GET['action']);

// extract id if passed in query string
if (!empty($_GET['id']))
	$id = mysql_real_escape_string($_GET['id']);
else
	unset($id);

switch($action) {
	default:
	case 'LIST':
		/*
		// inner join query
		$query = '
			SELECT 
				posts.id as post_id,
				posts.create_date,
				posts.title,
				posts.content,
				authors.name
			FROM
				posts, authors,
			wHERE
				posts.author_id = authors.id
		';
		*/
		// left join query
		$query = '
			SELECT 
				posts.id as post_id,
				posts.create_date,
				posts.title,
				posts.content,
				authors.name
			FROM
				posts
			LEFT JOIN authors ON posts.author_id = authors.id
			ORDER BY posts.create_date DESC
		';
		
		if (!$results = @mysql_query($query)) {
			// query error
			echo '<p>Query error.<br />'.$query.'</p>';
			break;
		}
		
		// loop through result set and display posts
		while ($post = mysql_fetch_array($results, MYSQL_ASSOC)) {
			
			
			
		}
		
	
	break; // LIST
	
	
	
	
} // switch


?>