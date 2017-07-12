<div id="nav"><a href="index.php"><img src="img/fronion-logo-bottom.png" name="logoBottom" width="66" height="37" id="logoBottom"></a>
<ul>
    <li><a href="entertainment.php">Entertainment</a></li>
    <li><a href="local.php">Local</a></li>
    <li><a href="national.php">National</a></li>
    <li><a href="international.php">International</a></li>
    <li><a href="scitech.php">Sci &amp; Tech</a></li>
    <li id="login">
      <?php if ( !isset($_SESSION['loggedIN']) || $_SESSION['loggedIN'] == false ):?>
        <a href="login.php">Log In</a>
      <?php else:?>
        <a href="logout.php">Log Out</a>
      <?php endif?>
    </li>
</ul>
</div>	