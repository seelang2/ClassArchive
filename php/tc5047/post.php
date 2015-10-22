<?php

$authorID = 2; // manually set author for now

// connect to database server
$dbLink = @mysql_connect('localhost','root','xampp');

if (!$dbLink) exit('Error connecting to database server.');

// select database
if (!@mysql_select_db('tc5047')) exit('Error selecting database.');

// extract action from query string
if (!empty($_GET['action'])) $action = strtoupper($_GET['action']);

if ($action == 'SAVE') {
	// save post to database
	$title = mysql_real_escape_string($_POST['title']);
	$content = mysql_real_escape_string($_POST['content']);
	
	$query = "INSERT INTO posts SET ".
			 "author_id = '$authorID', ".
			 "title = '$title', ".
			 "content = '$content' ";
	
	if (!$result = @mysql_query($query)) {
		echo "<p>Error saving post:<br />$query</p>";
	} else {
		echo "<p>The post has been saved.</p>";
	}
	
} else {
	// display post form
	?>
	<style type="text/css">
	form { width: 70%; }
	form label { display: block; margin-bottom: 0.5em; }
	form [type=text] { width: 100%; }
	form textarea { width: 100%; min-height:100px; }
	</style>
    
    <h2>Add Post</h2>
    
    <form action="post.php?action=save" method="post">
    	<label>
        	<h3>Title</h3>
            <input name="title" type="text" />
        </label>

    	<label>
            <textarea name="content">
            </textarea>
        </label>
    	
        <label>
        	<input type="submit" value="Save" />
        </label>
    </form>
    <?php
}

?>