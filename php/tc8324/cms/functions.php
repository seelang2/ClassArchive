<?php

function get_header() {
	include('header.php');
}

function get_footer() {
	include('footer.php');
}

function get_page_by_id(&$db, $pageId) {
	//global $db; // import database connection into function scope
	
	$query = "SELECT id, title, publish_date, stub, content FROM cms WHERE id = ".$db->quote($pageId)." AND status = 1";
	
	$results = $db->query($query);
	if ($results === false) return false;
	
	// get the row from the result set and return
	return $results->fetch(PDO::ASSOC);
	
}

function get_page_by_stub($stub) {
	
}

