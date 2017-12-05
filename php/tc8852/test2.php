	<?php
		for ($c = 0; $c < 61; $c++) {
			$min = sprintf("%'.02d", $c);
			echo '<option value="'.$min.'">'.$min.'</option>';
		}
	?>

	