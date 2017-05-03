<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />

</head>
<body>
<?php 
// database connection
$db = new mysqli('localhost', 'root', '', 'tc10007');
if ($db->connect_error) {
    // should actually redirect to error page instead.
	exit('Error connecting to database server.');			
    //exit('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
}


$step = empty($_GET['step']) ? 1: $_GET['step'];

switch($step) {

	case 2:
		// fix date format for mySQL (yyyy-mm-dd)
		$date = new DateTime($_POST['date']);
		$mySQLDate = $date->format('Y-m-d');
		//echo $mySQLDate;

		$delimiter = $_POST['delimiter'] == 'tab' ? "\t": ',';

		// parse data
		$data_array = explode("\r\n", $_POST['data']);

		//echo '<pre>'.print_r($data_array,true).'</pre>';

		// get total column count
		$max_cols = 0;
		foreach($data_array as $row) {
			$row = str_replace("\r",'',$row);
			$row_array = explode($delimiter, $row);
			$c = count($row_array);
			$max_cols = $c > $max_cols ? $c : $max_cols;
			echo '<pre>'.print_r($row_array,true).'</pre>';
		}

		echo "<p>Total columns: {$max_cols}";

		?>
		<h2>Field/Column Mapping</h2>

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?step=3" method="post">
			<input type="hidden" name="date" value="<?php echo $mySQLDate;?>"/>
			<input type="hidden" name="delimiter" value="<?php echo $delimiter;?>"/>
			<input type="hidden" name="data" value="<?php echo $_POST['data'];?>"/>

			<p>Select the data columns that correspond to the appropriate data fields:</p>

			<p>Resources.abbr <= <select name="abbr">
				<?php for ($c = 1; $c <= $max_cols; $c++) { ?>
				<option value="<?php echo $c - 1; ?>"><?php echo $c; ?></option>
				<?php } ?>
			</select></p>

			<p>Pricing.price_usd <= <select name="price_usd">
				<?php for ($c = 1; $c <= $max_cols; $c++) { ?>
				<option value="<?php echo $c - 1; ?>"><?php echo $c; ?></option>
				<?php } ?>
			</select></p>

			<p>Pricing.price_gbp <= <select name="price_gbp">
				<?php for ($c = 1; $c <= $max_cols; $c++) { ?>
				<option value="<?php echo $c - 1; ?>"><?php echo $c; ?></option>
				<?php } ?>
			</select></p>

			<p>Pricing.price_eur <= <select name="price_eur">
				<?php for ($c = 1; $c <= $max_cols; $c++) { ?>
				<option value="<?php echo $c - 1; ?>"><?php echo $c; ?></option>
				<?php } ?>
			</select></p>
			
			<p><input type="submit" value="Continue" /></p>
		</form>

		<?php

	break; // step 2

	case 3: // add data to database
		$delimiter = $_POST['delimiter'];

		// parse data
		$data_array = explode("\r\n", $_POST['data']);

		// for each row, parse and create queries to add data to database
		foreach($data_array as $row) {
			//$row = str_replace("\r",'',$row);
			$row_array = explode($delimiter, $row);

			// check price fields. if all three (usd, gbp, eur) are blank then skip
			if (empty($row_array[$_POST['price_usd']]) && 
				empty($row_array[$_POST['price_gbp']]) && 
				empty($row_array[$_POST['price_eur']]) ) continue;

			// check if the fund exists in table and get id
			$query = "SELECT id FROM resources WHERE abbr = '". $db->real_escape_string($row_array[$_POST['abbr']]) ."'";
			$result = $db->query($query);
			
			// if exists, get id
			if ($result->num_rows > 0) {
				$id = $result->fetch_assoc();
				$id = $id['id'];
				echo '<p>'.$_POST['abbr'].'Abbr id:'.$id.'</p>';

			} else {
				// if not there, add it and get id
				$query = "INSERT INTO resources SET abbr = '".$db->real_escape_string($row_array[$_POST['abbr']]).
							"', name = '".$db->real_escape_string($row_array[$_POST['abbr']])."'";

				$result = $db->query($query);
				if (!$result) {
					// query error, wtf
					echo '<p>Query error: '.$query.'</p>';
					continue;
				}
				$id = $db->insert_id;
				echo '<p>'.$_POST['abbr'].'Abbr id:'.$id.'</p>';
			}

			// add new pricing record for fund 
			// map columns to appropriate fields

			$query = "INSERT INTO pricing SET " .
						"resource_id = '$id', " .
						"date = '". $db->real_escape_string($_POST['date']) ."', " .
						"price_usd = '".$db->real_escape_string($row_array[$_POST['price_usd']])."' " .
						(empty($row_array[$_POST['price_gbp']]) ? '' : ", price_gbp = '".$db->real_escape_string($row_array[$_POST['price_gbp']])."' ") .
						(empty($row_array[$_POST['price_eur']]) ? '' : ", price_eur = '".$db->real_escape_string($row_array[$_POST['price_eur']])."' ") .
						'';

			$result = $db->query($query);
			if (!$result) {
				// query error, wtf
				echo '<p>Query error: '.$query.'</p>';
				continue;
			}

		} // for each $row

	break; // step 3

	default:
?>

<h1>Simple data import tool</h1>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>?step=2" method="post">
<p>Select delimiter:
	<select name="delimiter">
		<option value="tab">Tab</option>
		<option value="comma">Comma</option>
	</select>
</p>

<p>
	<input type="checkbox" value="1" name="usequotes" /> 
	Text fields are quoted
</p>

<p>Entry date:
	<input type="date" name="date" />

<p>Paste data in box below.<br />
	<textarea name="data" style="width:85%;height:400px;margin:auto;"></textarea>
</p>


<p><input type="submit" value="Continue" /></p>
</form>


<?php 
	break; // switch default
} // switch 
?>
</body>
</html>