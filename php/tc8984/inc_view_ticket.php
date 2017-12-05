<h1>Ticket #<span class="field"><?php echo $ticket['tickets'][0]['id']; ?></span></h1>
<p>
	<span class="label">Status:</span> 
	<span class="field"><?php echo $ticket['tickets'][0]['status']; ?></span>
</p>
<p>
	<span class="label">Request Date: </span>
	<span class="field"><?php echo $ticket['tickets'][0]['request_date']; ?></span>
</p>
<p>
	<span class="label">Originator: </span>
	<span class="field"><?php echo $ticket['tickets'][0]['originator']; ?></span>
</p>
<p>
	<span class="label">Assigned To: </span>
	<span class="field"><?php echo $ticket['tickets'][0]['tech']; ?></span>
</p>
<p>
	<span class="label">Facility: </span>
	<span class="field"><?php echo $ticket['tickets'][0]['facility']; ?></span>
</p>
<p>
	<span class="label">Location: </span>
	<span class="field"><?php echo $ticket['tickets'][0]['location']; ?></span>
</p>
<p>
	<span class="label">Description: </span>
</p>
<div class="field"><?php echo $ticket['tickets'][0]['description']; ?></div>

<h2>Comments</h2>
<table>
	<thead>
		<th>Date</th>
		<th>Author</th>
		<th>Comment</th>
	</thead>
	<tbody>
		<?php 
			if (empty($ticket['comments'])) {
				echo '<p>No comments.</p>';
			} else {
				foreach ($ticket['comments'] as $comment) {
					include('inc_view_comment.php');
				}

			}
		?>
	</tbody>
</table>