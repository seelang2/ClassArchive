<?php 

	require_once('../inc/dbConnect.php');
	
	$sql = 'SELECT id, firstName, lastName, email, publications, comments, subscribe FROM users WHERE id = ?';
	
	$stmt = $conn->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('i',$_GET['id']);
	$stmt->bind_result($id, $firstName, $lastName, $email, $publications, $comments, $subscribe);
	$stmt->execute();
	$stmt->store_result();//use this so that you can access "num_rows"
	$stmt->fetch();
	if ($stmt->error) {
		echo $stmt->errno . ": " . $stmt->error;
		exit();
	}
	
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Public Handicapper | Admin</title>
<link href="styles-main.css" rel="stylesheet">
</head>
<body>
<div id="header"><img src="img/ph-header.png" width="739" height="135"></div>
<div id="topLine"></div>
<div id="mainContent">
<h1>User Admin</h1>
  <form action="form-action.php" method="post" name="signup" id="signup">
  <h2>Contact Info</h2>
    <p>
        <label for="firstName">First Name:</label>
        <input name="firstName" type="text" id="firstName" size="40" value="">
    </p>
    <p>
        <label for="firstName">Last Name:</label>
        <input name="lastName" type="text" id="lastName" size="40" value="">
    </p>
    <p>
        <label for="email">Email:</label>
        <input name="email" type="text" id="email" size="40" value="">
    </p>
    <h2>Your Interests</h2>
    <p>
        What do you read?<br>
        <label><input name="publications[]" type="checkbox" id="publications_drf" value="Daily Racing Form"> Daily Racing Form</label>
        <label><input name="publications[]" type="checkbox" id="publications_elle" value="Elle"> Elle</label>
    </p>
    <p>
    <p>Tell us about yourself!<br>
    	<textarea name="comments" id="comments" cols="38" rows="5"></textarea>
    </p> 
    <p>
      <label>
      Sign me up to your monthly newsletter:
        <input name="subscribe" type="checkbox" id="subscribe" value="1">
      </label>
    </p> 
    <input type="submit" name="submit" id="submit" value="Update User">
  </form>
</div>
<div id="footer"><a href="#">FAQ</a><a href="#">Forgot Password?</a><a href="#">Change Your Email</a><a href="#">Contact Public Handicapper</a></div>
</body>
</html>
