<?php
$pagesecured = true; // simple page protection

require('init.php');

include('header.php');


// get query string parameters
if (!empty($_GET['action'])) $action = strtoupper($_GET['action']);
if (!empty($_GET['id'])) $id = mysql_escape_string($_GET['id']); else unset($id);

switch($action) {
	case 'ADD':
	?>
	
    <h2>Add Task</h2>
    
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=processdata<?php echo empty($id)?'':'&id='.$id; ?>" method="post">
            <input type="hidden" name="author_id" value="<?php echo $_SESSION['userid']; ?>" />
            <label>Due Date:
            	<input type="text" name="due_date" value="" />
            </label>
            <label>Priority:
            	<select name="priority">
                	<option value="1">Low</option>
                	<option value="2">Medium</option>
                	<option value="3">High</option>
                </select>
            </label>
            <label>Assignee:
            	<select name="assignee_id">
                	<?php
                    $query = "SELECT id, firstname, lastname FROM users";
					if (!$results = @mysql_query($query)) {
						// query error
						echo '<p>Query error - no soup for you! *snap*</p>';
						break;
					}
					if (mysql_num_rows($results) < 1) {
						echo '<option value="">No users to assign</option>';
					}
                    
					while ($row = mysql_fetch_array($results)) {
						echo '<option value="'.$row['id'].'">'.$row['firstname'].' '.$row['lastname'].'</option>';
					}
					
					?>
                </select>
            </label>
            <label>Description:
            	<textarea name="description"></textarea>
            </label>
            <input type="submit" value="Save" />
        </form>
        
    
    <?php
	break;
	
	
} // switch

?>
<?php include('footer.php');