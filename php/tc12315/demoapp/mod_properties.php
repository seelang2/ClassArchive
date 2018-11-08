
<h2>Property Management</h2>
<nav>
	<a href="index.php?module=properties&action=add">Add New Property</a>
</nav>

<?php

switch($action) {
	default:
	case 'LIST': // list all items
		require('inc_properties_list.php');
	break; // LIST

	case 'EDIT': // EDIT
		require('inc_properties_edit.php');
		// note that there is no break statement here on purpose
	case 'ADD': // add new item (display data entry form)
		require('inc_properties_add.php');
	break; // ADD

	case 'PROCESSFORM': // process data entry form
		require('inc_properties_processform.php');
	break; // PROCESSFORM

} // switch $action




