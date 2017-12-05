<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>

<?php
echo '<style type="text/css">';
echo 'p { color: ';
if (date('D') == 'Tue') {
	echo '#00FF00;';
} else {
	echo '#FF0000;';
}
echo ' }';
echo '</style>';


?>


</head>

<body>

<?php
// is form data present?
if (!empty($_POST)) {
	// process form
	$fullname = $_POST['firstname'] . ' ' . $_POST['lastname'];
	
	echo '<h1>Welcome, ' . $fullname . '!</h1>';
	
?>
	<p>Thank you for giving us your contact information.</p>
    <p>We will reach you at <?php echo $_POST['email']; ?> with more information.</p>

<?php	
} else {
	// display blank form
?>

	<form action="example2.php" method="post">
    	<label>First Name: <input name="firstname" /></label>
    	<label>Last Name: <input name="lastname" /></label>
    	<label>Email: <input name="email" /></label>
        <input type="submit" value="Continue" />
    </form>

<?php
} // if empty POST
?>


</body>
</html>