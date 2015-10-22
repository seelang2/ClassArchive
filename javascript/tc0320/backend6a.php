<?php

// define category list
$categories = array(
					'Gadgets',
					'Widgets',
					'Doodads',
					'Things'
);

// to simulate latency
//mt_srand ((double) microtime() * 1000000);
mt_srand(crc32(microtime()));
usleep(mt_rand(25000, 400000) * 1);


if (isset($_REQUEST['mode']) && $_REQUEST['mode'] != '') $mode = strtoupper($_REQUEST['mode']);
if (isset($_REQUEST['catid']) && $_REQUEST['catid'] != '') $xcatid = strtoupper($_REQUEST['catid']); else $xcatid = '';
if (isset($_REQUEST['prodid']) && $_REQUEST['prodid'] != '') $xprodid = strtoupper($_REQUEST['prodid']); else $xprodid = '';
if (isset($_REQUEST['page']) && $_REQUEST['page'] != '') $page = strtoupper($_REQUEST['page']); else $page = 1;

define('RESULTS_PER_PAGE', 6);

$me = $_SERVER['PHP_SELF'];

// connect to db
$dbcnx = @mysql_connect('localhost', 'root', 'portable');

if (!dbcnx) { 
	exit('Error');
}

if (!@mysql_select_db('ajax320')) {
	exit('Error');
}

switch($mode) {
	case 'COUNT':
		$query = "SELECT COUNT(*) AS count FROM products";
		if ($xcatid != '' && $xcatid != 'ALL') $query .= " WHERE category_id = '$xcatid'";
		$results = @mysql_query($query);
		$row = mysql_fetch_array($results);
		echo $row['count'];
	
	break;

	case 'GETCATS':
		$results = $categories;

		echo '<select name="catlist" id="catlist" ><option value="ALL">All Categories</option>';

		for($c = 0; $c < count($results); $c++) {
			echo "<option value=\"$c\">{$results[$c]}</option>\n";
			//echo "<p>$key, $value</p>";
		}
		echo '</select>';


	break;

	case 'GETRESULTS':
		
		$query = "SELECT * FROM products";
		
		if ($xprodid != '') $query .= " WHERE id = '$xprodid'";
		else if ($xcatid != '' && $xcatid != 'ALL') $query .= " WHERE category_id = '$xcatid'";
		
		$query .= " LIMIT " . (RESULTS_PER_PAGE * ($page - 1)) . ', ' . RESULTS_PER_PAGE;

		$results = @mysql_query($query);

		header("Content-Type: text/xml");
		echo '<?xml version="1.0" encoding="iso-8859-1"?>' . "\n";
		echo "<productlist>\n";

		while ($item = mysql_fetch_array($results)) {
			//echo "<pre>" . print_r($item, true) . "</pre>";
				echo "<product>\n";
				echo "<name>{$item['name']}</name>\n";
				echo "<price>{$item['price']}</price>\n";
				echo "<qty>{$item['qty']}</qty>\n";
				echo "<url>{$item['image_url']}</url>\n";
				echo "<description>{$item['description']}</description>\n";
				echo "</product>\n";
		}
		
		echo "</productlist>\n";
	break;
}

?>