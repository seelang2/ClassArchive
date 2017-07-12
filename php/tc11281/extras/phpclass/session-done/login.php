<?php 

  session_start(); 
  
  if ( isset($_POST['username']) && isset($_POST['password']) ) {
    
    if ($_POST['username'] == 'noble' && $_POST['password'] == 'noble') {

      $_SESSION['loggedIN'] = true;

      if ( isset($_SESSION['landingURL']) ) {

          header('Location: ' . $_SESSION['landingURL']);

      }
      else {

        header('Location: index.php');

      }

      exit();
      
    }
    else {
          
      $errorDisplay = '<p class="error">I\'m sorry, that username or password is incorrect.</p>';
          
    }
    
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
    <form action="" method="post" name="submitStory" id="submitStory">
      <fieldset id="reportStory">
        <legend>Log In
        </legend>
        
        <?php 
			
			if (isset($errorDisplay)) {
				echo $errorDisplay;
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
