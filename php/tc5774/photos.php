<?php

// connect to database server
$dbLink = @mysql_connect('localhost','root','xampp');
if (!$dbLink) exit('<p>Error connecting to database server.</p>');

// select database
if (!@mysql_select_db('tc5774')) exit('<p>Error selecting database.</p>');

?>
<!DOCTYPE html>
<html>
<head>
	<title>Sample Page</title>
	<meta charset="UTF-8" />
	
</head>
<body>

<?php

if (empty($_GET['action'])) $action = 'DISPLAY'; else $action = strtoupper($_GET['action']);

switch($action) {
	default:
	case 'DISPLAY': // display photos
		
		$urlpath = 'http://localhost/tc5774/';
		// retrieve photo info
		$query = 'SELECT ' .
				 'photos.id AS photoid, photos.title, photos.caption, photos.filepath, ' .
				 'albums.title AS albumname ' .
				 'FROM photos '.
				 'LEFT JOIN albums ON photos.album_id = albums.id';
		
		$photoSet = @mysql_query($query);
		
		if (!$photoSet) {
			echo '<p>There was an error.</p>'; // error
			break; // terminate case
		}
		
		if (mysql_num_rows($photoSet) < 1) {
			echo '<p>No photos available.</p>';
			break; // terminate case
		}
		
		// loop through photos and display
		while ($photo = mysql_fetch_array($photoSet, MYSQL_ASSOC)) {
			?>
			<div id="photo-<?php echo $photo['photoid']; ?>" class="photoitem">
				<h2><?php echo $photo['title']; ?></h2>
				<img src="<?php echo $urlpath . basename($photo['filepath']); ?>" 
					alt="<?php echo $photo['title']; ?>" />
				<p><?php echo $photo['caption']; ?></p>
				<p class="albumtag">Album Name: <?php echo $photo['albumname']; ?></p>
			</div>
			<?php
		} // while photos
		
	break; // DISPLAY
	
	case 'PROCESS': // process file upload
		
		// following lines added for troubleshooting discussion
		/*
		echo '<pre>' . print_r($_FILES, true) . '</pre>';
		echo '<pre>' . print_r($_POST, true) . '</pre>';
		echo '<pre>' . print_r($_SERVER, true) . '</pre>';
		*/
		// end of trouble
		
		// upload ref: 
		// http://www.php.net/manual/en/features.file-upload.post-method.php
		// http://www.php.net/manual/en/features.file-upload.php
		
		$uploaddir = '/xampp/htdocs/tc5774/'; // define upload directory path
		$pathname = $uploaddir . basename($_FILES['photo']['name']); // set server pathname for file
		
		if (move_uploaded_file($_FILES['photo']['tmp_name'], $pathname)) {
			// successful upload and move
			echo '<p>The file has been successfully uploaded.</p>';
			
			// save file location and other posted info to database
			$title = mysql_real_escape_string($_POST['title']);
			$caption = mysql_real_escape_string($_POST['caption']);
			$album_id = mysql_real_escape_string($_POST['albumid']);
			
			
			$query = 'INSERT INTO photos SET ' .
					 "title = '$title', " .
					 "caption = '$caption', " .
					 "album_id = '$album_id', " .
					 "filepath = '$pathname' ";
			
			if (!@mysql_query($query)) {
				echo 'error.'; // query error
			} else {
				// success
				echo '<p>The photo has been saved.</p>';
				
				/*
				// if using a link table, a second insert must be done using the id from 
				// the previous insert
				
				$photo_id = mysql_insert_id(); // get id of photo just added
				
				$query = "INSERT INTO albumsphotos SET " .
						 "photo_id = '{$photo_id}', album_id = '{$album_id}' ";
				
				if (!@mysql_query($query)) {
					echo 'error.'; // query error
					
					// in reality you would want to delete the photo to undo the previous
					// insert operation to maintain data integrity
					$q = "DELETE FROM photos WHERE id = '{$photo_id}' ";
					if (!@mysql_query($q)) ...
					
				} else {
					// success
				}
				
				*/
			
			}
			
		} else {
			// Houston, we have a problem...
			// file upload error codes: http://www.php.net/manual/en/features.file-upload.errors.php
			
			echo '<p>There was an error uploading the file:<br />Error code: '.
				  $_FILES['photo']['error'] .'</p>';
		}
		
	break; // PROCESS
	
	case 'UPLOAD': // display upload form
	
		// get list of album info
		$query = 'SELECT id, title FROM albums';
		$albumList = @mysql_query($query);
		if (!$albumList) {
			echo "<p>Query error: <br />$query</p>"; // query error
		}
		
	?>
	<h2>Upload Photo</h2>
	<!-- Ref: http://www.php.net/manual/en/features.file-upload.post-method.php -->
	<form enctype="multipart/form-data" 
		action="<?php echo $_SERVER['PHP_SELF']; ?>?action=process" method="post">
		<label>
			<span>Title:</span>
			<input type="text" name="title" />
		</label>
		
		<label>
			<span>Caption:</span>
			<input type="text" name="caption" />
		</label>
		
		<label>
			<span>Album:</span>
			<select name="albumid">
				<?php
				while($row = mysql_fetch_array($albumList)) {
					echo '<option value="'. $row['id'] .'">' . $row['title'] . '</option>';
				}
				?>
			</select>
		</label>
		
		<label>
			<span>File to Upload:</span>
			<input type="file" name="photo" />
		</label>
		
		
		
		<div><input type="submit" value="Start Upload" /></div>
	</form>
	<?php
	
	break; // UPLOAD

} // switch $action



?>
</body>
</html>