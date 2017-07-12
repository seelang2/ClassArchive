<div id="nav"><a href="index.php"><img src="img/fronion-logo-bottom.png" name="logoBottom" width="66" height="37" id="logoBottom"></a>
<ul>
    <li><a href="entertainment.php">Entertainment</a></li>
    <li><a href="local.php">Local</a></li>
    <li><a href="national.php">National</a></li>
    <li><a href="international.php">International</a></li>
    <li><a href="scitech.php">Sci &amp; Tech</a></li>
    <?php
    	if (empty($_SESSION['userdata'])) {
    		// display login button
    ?>
    <li id="login"><a href="login.php">Log In</a></li>
    <?php
    	} else {
    		// display logout button
    ?>
    <li id="login"><a href="logout.php">Log Out</a></li>
    <?php
    	}
    ?>
</ul>
</div>	