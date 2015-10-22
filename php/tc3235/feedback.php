<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
</head>

<body>

<?php

// is form data present?
if (!empty($_POST)) {
	// T - process form data
	?>
    <h1>Thanks For Your Feedback!</h1>
    <p>Thank you for your feedback, <?php echo $_POST['firstname'] . ' ' . $_POST['lastname']; ?>! Your feedback is 
    very important to us. We will contact you at your email address <?php echo $_POST['email']; ?> regarding your comment.<p>
    <p>Your comment:<br /><?php echo $_POST['comment']; ?></p>
    <?php
} else {
	// F - display blank form
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    	<div><label>First Name: <input name="firstname" /></label></div>
    	<div><label>Last Name: <input name="lastname" /></label></div>
    	<div><label>Email: <input name="email" /></label></div>
    	<div><label>Comment: <textarea name="comment"></textarea></label></div>
        <div><input type="submit" /></div>
    </form>
    <?php
}
?>

</body>
</html>