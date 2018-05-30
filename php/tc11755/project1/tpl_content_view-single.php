<h1>View Content Details</h1>

<?php

if($results->rowCount()==0){
	output('<p>No data to display</p>');
	break;
}

// output content
output(print_r($results->fetch(PDO::FETCH_ASSOC),true),'pre');


?>

