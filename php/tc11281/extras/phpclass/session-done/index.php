<?php 

  session_start(); 

  require_once('landingURL.php');
  
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>the Fronion - News That Doesn't Stink</title>
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
    <h1>Today’s News</h1>
    <p>Sporktown, USA: Sporktown announces their new website. It's cooler looking than the previous website and is a fascinating read. Few people know the true story of Sporktown and the spork, so be sure to check out this site to enlighten yourself.
      Aside from eating utensil fanatics, who knew
      sporks were this fascinating? What are you waiting for? Go to <a href="http://www.sporktown.com">http://www.sporktown.com</a> right now.</p>
    <h1>New Writer Hired</h1>
    <img src="img/portrait-new-writer.jpg" width="90" height="131" class="picLeft">
    <p>We just hired a new writer. Orkfay P. Tensiluay just finished work on the Sporktown website update. Please excuse any articles that seem biased towards Sporks. Right now Mr. Tensiluay is obsessed with sporks, but we are sure he will come around to ordinary
      forks and spoons to see they have a place on the table as well.</p>
  </div>
  <?php require_once('inc/sidebar.php'); ?>
  <?php require_once('inc/footer.php'); ?>
</div>
</body>
</html>
