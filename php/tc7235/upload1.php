<?php

$status = null;
$uploadDir = '\xampp\htdocs\tc7235';

if ( !empty($_FILES['userfile']) ) {

	//echo '<pre>' . print_r($_FILES, true) . '</pre>';
	
	// check for upload errors
	if ($_FILES['userfile']['error'] != 0) {
		// error occurred, can check error type or display general message
		$status = '<p>An error occurred during the file upload.</p>';
	} else {
		// move file to new location
		if ( !move_uploaded_file(
			$_FILES['userfile']['tmp_name'],
			$uploadDir. '\\' . $_FILES['userfile']['name']) ) {
			// file move error
			$status = '<p>The file could not be moved. Please try again.</p>';
		} else {
			// success
			$status = '<p>The file has been uploaded.</p>';
		
		}
	}
	
	

}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>
	<style type="text/css">
	</style>
	
</head>
<body>

<div id="status">
	<?php echo $status; ?>
</div>

<!-- ref: http://us2.php.net/manual/en/features.file-upload.post-method.php -->
<!-- The data encoding type, enctype, MUST be specified as below -->
<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
    <!-- Name of input element determines name in $_FILES array -->
    Send this file: <input name="userfile" type="file" />
    <input type="submit" value="Send File" />
</form>

</body>
</html>