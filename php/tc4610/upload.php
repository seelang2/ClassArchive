<?php
$page_permission = 1; // set page security level
require('config.php');
include('header.php');

?>
<h1>Upload an image</h1>

<!-- from http://www.php.net/manual/en/features.file-upload.post-method.php -->
<!-- The data encoding type, enctype, MUST be specified as below -->
<form enctype="multipart/form-data" action="upload.php" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="64000000" />
    <!-- Name of input element determines name in $_FILES array -->
    Select image to upload: <input name="userfile" type="file" />
    <div>Title: <input name="title" /></div>
    <div>Description: <input name="description" /></div>
    <input type="submit" value="Send File" />
</form>

<?php
// file upload processing
if (!empty($_FILES['userfile'])) {
	if ($_FILES['userfile']['error'] != 0) {
		// upload error, show error
		switch($_FILES['userfile']['error']) {
			case 0: echo '<p>Error: There is no error, the file uploaded with success.</p>'; break;
			case 1: echo '<p>Error: The uploaded file exceeds the upload_max_filesize directive in php.ini.</p>'; break;
			case 2: echo '<p>Error: The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.</p>'; break;
			case 3: echo '<p>Error: The uploaded file was only partially uploaded.</p>'; break;
			case 4: echo '<p>Error: No file was uploaded.</p>'; break;
			case 6: echo '<p>Error: Missing a temporary folder.</p>'; break;
			case 7: echo '<p>Error: Failed to write file to disk.</p>'; break;
			case 8: echo '<p>Error: A PHP extension stopped the file upload.</p>'; break;
		}
	} else {
		if (!move_uploaded_file($_FILES['userfile']['tmp_name'], '/xampp/htdocs/tc4610/'.$_FILES['userfile']['name'])) {
			// error during move
			echo '<p>An error occurred while trying to move the uploaded file.</p>';
		} else {
			// move ok, do whatever final processing
			// make antry into database associating this file with the current user
			$query = "INSERT INTO images SET " .
					 "user_id = '".$_SESSION['userdata']['id']."', " .
					 "filename = '".$_FILES['userfile']['name']."', " .
					 "title = '".$_POST['title']."', " .
					 "description = '".$_POST['description']."' ";
			
			if (!$result = @mysql_query($query)) {
				echo '<p>Error adding image info to database.</p>';
			} else {
				echo '<p>The image was successfully uploaded.</p>';
			}
		} // if move uploaded file
	} // if error
} // if userfile


?>


<?php include('footer.php'); ?>