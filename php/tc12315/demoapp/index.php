<?php

require_once('init.php');

include('header.php');

// module controller
switch($module) {
	default:
	case 'MAIN':
	?>
	<h1>Main Menu</h1>

	<p><a href="<?php echo $_SERVER['PHP_SELF']; ?>?module=properties">Manage Properties</a></p>
	<p><a href="<?php echo $_SERVER['PHP_SELF']; ?>?module=tenants">Manage Tenants</a></p>

	<?php
	break;

	case 'PROPERTIES':
		require('mod_properties.php');
	break;

	case 'TENANTS':
		require('mod_tenants.php');
	break;

} // switch

include('footer.php');
