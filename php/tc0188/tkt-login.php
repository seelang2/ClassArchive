<?php 
require_once "tkt-config.php";

// page-specific configuration
$pagetitle = "Ticket System - Demo";

include TEMPLATE_HEADER; 

?>
<h2>Please Log In</h2>

<p>Please enter your email address and password to continue.</p>

<div id="loginbox">
<?php include "login.php"; ?>
</div>

<?php include TEMPLATE_FOOTER; ?>