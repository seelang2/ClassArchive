<?php
require_once('init.php');

include ('header.php');

// get action parameter from query string
if (!empty($_GET['action'])) { $action = strtoupper($_GET['action']); } else { $action = 'SHOWFORM'; }


switch($action) {
	
	case 'SHOWFORM': // display form
	?>
    	<form action="<?php echo $_SERVER['PHP_SELF'] . '?action=processform'; ?>" method="post">
        	<div>
            	<label>Verb: <input type="text" name="word" value="" /></label>
            </div>
        	<div>
            	<label>Language: 
                	<select name="language_id">
                    	<option value="0">Select a language</option>
                        <?php
						foreach ($languageList as $row) {
							echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
						}
						?>
                    </select>
                </label>
            </div>

        	<div>
            	<label>Type: 
                	<select name="type">
                    	<option value="root">Root</option>
                        <?php
						foreach ($participleList as $row) {
							echo '<option value="'.$row['id'].'">'.$row['description'].'</option>';
						}
						?>
                    	<option value="derivative">Other</option>
                    </select>
                </label>
            </div>

        	<div>
            	<label>Tense: 
                	<select name="tense_id">
                    	<option value="0">Select a tense</option>
                        <?php
						foreach ($tenseList as $row) {
							echo '<option value="'.$row['id'].'">'.$row['description'].'</option>';
						}
						?>
                    </select>
                </label>
            </div>
        	<div>
            	<label>Form: 
                	<select name="form_id">
                    	<option value="0">Select a form</option>
                        <?php
						foreach ($formList as $row) {
							echo '<option value="'.$row['id'].'">'.$row['description'].'</option>';
						}
						?>
                    </select>
                </label>
            </div>
            
            <div><input type="submit" value="Save" /></div>

        </form>
    <?php	
	break; // SHOWFORM
	
	case 'PROCESSFORM': // process form data
		
		// extract data from POST
		$word = $_POST['word'];
		$language_id = $_POST['language_id'];
		$type = $_POST['type'];
		$tense_id = $_POST['tense_id'];
		$form_id = $_POST['form_id'];
		
		// add record to word table
		
		$query = "INSERT INTO words SET " .
				 "word = '$word', " .
				 "language_id = '$language_id'";
		
		// type value will be either 'root', 'derivative', or a participle id value
		switch ($type) {
			case 'root': 
				$query .= ", type = '1'";
			break;
			case 'derivative':
				$query .= ", type = '2'";
			break;
			default:
				$query .= ", type = '3', participle_id = '$type'";
			break;
		} // switch type
		
		// statically set parent_id for now
		$query .= ", parent_id = '0'";
		
		$result = @mysql_query($query);
		if (!$result) {
			// query error
			echo '<p>There was a problem with the query: <br />'.$query.'</p>';
			break;
		}
		
		// get the id of the word record
		$word_id = mysql_insert_id();
		
		if ($type == 'derivative') {
			if ($tense_id > 0) {
				// add record to tense link table
				$query = "INSERT INTO w2t SET word_id = '$word_id', tense_id = '$tense_id'";
				$result = @mysql_query($query);
				if (!$result) {
					// query error
					echo '<p>There was a problem with the query: <br />'.$query.'</p>';
					break;
				}
			}
			
			if ($form_id > 0) {
				// add record to form link table
				$query = "INSERT INTO w2f SET word_id = '$word_id', form_id = '$form_id'";
				$result = @mysql_query($query);
				if (!$result) {
					// query error
					echo '<p>There was a problem with the query: <br />'.$query.'</p>';
					break;
				}
			}
		} // if type
		
		echo '<p>Record was saved successfully.</p>';
	break; // PROCESSFORM
	
} // switch $action



include ('footer.php');
?>