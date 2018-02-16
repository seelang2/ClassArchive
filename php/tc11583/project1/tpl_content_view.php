
<h1>Content List</h1>

<?php
if($results->rowCount()==0){
 output('<p>No data to display</p>');
} else {
  //loop through results and display in table
  $outputHTML ='<table><tbody>';
?>
<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Title</th>
			<th>Type</th>
			<th>Date Added</th>
			<th>Status</th>
			<th>Uploaded By</th>
		</tr>
	</thead>
	<tbody>
<?php

  while($row = $results->fetch(PDO::FETCH_ASSOC)) {
  	echo '<tr>';
  	foreach($row as $fieldName => $fieldValue) {
  		echo '<td>';
  		switch(true) {
  			case $fieldName == 'type':
  				echo $content_type[$fieldValue];
  			break;
  			case $fieldName == 'status':
  				echo $content_status[$fieldValue];
  			break;
  			default:
  				echo $fieldValue;
  			break;
  		}
  		echo '</td>';
  	}
  	echo '</tr>';
  }

}
?>

	</tbody>
</table>
