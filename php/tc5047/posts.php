<?php
require('config.php');
include('header.php');

$authorID = $_SESSION['userdata']['id']; 
$permissions = $_SESSION['userdata']['permissions']; 

// extract action from query string
if (!empty($_GET['action'])) $action = strtoupper($_GET['action']);

// extract id if passed in query string
if (!empty($_GET['id']))
	$id = escape($_GET['id']);
else
	unset($id);

switch($action) {
	default:
	case 'LIST':
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
			?>
			<div id="post-<?php echo $post['post_id']; ?>" class="post-wrapper">
            	<h2>
					<a href="posts.php?action=view&id=<?php echo $post['post_id']; ?>">
						<?php echo stripslashes($post['title']); ?>
                    </a>
                </h2>
                <div class="post-subhead">
                	Posted <?php echo $post['create_date']; ?> 
                    by <?php echo $post['name']; ?>
                </div>
            	<div class="post-content">
                	<?php echo $post['content']; ?>
                </div>
            </div>
			<?php
		}
		
	
	break; // LIST
	
	case 'VIEW':
		if (empty($id)) {
			echo '<p>Invalid post specified.</p>';
			break;
		}
		
		$query = '
			SELECT 
				posts.id as post_id,
				posts.create_date,
				posts.title,
				posts.content,
				authors.name,
				authors.id as author_id
			FROM
				posts
			LEFT JOIN authors ON posts.author_id = authors.id
			WHERE posts.id = \''.$id.'\'
			ORDER BY posts.create_date DESC
		';
		
		if (!$results = @mysql_query($query)) {
			// query error
			echo '<p>Query error.<br />'.$query.'</p>';
			break;
		}
		
		$post = mysql_fetch_array($results, MYSQL_ASSOC)
		
		// display post
		?>
		<div id="post-<?php echo $post['post_id']; ?>" class="post-wrapper">
			<h1><?php echo stripslashes($post['title']); ?></h1>
			<div class="post-subhead">
				Posted <?php echo $post['create_date']; ?> 
				by <?php echo $post['name']; ?>
			</div>
			<div class="post-content">
				<?php echo $post['content']; ?>
			</div>
		</div>
		
        <?php if ($post['author_id'] == $_SESSION['userdata']['id'] 
				  || $_SESSION['userdata']['permissions'] > 2 ): ?>
        <div><a href="posts.php?action=edit&id=<?php echo $post['post_id']; ?>">Edit this post</a></div>
		<?php endif;
		
		// display comments
		$query = '
			SELECT
				comments.id,
				comments.comment_date,
				comments.comment,
				authors.name
			FROM comments
			LEFT JOIN authors ON comments.author_id = authors.id
			WHERE comments.post_id = '.$post['post_id'].'
			ORDER BY comments.comment_date ASC
		';
		
		echo '<div id="post-comments">';
		echo '<h2>Comments</h2>';
		
		if (!$results = @mysql_query($query)) {
			// query error
			echo '<p>Query error.<br />'.$query.'</p>';
			break;
		}
		
		if (mysql_num_rows($results) < 1) {
			echo '<p>No comments have been posted.</p>';
		}
		
		// loop through result set and display posts
		while ($comment = mysql_fetch_array($results, MYSQL_ASSOC)) {
			?>
            <div id="comment-<?php echo $comment['id']; ?>" class="comment">
                <div class="comment-subhead">
                    <?php echo $comment['name']; ?>
                    on <?php echo $comment['comment_date']; ?> 
                </div>
                <div class="comment-content">
                    <?php echo $comment['comment']; ?>
                </div>
            </div>
            <?php
		}
		
		// display comment form
		?>
		<h2>Post a comment</h2>
        <form action="savecomment.php" method="post">
            <input type="hidden" name="author_id" value="<?php echo $authorID; ?>" />
            <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>" />
            <label>
                <textarea name="comment"></textarea>
            </label>
            
            <label>
                <input type="submit" value="Post Comment" />
            </label>
        </form>
		<?php
		
		echo '</div><!-- post-comments -->';
	break; // VIEW
	
	case 'EDIT':
		// retrieve record to display in form
		if (empty($id)) {
			// $id not set
			echo '<p>Invalid ID specified.</p>';
			break;	
		}
		
		// build query
		$query = "SELECT title, content FROM posts WHERE id = '$id'";
		// send query
		$result = @mysql_query($query);
		// check query result
		if (!$result && mysql_num_rows($result) != 1) {
			// error
			echo '<p>Query error or record not found.</p>';
			break; // terminate case
		}
		
		// process result
		$post = mysql_fetch_array($result,MYSQL_ASSOC);
		
		//echo '<pre>'.print_r($post, true).'</pre>';
		
	case 'ADD':
		// display post form
		?>
		<style type="text/css">
		</style>
		
		<h2><?php echo empty($id)? 'Add': 'Edit'; ?> Post</h2>
		
		<form action="posts.php?action=save<?php echo empty($id)? '': '&id='.$id; ?>" method="post">
			<label>
				<h3>Title</h3>
				<input name="title" type="text"
                 value="<?php echo empty($post['title'])? '': stripslashes($post['title']); ?>"
                 />
			</label>
	
			<label>
				<textarea name="content"><?php echo empty($post['content'])? '': $post['content']; ?></textarea>
			</label>
			
			<label>
				<input type="submit" value="Save" />
			</label>
		</form>
		<?php
	break; // ADD
	
	case 'SAVE':
		// save post to database
		$title = escape($_POST['title']);
		$content = escape($_POST['content']);
		
		if (empty($id))
			$query = 'INSERT INTO ';
		else
			$query = 'UPDATE ';
		
		$query.= "posts SET ".
				 "author_id = '$authorID', ".
				 "title = '$title', ".
				 "content = '$content' ";
		
		if (!empty($id)) $query .= " WHERE id = '$id' ";
		
		if (!$result = @mysql_query($query)) {
			echo "<p>Error saving post:<br />$query</p>";
			break;
		}
			echo "<p>The post has been saved.</p>";
	break; // SAVE
	
	case 'DELETE':
		if (empty($id)) {
			echo '<p>Invalid or missing ID.</p>';
			break;
		}
		
		// first we delete the post itself
		$query = "DELETE FROM posts WHERE id = '$id'";
		
		if (!$result = @mysql_query($query)) {
			echo '<p>Error trying to delete the record.</p>';
			break;
		}
		
		// also need to delete all comments belonging to this post
		$query = "DELETE FROM comments WHERE post_id = '$id'";
		
		if (!$result = @mysql_query($query)) {
			echo '<p>Error trying to delete the record.</p>';
			break;
		}
		
		echo '<p>The post has been deleted.</p>';
	break; // DELETE
} // switch

include('footer.php');
?>