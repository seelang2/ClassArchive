<?php


if ( !empty($_POST) ) { // or can use empty($_POST) == false or empty($_POST) != true
	// process form data
	// display personalized welcome message
	$fullname = $_POST['firstname'] . ' ' . $_POST['lastname'];
	
	echo "<p>Welcome to the demo $fullname! Please enjoy your stay!</p>";
	
	$dob = $_POST['dob-month'].'-'.$_POST['dob-day'].'-'.$_POST['dob-year']; 
	//echo "<p>$dob</p>";
	//echo "<p>".date('m-j')."</p>";
	
	$dobparts = explode('-', $dob); // splits dob into component pieces
	//print_r($dobparts);
	
	
	echo "<p>Today's date as a timestamp is " . date('U') . "</p>";
	
	// if today is their birthday
	if ( ($dobparts[0].'-'.$dobparts[1]) == date('m-j') ) {
		// display happy birthday messaage
		echo '<p>Happy Birthday '.$fullname.'!!!!!</p>';
	} else {
		// else display number of days to their birthday
		
	}
	
} else {
	// display blank form
?>	
	<form action="drew.php" method="post">
        <p>First Name: <input name="firstname" /> (Example: John)</p>
        <p>Last Name: <input name="lastname" /> (Example: Doe) </p>
        <p>
        	Date of Birth: 
            <select name="dob-month">
            	<option value="01">Jan</option>
            	<option value="02">Feb</option>
            	<option value="03">Mar</option>
            	<option value="04">Apr</option>
            	<option value="05">May</option>
            	<option value="06">Jun</option>
            	<option value="07">Jul</option>
            	<option value="08">Aug</option>
            	<option value="09">Sep</option>
            	<option value="10">Oct</option>
            	<option value="11">Nov</option>
            	<option value="12">Dec</option>
            </select>&nbsp;
            <select name="dob-day">
            	<?php
					for($c = 1; $c < 32; $c++) {
						echo '<option value="'.$c.'">'.$c.'</option>'."\n";
					}
				?>
            </select>&nbsp;
            <select name="dob-year">
            	<?php
					for($c = date('Y'); $c > (date('Y') - 80); $c--) {
						echo '<option value="'.$c.'">'.$c.'</option>'."\n";
					}
				?>
            </select>&nbsp;
        </p>
        <p><input type="submit" value="Let's Date!" /></p>
    </form>
<?php	
} // if empty POST

?>