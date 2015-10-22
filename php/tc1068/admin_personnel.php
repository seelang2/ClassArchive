<?php
require_once('startup.php');

//require_once('security.php');

include('header.php');


$mode = 'LIST';

if (!empty($_GET['mode'])) { $mode = strtoupper($_GET['mode']); }

switch($mode)
{

	case 'LIST':
		// list records in table
		echo tableList(array('personnel', 'departments'),
					   array('personnel.id','departments.name','personnel.firstname','personnel.lastname','personnel.permission'),
					   array('ID','Department','First Name','Last Name','Permissions'),
					   'WHERE departments.id = dept_id ORDER BY lastname ASC'
		);
	break;
	default:
		echo '<p>Invalid display mode.</p>';
	break;

} // switch mode


include('footer.php');
?>