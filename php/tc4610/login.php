<?php
require('config.php');
include('header.php');


if (empty($flashdata['from'])) {
	$action = 'home.php';
} else {
	$action = $flashdata['from'];
}

?>

<h1>Log In Now</h1>

<div id="status">
<?php 
	if (!empty($flashdata['message'])) echo $flashdata['message'];
?>
</div>

<form action="<?php echo $action; ?>" method="post">
    <label>Email: <input type="text" name="loginemail" /></label>
    <label>Password: <input type="text" name="loginpassword" /></label>
    <label><input type="submit" value="Log in now" /></label>
</form>

<?php include('footer.php'); ?>