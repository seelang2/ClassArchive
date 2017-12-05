<?php

require('init.php');

// connect to DB server and select database
try {
	$db = new PDO($dsn,$user,$password);
} catch (PDOException $error) {
	// always put something in the catch section to gracefully
	// recover from the error, provide user feedback, etc.
	
	exit('<p>Error connecting to database.</p>'); // halt execution of page
}


if (!empty($_GET['pageid'])) {
	// get a specific page
	//$pageData = get_page_by_id($db, $_GET['pageid']);

	$query = "SELECT id, title, publish_date, stub, content FROM cms WHERE id = ".$db->quote($_GET['pageid'])." AND status = 1";
	
	echo $query; 
	
	$results = $db->query($query); exit();
	
	if ($results === false) exit('error');
	
	// get the row from the result set and return
	$pageData =  $results->fetch(PDO::ASSOC);
	



	
	echo '<pre>'.print_r($pageData, true).'</pre>';
	
} else {
	// get 'home' page (page with stub 'home')

}