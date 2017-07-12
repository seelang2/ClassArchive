<?php 

//use this for sql injection example:
// ' or '1' = '1

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Find by Email</title>
</head>

<body>
<p>Enter an email address to see if that user exists.</p>
<form name="form1" id="form1" method="post" action="search-results-simple.php">
  <p>
    <label for="email">Email</label>
    <input type="text" name="email" id="email">
  </p>
  <p>
    <input type="submit" name="submit" id="submit" value="Submit">
  </p>
</form>
<p>&nbsp;</p>
</body>
</html>