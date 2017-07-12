<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Public Handicapper | Sign Up to Play!</title>
<link href="styles-main.css" rel="stylesheet">
</head>
<body>
<div id="header"><img src="img/ph-header.png" width="739" height="135"></div>
<div id="topLine"></div>
<div id="mainContent">
<h1>Sign Up To Play!</h1>
  <form action="form-action.php" method="post" name="signup" id="signup">
  <h2>Contact Info</h2>
    <p>
        <label for="name">Name:</label>
        <input name="name" type="text" id="name" size="40">
    </p>
    <p>
        <label for="email">Email:</label>
        <input name="email" type="text" id="email" size="40">
    </p>
    <p>
        What do you read?<br>
        <label><input name="publications[]" type="checkbox" id="publications_drf" value="Daily Racing Form"> Daily Racing Form</label>
        <label><input name="publications[]" type="checkbox" id="publications_elle" value="Elle"> Elle</label>
    </p>
<input type="submit" name="submit" id="submit" value="Sign Me Up!">
  </form>
</div>
<div id="footer"><a href="#">FAQ</a><a href="#">Forgot Password?</a><a href="#">Change Your Email</a><a href="#">Contact Public Handicapper</a></div>
</body>
</html>
