<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>the Fronion - News That Doesn't Stink</title>
<link href="styles-main.css" rel="stylesheet" type="text/css">
<!--[if lte IE 6]>

<link href="styles-ie6.css" rel="stylesheet" type="text/css">


<![endif]-->
<style type="text/css">
#reportStory {
	width: 425px;
	margin-top: 10px;
	padding-top: 10px;
	padding-right: 20px;
	padding-bottom: 15px;
	padding-left: 20px;
	border: 1px solid #999;
}
#reportStory legend {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 24px;
	line-height: 24px;
	font-weight: bold;
	color: #664317;
}
#firstNameColumn , #lastNameColumn {
	width: 205px;
	padding-top: 10px;
	float: left;
}
#emailLabel , #scoopLabel{
	display: block;
	clear: both;
	margin-top: 15px;
}
#submit {
	font-size: 12px;
	font-weight: bold;
	color: #FFF;
	background-image: url(img/bg-form-button.gif);
	background-repeat: repeat-x;
	background-position: left center;
	padding-top: 5px;
	padding-right: 15px;
	padding-bottom: 5px;
	padding-left: 15px;
	border: 2px solid #FCB959;
}
#scoop {
	font-family: "Courier New", Courier, monospace;
	font-size: 14px;
	line-height: 21px;
	height: 270px;
	width: 386px;
	background-image: url(img/bg-yellow-lined-paper.png);
	margin-top: 5px;
	margin-bottom: 10px;
	padding-top: 3px;
	padding-left: 35px;
	border: 1px solid #AEA386;
}
.textfield {
	font-family: "Courier New", Courier, monospace;
	font-size: 14px;
	background-image: url(img/bg-inner-shadow.png);
	padding-top: 7px;
	padding-bottom: 5px;
	padding-left: 7px;
	border: 1px solid #AEA386;
}
.textfield:focus {
	background-color: #FCF186;
	background-image: none;
}
#firstName, #lastName {
	width: 195px;
	margin-bottom: 15px;
}
#lastNameColumn {
	padding-left: 15px;
}
#email {
	width: 414px;
}
</style>
</head>

<body>
<div id="contentWrapper">
  <?php require_once('inc/header.php'); ?>
  <?php require_once('inc/nav.php'); ?>
  <div id="mainContent">
    <form action="" method="post" name="submitStory" id="submitStory">
      <fieldset id="reportStory">
        <legend>Report a Story</legend>
        <div id="firstNameColumn">
          <label for="firstName">First Name:</label>
          <input name="firstName" type="text" class="textfield" id="firstName">
        </div>
        <div id="lastNameColumn">
          <label for="lastName">Last Name:</label>
          <input name="lastName" type="text" class="textfield" id="lastName">
        </div>
        <label for="email" id="emailLabel">Email:</label>
        <input name="email" type="text" class="textfield" id="email">
        <label for="scoop" id="scoopLabel">What's the Scoop?</label>
        <textarea name="scoop" id="scoop"></textarea>
        <input type="submit" name="submit" id="submit" value="Submit Story">
      </fieldset>
    </form>
  </div>
  
  <?php require_once('inc/sidebar-report.php'); ?>
  <?php require_once('inc/footer.php'); ?>
</div>
</body>
</html>
