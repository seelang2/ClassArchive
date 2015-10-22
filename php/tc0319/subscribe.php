<?php
require_once("config.php");

if ( isset($_GET['pub']) ) $id = mysql_real_escape_string($_GET['pub']);

if (isset($_POST['submit'])) {
	// process the form
	if ( isset($_POST['firstname']) ) $firstname = mysql_real_escape_string($_POST['firstname']);
	if ( isset($_POST['lastname']) ) $lastname = mysql_real_escape_string($_POST['lastname']);
	if ( isset($_POST['email']) ) $email = mysql_real_escape_string($_POST['email']);
	if ( isset($_POST['pub_id']) ) $pub_id = mysql_real_escape_string($_POST['pub_id']);
	
	$create_date = date('Y-m-d');

	$query = "INSERT INTO subscribers SET firstname = '$firstname', lastname = '$lastname', email = '$email', create_date = '$create_date', status = 1";

	if (!$result = mysql_query($query)) {
		echo "Error adding subscriber to database.";
	} else {
		// get the new sub id
		$sub_id = mysql_insert_id();
		
		$query = "INSERT INTO pubs_2_subs SET pub_id = '$pub_id', sub_id = '$sub_id'";
		if (!$result = mysql_query($query)) {
			// handle error
		
		} else {
			// handle success
			
			// save subscriber info to session
			$_SESSION['firstname'] = $firstname;
			$_SESSION['lastname'] = $lastname;
			$_SESSION['email'] = $email;
			
?>
			<p>You have subscribed to the publication successfully.</p>
			<p><a href="public.php">Continue browsing publication list</a></p>
<?php
		}
	}
} else {
	// display the form
	$query = "SELECT name FROM publications WHERE id = $id";
	if (!$result = mysql_query($query)) {
		// display error
		echo "There is no publication matching that ID! No Soup for You!";
	} else {
		// get pub name
		$row = mysql_fetch_array($result);
		
		echo "<p>You have chosen to subscribe to " . $row['name'] . ". Please enter your name and email in the fields below.</p>";
?>		
		<form action="<?php echo $me; ?>" method="post">
			<p>
				First Name: <input type="text" name="firstname" size="20" value="<?php echo $_SESSION['firstname']; ?>" /><br />
				 Last Name: <input type="text" name="lastname" size="20" value="<?php echo $_SESSION['lastname']; ?>" /><br />
				     Email: <input type="text" name="email" size="20" value="<?php echo $_SESSION['email']; ?>" /><br />
				<input type="hidden" name="pub_id" value="<?php echo $id; ?>" />
				<input type="submit" name="submit" value="Subscribe Now" />
			</p>
		</form>
<?php		
	}
}
?>