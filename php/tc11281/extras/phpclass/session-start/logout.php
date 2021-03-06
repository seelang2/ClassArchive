<?php 
require('startup.php'); 

// logout process:
session_destroy(); // destroy session
//unset($_SESSION); // DO NOT DO THIS!!!!
$_SESSION = []; // delete session data by resetting $_SESSION
session_regenerate_id(); // regenerate session id

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>the Fronion - Log Out</title>
<link href="styles-main.css" rel="stylesheet" type="text/css">
<!--[if lte IE 6]>

<link href="styles-ie6.css" rel="stylesheet" type="text/css">


<![endif]-->
</head>
<body>
<div id="contentWrapper">
  <?php require_once('inc/header.php'); ?>
  <?php require_once('inc/nav.php'); ?>
  <div id="mainContent">
    <h1>You have been logged out.</h1>
  </div>
  <?php require_once('inc/sidebar.php'); ?>
  <?php require_once('inc/footer.php'); ?>
</div>
</body>
</html>
