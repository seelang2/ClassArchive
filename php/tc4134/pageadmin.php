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

$action = 'LIST';
if (!empty($_GET['action'])) { $action = strtoupper($_GET['action']);}

?>

<p>
	<a href="pageadmin.php?action=list">List Pages</a> | 
    <a href="pageadmin.php?action=add">Add New Page</a>
</p>

<?php
switch($action) {
	default:
	case 'LIST': // get list of all pages
		// build query
		/*
		$query = "SELECT " . 
				 "pages.id, pages.name, pages.last_edit_date, users.username " .
				 "FROM users, pages " .
				 "WHERE users.id = pages.last_editor_id";
		*/
		$query = "SELECT " . 
				 "pages.id, pages.name, pages.last_edit_date, users.username " .
				 "FROM pages " .
				 "LEFT JOIN users ON users.id = pages.last_editor_id";
		
		// send query to server
		$results = @mysql_query($query);
		// check results
		if (!$results) {
			// query error
			echo '<p>There was an error in the query<br />'.$query.'</p>';
			break; // terminate case - nothing more to see here
		}
		
		// process results
		if (mysql_num_rows($results) == 0) {
			echo '<p>No pages to display.</p>'; // no results
			break;
		}
		
		// build table
		echo '<table><tbody>';
		// loop through results 
		while ($row = mysql_fetch_array($results)) {
			echo '<tr>' .
				 	'<td>'.$row['id'].'</td>'.
				 	'<td>'.$row['name'].'</td>'.
				 	'<td>'.$row['last_edit_date'].'</td>'.
				 	'<td>'.$row['username'].'</td>'.
				 '</tr>';
			
		} // while
		echo '</tbody></table>';
	break; // LIST
	
	case 'ADD': // add new page
		
	?>
		<style type="text/css">
		form { width:80%; margin:auto; }
		form label { display:block; clear:both; position:relative; margin:0 0 10px 0; }
		form input { position:absolute; left:75px; }
		form textarea { display:block; width:90%; height:300px; margin:auto; }
		</style>
        <h1>Edit Page</h1>
        
        <form action="pageadmin.php?action=process" method="post">
        	<label>
            	Name:
                <input name="name" value="" />
            </label>
        	<label>
            	Group:
                <!--<input name="groupid" value="" />-->
                <select name="groupid">
                <?php
					$query = "SELECT id, name FROM groups";
					$results = @mysql_query($query);
					if (!$results) {
						// query error
					} else {
						while ($row = mysql_fetch_array($results)) {
							echo '<option value="'.$row['id'].'">'.
								 $row['name'].'</option>';
						} // while rows
					} // if results
					
				?>
                </select>
                
            </label>
        	<label>
            	Title:
                <input name="title" value="" />
            </label>
        	<label>
            	Description:
                <textarea name="description" style="height:40px"></textarea>
            </label>
        	<label>
            	Keywords:
                <input name="keywords" value="" />
            </label>
        	<label>
            	Content:
                <textarea name="content"></textarea>
            </label>
            <input type="submit" value="Save" />
        </form>
		
	<?php
	break; // ADD
	
	case 'PROCESS': // processes form data
		$name = $_POST['name'];
		$title = $_POST['title'];
		$group_id = $_POST['groupid'];
		$description = $_POST['description'];
		$keywords = $_POST['keywords'];
		$content = $_POST['content'];
		$user_id = 1;
		$last_editor_id = 1;
		$created_date = time();
		
		// build query
		$query = "INSERT INTO pages SET " .
				 "name = '".$name."', " .
				 "title = '".$title."', " .
				 "group_id = '".$group_id."', " .
				 "description = '".$description."', " .
				 "user_id = '".$user_id."', " .
				 "last_editor_id = '".$last_editor_id."', " .
				 "created_date = '".$created_date."', " .
				 "keywords = '".$keywords."' ";
		
		$result = @mysql_query($query); // send query
		// check result
		if (!$result) {
			echo '<p>There was an error in the query:<br />'.mysql_error().
			'<br />'.$query.'</p>';
			break; // terminate case - nothing more to see here
		}
		
		$id = mysql_insert_id(); // get the id of the newly added page
		// build second query
		$query = "INSERT INTO pagecontent SET ".
				 "page_id = '".$id."', ".
				 "content = '".$content."' ";
		
		$result = @mysql_query($query); // send query, again
		// check result
		if (!$result) {
			echo '<p>There was an error in the query<br />'.$query.'</p>';
			// manually remove entry in page table
			$query = "DELETE FROM pages WHERE id = '".$id."' ";
			if (!@mysql_query($query)) {
				echo '<p>Also, there\'s a problem with THIS query too:<br />'.$query.
					 '</p>';
			}
			break; // terminate case - nothing more to see here
		}
		
		echo '<p>The new page has been added.</p>';
	break; // PROCESS
	
} // switch $action








?>