<?php
// saves comment and redirects back to post view

require('config.php');

$post_id = escape($_POST['post_id']);
$author_id = escape($_POST['author_id']);
$comment = escape($_POST['comment']);

$query = "INSERT INTO comments SET ".
		 "post_id = '$post_id', ".
		 "author_id = '$author_id', ".
		 "comment = '$comment' ";

if (!$result = @mysql_query($query)) {
	// handle error somehow - redirect to error page maybe
}

// redirect back to post view
header('Location: posts.php?action=view&id='.$post_id);
exit;
?>