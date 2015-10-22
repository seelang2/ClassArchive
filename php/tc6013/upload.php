<?php

// The upload location in the file system that the uploaded file will be stored.
// Make sure this directory is writeable by the PHP service user
$upload_location = '/fs/path/to/file/directory/'; // note the trailing slash

?>
<h1>Upload a file</h1>

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
		// The file is first uploaded to a temporary location on the server using a temp filename.
		// We must move it to the actual location and restore the original file name if desired
		if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $upload_location.$_FILES['userfile']['name'])) {
			// error during move
			echo '<p>An error occurred while trying to move the uploaded file.</p>';
		} else {
			// move ok, do whatever final processing like store file location in a database, etc.
			
			// then provide feedback to user
			echo '<p>The file was successfully uploaded.</p>';
		} // if move uploaded file
	} // if error
} // if userfile


?>
