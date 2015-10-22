<?php
//$page_permission = 1; // set page security level
require('config.php');
include('header.php');


if (!empty($_GET['action'])) $action = strtoupper($_GET['action']); else $action = 'VIEW';
if (!empty($_GET['id'])) $id = $_GET['id']; else unset($id);

if (!isset($id)) $action = 'ERROR';

?>

<?php

switch($action) {
	case 'VIEW':
		// retrieve user record
		$query = "SELECT fullname, email, website, bio FROM users WHERE id = '$id' ";
		$result = @mysql_query($query);
		if (!$result || mysql_num_rows($result) != 1) {
			// query error
			echo '<p>There was a problem retrieving the requested record.</p>';
			break; // terminate case
		}
		$profileData = mysql_fetch_array($result, MYSQL_ASSOC);
		
		// display profile data
		?>
        <h1><?php echo $profileData['fullname']; ?>'s Profile</h1>
        <div>
        	<h3>Email: <span><?php echo $profileData['email']; ?></span></h3>
            <h3>Website: <span><?php echo $profileData['website']; ?></span></h3>
        </div>
        <h2>Bio</h2>
        <div>
        	<?php echo $profileData['bio']; ?>
        </div>
        
        <h2>Recent Images</h2>
        <div id="imagegallery">
        <?php
        $query = "SELECT * FROM images WHERE user_id = '".$_SESSION['userdata']['id']."' ";
		$results = @mysql_query($query);
		if (!$results) {
			// query error
		} else {
			// display images
			if (mysql_num_rows($results) == 0) {
				echo '<p>No uploaded images.</p>';
			} else {
				// loop through result set and display images
				while($img = mysql_fetch_array($results, MYSQL_ASSOC)) {
					?>
					<div id="<?php echo $img['id']; ?>" class="imagelist">
						<h3><?php echo $img['title']; ?></h3>
						<div><img src="/tc4610/<?php echo $img['filename']; ?>" class="thumbnail" /></div>
						<div><?php echo $img['description']; ?></div>
					</div>
					<?php
				}
			}
		}
		?>
        </div>
        
        <?php
	break; // VIEW
	
	case 'EDIT':
		if ($_SESSION['userdata']['id'] != $id) {
			// user only allowed to edit their own profile
			echo '<p>You are only able to edit your own profile.</p>';
			break; // terminate case 
		}
		
		// retrieve user record
		$query = "SELECT fullname, email, website, bio FROM users WHERE id = '$id' ";
		$result = @mysql_query($query);
		if (!$result || mysql_num_rows($result) != 1) {
			// query error
			echo '<p>There was a problem retrieving the requested record.</p>';
			break; // terminate case
		}
		$profileData = mysql_fetch_array($result, MYSQL_ASSOC);
		
		// display data in a form
		?>
        <form action="profile.php?action=process&id=<?php echo $id; ?>" method="post">
            <h1>Editing Your Profile</h1>
            <div>
                <label>Email: <input name="email" value="<?php echo $profileData['email']; ?>" /></label>
                <label>Website: <input name="website" value="<?php echo $profileData['website']; ?>" /></label>
            </div>
            <h2>Bio</h2>
            <div>
                <textarea name="bio"><?php echo $profileData['bio']; ?></textarea>
            </div>
            <div><input type="submit" value="Save Changes" /></div>
        </form>
        <?php
	break; // EDIT
	
	case 'PROCESS':
		// data validation and sanitization goes here
		$email = escape($_POST['email']);
		$website = escape($_POST['website']);
		$bio = escape($_POST['bio']);
		
		$query = "UPDATE users SET " .
				 "email = '$email', " .
				 "website = '$website', " .
				 "bio = '$bio' ";
		
		if (!$result = @mysql_query($query)) {
			// query error
			echo '<p>Query error: <br />'.$query.'</p>';
			break;
		}
		// display user feedback
		echo '<p>Your profile changes have been saved.</p>';
		
	break; // PROCESS
	
	case 'ERROR':
	?>
    <h1>Error Encountered</h1>
    
    <p>Invalid parameters for page. Please go back and try again.</p>
    <?php
	break; // ERROR
} // switch




?>
<?php include('footer.php'); ?>