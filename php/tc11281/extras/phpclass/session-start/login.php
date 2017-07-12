<?php 
require('startup.php'); 

// check if we were redirected from another page
if (!empty($flashMessages['redirectFrom'])) {
  $formAction = $flashMessages['redirectFrom'];
} else {
  $formAction = 'local.php';
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>the Fronion - Log In</title>
<link href="styles-main.css" rel="stylesheet" type="text/css">
<link href="styles-login.css" rel="stylesheet" type="text/css">
<!--[if lte IE 6]>

<link href="styles-ie6.css" rel="stylesheet" type="text/css">


<![endif]-->
</head>
<body>
<div id="contentWrapper">
  <?php require_once('inc/header.php'); ?>
  <?php require_once('inc/nav.php'); ?>
  <div id="mainContent">
    <form action="<?php echo $formAction; ?>" method="post" name="submitStory" id="submitStory">
      <fieldset id="reportStory">
        <legend>Log In
        </legend>
        
        <?php 
			
			if (isset($flashMessages['errorDisplay'])) {
				echo $flashMessages['errorDisplay'];
			}
		
		?>
        
        <p>
        	<label for="username">User Name:</label>
        	<input name="username" type="text" class="textfield" id="username">
        </p>
        <p>
        	<label for="password" id="emailLabel">Password:</label>
        	<input name="password" type="password" class="textfield" id="password">
        </p>
        <input type="submit" name="submit" id="submit" value="Log In">
      </fieldset>
    </form>
  </div>
  <?php require_once('inc/sidebar.php'); ?>
  <?php require_once('inc/footer.php'); ?>
</div>
</body>
</html>
