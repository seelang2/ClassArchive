<?php

require_once('config.php');

include('header.php');

if (!empty($flashData)) {
	$targetURL = $flashData;
} else {
	$targetURL = '/tc2514/default.php';
}
?>

<h2>Log in to Continue</h2>

<div style="color:#f00;font-weight:bold">
	<?php if (!empty($flashMsg)) { echo $flashMsg; } ?>
</div>

<div style="width: 300px;">
<form action="<?php echo $targetURL; ?>" method="post">
	<label>
    	Email:
        <input name="email" />
    </label>
	<label>
    	Password:
        <input name="password" />
    </label>
    <div style="text-align:center">
        <input type="submit" value="Log in" />
    </div>
</form>
</div>

<?php include('footer.php'); ?>