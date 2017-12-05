<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>

<style type="text/css">
body {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 85%;
	color: #000;
	background: #efefef;
	margin: 0;
	padding: 0;
}

#wrapper {
	width: 760px;
	background: #fff;
	border: 1px solid #7a7a7a;
	margin: 20px auto;
}

#header, #footer {
	background: #006;
	color: #fff;
	height: 80px;
}
#footer { height: 40px; }

#content { padding: 10px 30px; }

#userinfo { float: right; }

#header a {
	color: #fff;
}

#header #menu { clear: both; }

img.thumbnail {
	width: 150px;
}

</style>

</head>

<body>

<div id="wrapper">
	<div id="header">
    	<div class="title">TC Class 4610 Demo</div>

        <div id="userinfo">
        <?php
        // display logged in user or a small login form
        if (empty($_SESSION['userdata'])) {
            // display login form
            ?>
            <form action="home.php" method="post">
                <label>Email: <input type="text" name="loginemail" /></label>
                <label>Password: <input type="text" name="loginpassword" /></label>
                <label><input type="submit" value="Log in now" /></label>
            </form>
            <?php
        } else {
            // display user options
            echo '<p>Welcome, ' . $_SESSION['userdata']['fullname'] . '. (<a href="home.php?logout=true">Log Out</a>)</p>';
        }
        ?>
        </div><!-- userinfo -->
        
        <div id="menu">
        	<a href="home.php">Home</a> | 
        	<?php
            if (!empty($_SESSION['userdata'])) { 
				echo '<a href="profile.php?action=view&id='.$_SESSION['userdata']['id'].'">View My Profile</a> | ';
				echo '<a href="profile.php?action=edit&id='.$_SESSION['userdata']['id'].'">Edit My Profile</a> | ';
			} else {
				echo '<a href="signup.php">Sign Up</a> ';
			}
        	?>
        </div>

    </div><!-- header -->
    
    <div id="content">
