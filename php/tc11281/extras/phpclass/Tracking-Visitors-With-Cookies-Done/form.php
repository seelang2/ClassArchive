<?php 
	
	$expiration = 60*60*24*365*3;//three years

	if ( !isset( $_COOKIE["visits"] ) ) {
		
		function currentPageURL() {
			$isHTTPS = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on");
			$port = (isset($_SERVER["SERVER_PORT"]) && ((!$isHTTPS && $_SERVER["SERVER_PORT"] != "80") || ($isHTTPS && $_SERVER["SERVER_PORT"] != "443")));
			$port = ($port) ? ':'.$_SERVER["SERVER_PORT"] : '';
			$url = ($isHTTPS ? 'https://' : 'http://').$_SERVER["SERVER_NAME"].$port.$_SERVER["REQUEST_URI"];
			return $url;
		}
		$entryURL = currentPageURL();
		
		$cameFromURL = 'none';
			if ( isset( $_SERVER['HTTP_REFERER'] ) ) {
				$cameFromURL = $_SERVER['HTTP_REFERER'];
			}
	
		setcookie("visits",1,time()+$expiration);
		setcookie("entryDateTime",date("F j, Y, g:i a"),time()+$expiration);
		setcookie("entryPage",$entryURL,time()+$expiration);
		setcookie("cameFrom",$cameFromURL,time()+$expiration);
	}
	elseif ( !isset( $_COOKIE["currentlyHere"] ) ) {
		$v = $_COOKIE["visits"];
		$v++;
		setcookie("visits",$v,time()+$expiration);
	}
	setcookie("currentlyHere","true");

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>the Fronion - News That Doesn’t Stink</title>
<link href="styles-fronion.css" rel="stylesheet" type="text/css">
<link href="styles-form.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="contentWrapper">
  <div id="header"><img src="img/fronion-logo-top.png" width="309" height="82"></div>
  <div id="mainContent">
    <form action="form-action.php" method="post" name="signup" id="signup">
      <fieldset id="reportStory">
        <legend>Sign Up For Our Newsletter
        </legend><div id="firstNameColumn">
          <label for="firstName">First Name:</label>
          <input name="firstName" type="text" class="textfield" id="firstName">
        </div>
        <div id="lastNameColumn">
          <label for="lastName">Last Name:</label>
          <input name="lastName" type="text" class="textfield" id="lastName">
        </div>
        <p>
          <label for="email" id="emailLabel">Email:</label>
          <input name="email" type="text" class="textfield" id="email">
        </p>
        <p>
          <input type="submit" name="submit" id="submit" value="Signup Now!">
        </p>
      </fieldset>
    </form>
  </div>
  <div id="sidebar">
    <h1>Sign Up For Our Enews!</h1>
    <p>Each month we will send a witty newsletter to your inbox telling you the latest Fronion news!</p>
    <p>You Email is completely confidential and will never be shared with anyone. Ever. Remember you can unsubscribe anytime you want, but we guarantee that the newsletter is so great you'll never want to.</p>
    <p>Thanks!</p>
  </div>
  <div id="footer">Copyright The Fronion - All Rights Reserved
    <div id="footerLeftCorner"></div>
    <div id="footerRightCorner"></div>
  </div>
</div>
</body>
</html>
