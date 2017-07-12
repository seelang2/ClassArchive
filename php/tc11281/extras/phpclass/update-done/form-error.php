<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Public Handicapper | Error</title>
<link href="styles-main.css" rel="stylesheet">
</head>
<body>
<div id="header"><img src="img/ph-header.png" width="739" height="135"></div>
<div id="topLine"></div>
<div id="mainContent">
  <h1 class="heading-border">I’m Sorry, There Was a Problem</h1>
  <h3>Please fix the following errors:</h3>
  <ul>
	  <?php 
        foreach($errors as $value) {
            echo '<li>';
			echo $value;
            echo '</li>';
        }
      ?>
  </ul>
</div>
<div id="footer"><a href="#">FAQ</a><a href="#">Forgot Password?</a><a href="#">Change Your Email</a><a href="#">Contact Public Handicapper</a></div>
</body>
</html>
