
<?php if (DEBUG_MODE) echo '<pre>'.print_r($employeeData,true).'</pre>'; ?>

<h2>Employee List</h2>

<table>
	<tbody>
	<?php
		if (empty($employeeData)) {
			echo '<tr><td>No records to display.</td></tr>';
		} else {
			foreach($employeeData as $row) {
				echo '<tr>'.
						'<td>'.$row['firstname'].'</td>'.
						'<td>'.$row['lastname'].'</td>'.
						'<td>'.$row['hire_date'].'</td>'.
						'<td>'.$row['phone'].'</td>'.
						'<td>'.$row['email'].'</td>'.
						'<td>'.
							'<a href="'.SITE_BASE_URL.'employees/edit/'.$row['id'].'">Edit</a>'.
						'</td>'.
					 '</tr>';
			}
		}
	?>
	</tbody>
</table>