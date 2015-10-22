<?php 
$page_permission = 0;
require_once "tkt-config.php";

// page-specific configuration
$pagetitle = "Ticket System - Demo";

include TEMPLATE_HEADER; 

?>
<h2>Section Title</h2>
<div id="submenu">
	<a href="#">Link</a> | 
	<a href="#">Link</a>
</div>

<div><p><span class="statusmessage"><?php echo $statusmsg; ?></span></p></div>

	<p>Foo.</p>

<?php include TEMPLATE_FOOTER; ?>