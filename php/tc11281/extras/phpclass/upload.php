<?php

function dumpvar($data) {
	return '<pre>'.print_r($data, true).'</pre>';
}


?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<?php

// is there form data present?
if (empty($_FILES)):
	// no, so display blank form
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

	<label>
		<span>Choose file to upload:</span>
		<input type="file" name="uploadfile" />
	</label>

	<input type="submit" value="Upload" />

</form>


<?php
else:
	// yes, so process form data
	echo '<p>POST data:</p>';
	echo dumpvar($_POST);

	echo '<p>FILES data:</p>';
	echo dumpvar($_FILES);

	$tmpFileName = $_FILES['uploadfile']['tmp_name'];
	$actualFileName = $_FILES['uploadfile']['name'];
	$destinationPath = '/Applications/XAMPP/xamppfiles/htdocs/tc11281/files/';

	// check file type for valid types
	$fileType = basename($_FILES['uploadfile']['type']);

	if (!preg_match("/(jpg|jpeg|png)/i", $fileType)) {
		// File type not allowed
		echo '<p>Only .jpg, .jpeg and .png files are allowed.</p>';
	} else {
		// move file to final resting place
		if (move_uploaded_file($tmpFileName, $destinationPath.$actualFileName)) {
			// move successful
			echo '<p>The file was uploaded.</p>';
		} else {
			// there was an error
			echo '<p>There was a problem uploading the file.</p>';
		}
	}



endif;

?>
</body>
</html>