<?php
require_once('config.php');

include('header.php');
?>

<h1>Main Page</h1>
<p>Welcome, <?php echo $_SESSION['userdata']['name']; ?>!</p>

<?php include('footer.php'); ?>