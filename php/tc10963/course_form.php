<?php

// connect to database server and select database
// the @ in front of new suppresses warning messages
$db = @new mysqli('localhost', 'root', '', 'tc10963');

// check if conection worked
if ($db->connect_error) {
	// problem with database connection - abort
	exit('Error connecting to database server.');
}




?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Form Data Demo</title>

	<style type="text/css">
	form label {
		display: block;
		margin-bottom: 1em;
	}

	label span, label input {
		display: inline-block;
	}

	label span {
		width: 100px;
		text-align: right;
	}

	label span:after {
		content: ':';
	}

	label input + span { text-align: left; }
	label input + span:after { content: ''; }

	</style>
</head>
<body>

<form action="course_add.php" method="post">
	<label>
		<span>Course name</span>
		<input name="name" />
	</label>

	<label>
		<span>Location</span>
		<input name="location" />
	</label>

	<label>
		<span>Term</span>
		<input name="term" />
	</label>

	<label>
		<span>Instructor</span>
		<select name="instructor_id">
			<!-- <option value="42">Mr. Smith</option> -->
			<?php
			// get instructor info from db

			$query = "SELECT id, name FROM instructors";
			$results = $db->query($query);
			if (!$results) {
				// query error
				echo '<p>Query error. No soup for you! *snap* <br />Query: ' . $query;
			} else {
				// create an OPTION element for each instructor
				while($row = $results->fetch_assoc()) {
					echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
				}
			} // if !results

			?>
		</select>
	</label>

	<div><input type="submit" /></div>

</form>


</body>
</html>