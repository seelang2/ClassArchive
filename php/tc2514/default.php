<?php
// set permission flag
$page_security = 1;

require_once('config.php');

include('header.php');

?>

<h1>Default Start page for logged in users.</h1>


<p><a href="profile.php?action=view&id=<?php echo $_SESSION['user_id']; ?>">View My Profile</a></p>

<?php include('footer.php'); ?>