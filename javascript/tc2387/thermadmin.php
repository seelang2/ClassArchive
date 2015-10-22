<?php
if (!empty($_POST)):

// echo '<pre>' . print_r($_POST, true) . '</pre>';

$classes = array();

$rowcount = count($_POST['class']);
for ($c = 0; $c < $rowcount; $c++) {
	if (!empty($_POST['class'][$c])) {
		$tmp = array(
						 'class' => $_POST['class'][$c],
						 'targetdonors' => $_POST['targetdonors'][$c],
						 'currentdonors' => $_POST['currentdonors'][$c],
						 'targetamount' => $_POST['targetamount'][$c],
						 'currentamount' => $_POST['currentamount'][$c]
						 );
		$classes[$_POST['class'][$c]] = $tmp;
	}
}

//echo '<pre>' . print_r($classes, true) . '</pre>';

// serialize array into string for writing
$output = serialize($classes);
// write array to file
$fp = fopen('classes.dat',"w");
fputs($fp, $output);
fclose($fp);

echo '<p>Data saved.</p>';

else:
// read in data file
$classes = unserialize(file_get_contents('classes.dat'));

?>
<script type="text/javascript">
function addline() {
	var tbody = document.getElementById("classtbody");
	
	var rowElem = document.createElement("TR");
	tbody.appendChild(rowElem);
	var tdElem = document.createElement("TD");
	rowElem.appendChild(tdElem);
	var inputElem = document.createElement("INPUT");
	tdElem.appendChild(inputElem);
	inputElem.type = 'text';
	inputElem.name = 'class[]';
	
	var tdElem = document.createElement("TD");
	rowElem.appendChild(tdElem);
	var inputElem = document.createElement("INPUT");
	tdElem.appendChild(inputElem);
	inputElem.type = 'text';
	inputElem.name = 'targetdonors[]';
	
	var tdElem = document.createElement("TD");
	rowElem.appendChild(tdElem);
	var inputElem = document.createElement("INPUT");
	tdElem.appendChild(inputElem);
	inputElem.type = 'text';
	inputElem.name = 'currentdonors[]';
	
	var tdElem = document.createElement("TD");
	rowElem.appendChild(tdElem);
	var inputElem = document.createElement("INPUT");
	tdElem.appendChild(inputElem);
	inputElem.type = 'text';
	inputElem.name = 'targetamount[]';
	
	var tdElem = document.createElement("TD");
	rowElem.appendChild(tdElem);
	var inputElem = document.createElement("INPUT");
	tdElem.appendChild(inputElem);
	inputElem.type = 'text';
	inputElem.name = 'currentamount[]';
	
	var tdElem = document.createElement("TD");
	rowElem.appendChild(tdElem);
	var inputElem = document.createElement("INPUT");
	tdElem.appendChild(inputElem);
	inputElem.type = 'button';
	inputElem.value = 'Delete';
	inputElem.onclick = function() { deleteline(this); };
}

function deleteline(target) {
	// percolate up to the parent row
	while (target.nodeName != "TR") { target = target.parentNode; }
	//alert(target.nodeName);
	// delete row from tbody
	document.getElementById("classtbody").removeChild(target);
}

</script>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<table>
	  <thead>
	  	<tr>
			<th>Class</th>
			<th>Target # Donors</th>
			<th>Current # Donors</th>
			<th>Target Amount</th>
			<th>Current Amount</th>
			<th>&nbsp;</th>
		</tr>
	  </thead>
	  <tbody id="classtbody">
	  <?php
		foreach ($classes as $class => $data) {
			echo '<tr>' .
				   '<td><input type="text" name="class[]" value="'.$data['class'].'" /></td>' . 
				   '<td><input type="text" name="targetdonors[]" value="'.$data['targetdonors'].'" /></td>' .
				   '<td><input type="text" name="currentdonors[]" value="'.$data['currentdonors'].'" /></td>' .
				   '<td><input type="text" name="targetamount[]" value="'.$data['targetamount'].'" /></td>' .
				   '<td><input type="text" name="currentamount[]" value="'.$data['currentamount'].'" /></td>' .
				   '<td><input type="button" value="Delete" onclick="deleteline(this);" /></td>' .
				'</tr>';
		}
	  ?>
	  </tbody>
	  <tfoot>
		<tr>
			<td colspan="5">
				<input type="button" onclick="addline();" value="Add New Line" />
				<input type="submit" value="Save" />
			</td>
		</tr>
	  </tfoot>
	</table>
</form>
<?php endif; ?>