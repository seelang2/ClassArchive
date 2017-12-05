<?php
require_once('config.php');
session_start();


if ( (!isset($_SESSION['loggedin'])) || (!$_SESSION['loggedin']) ) {
	$_SESSION['from'] = $me;
	header('Location: /login.php');
	exit;
}


$title = "Here's my page title!";
$description = "This space for rent";
$keywords = "None";

$range = 3;			// # records to retrieve per page
$currentpage = 1;	// current result page #

$query = "SELECT count(*) AS count FROM company_info";
$result = mysql_query($query);
if ($result) {
	$row = mysql_fetch_array($result);
	$totalpages = ceil($row['count'] / $range);
} else $totalpages = 0;

if (isset($_GET['p']) && $_GET['p'] != '') $currentpage = $_GET['p'];

if ($currentpage < 1) $currentpage = 1;
if ($currentpage > $totalpages) $currentpage = $totalpages;


$startingrec = ($currentpage - 1) * $range;




include ('pub_header.php');
?>

<h1>Company Directory</h1>

<?php

//$query = "SELECT id, name, address1, address2, city, state, zip, url FROM company_info ORDER BY state ASC LIMIT $startingrec, $range";

$query = "select a.name, a.address1, a.address2, a.city, a.state, a.zip, a.url, d.name as category from company_info AS a, companies_to_categories as c, categories as d where a.id = c.company_id and c.category_id = d.id order by d.name asc";

$results = mysql_query($query);

if (!$results) {
	// display error
	echo '<p> There was a problem with the database.</p>';
} else {
	// process results
	
	$oldcat = '';
	while ($row = mysql_fetch_array($results)) {
		
		$currentcat = $row['category'];
		
		if ($currentcat != $oldcat) {
			$oldcat = $currentcat;
			echo "<h2>$currentcat</h2>";
		}
		
		echo "<div class=\"listing\">";
		echo "<h3>{$row['name']}</h3>";
		echo "<p>";
		echo "{$row['address1']}<br />";
		if (!empty($row['address2'])) echo "{$row['address2']}<br />";
		echo "{$row['city']}, {$row['state']} {$row['zip']}<br />";
		echo "{$row['url']}";
		echo "</p>";
		echo "</div>";
	}
}

?>

<?php if ($totalpages > 1) { ?>
<p><a href="<?php echo $me . '?p=' . ($currentpage - 1); ?>">Previous results</a> <a href="<?php echo $me . '?p=' . ($currentpage + 1); ?>">Next results</a></p>
<?php } ?>

<?php
include ('pub_footer.php');
?>