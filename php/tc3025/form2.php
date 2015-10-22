<?php
include('seriesdata2.php');

// determine what step we're at
if (empty($_GET['step'])) {
	// no step was passed, so assign default step
	$step = 'STEP1';
} else {
	$step = strtoupper($_GET['step']);
}

// send user to approriate step
switch($step)
{
	case 'STEP1':
		// here if I needed to I could still do stuff exclusive to step 1
	case 'STEP2':
	case 'STEP3':
		// load series keynames into an array
		$seriesNames = array(); // define empty array to store keys
		foreach($data as $series => $seriesData) {
			//echo "<p>Series key is $series</p>";
			//echo '<pre>' . print_r($seriesData, true) . '</pre>';
			$seriesNames[] = $series;
		} // foreach series
		
		//echo '<pre>' . print_r($seriesNames, true) . '</pre>'; // spot check
		
		// display form
		?>
		<form action="form2.php?step=step2" method="post">
            <p>
            	<label for="series">Select a series: </label>
                <select id="series" name="series">
                	<?php
					foreach($seriesNames as $name) {
						//echo "<option value=\"$name\">$name</option>"; // interpolated version
						//echo '<option value="'.$name.'">'.$name.'</option>';//concatenated version
						echo '<option value="'.$name.'"';
						if (!empty($_POST['series']) && $_POST['series'] == $name) {
							echo ' selected="selected"';
						}
						echo '>'.$name.'</option>'; // concatenated version
						echo "\n"; // for source readability
					}
					?>
                </select>
                &nbsp;<input type="submit" value="GO" />
            </p>
        </form>
		<?php
	if ($step == 'STEP1') { break; }
	
		// retrieve model data for the selected series
		$modelData = $data[$_POST['series']];
		
		//echo '<pre>' . print_r($_POST, true) . '</pre>';
		
		// build a list of model names
		$modelNames = array();
		foreach ($modelData as $model => $stuff) {
			$modelNames[] = $model;
		}
		
		// display form
		?>
		<form action="form2.php?step=step3" method="post">
            <input type="hidden" name="series" value="<?php echo $_POST['series']; ?>" />
            <p>
            	<label for="models">Select a model: </label>
                <select id="models" name="models">
                	<?php
					foreach($modelNames as $name) {
						//echo '<option value="'.$name.'">'.$name.'</option>'; // concatenated
						echo "<option value=\"{$name}\"";
						if (!empty($_POST['models']) && $_POST['models'] == $name) {
							echo ' selected="selected"';
						}
						echo ">{$name}</option>"; // interpolated version
						echo "\n"; // for source readability
					}
					?>
                </select>
                &nbsp;<input type="submit" value="GO" />
            </p>
        </form>
		<?php
		
	if ($step == 'STEP2') { break; }
	
	// case STEP3
	$series = $_POST['series'];
	$model = $_POST['models'];
	$itemData = $data[$series][$model];
	
	//echo '<pre>' . print_r($itemData, true) . '</pre>';
	
	echo '<table><tbody>' . "\n";
	// loop through itemData
	foreach ($itemData as $item) {
		echo '<tr>';
		// loop through attribute array
		foreach ($item as $name => $value) {
			// display attribute name and value
			echo '<td>' . $value . '</td>' . "\n";
		} // foreach item
		echo '</tr>' . "\n";
		$c++;
	} // foreach itemdata
	echo '</tbody></table>' . "\n";
	break;
} // switch









?>