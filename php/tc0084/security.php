<?php
// security.php - sample security include file
if ($fullme != DEFAULT_PAGE) {
	if (!isset($_SESSION['name'])) {
		header("Location: " . SITE_URL . "login.php");
		exit;
	}
}
?>