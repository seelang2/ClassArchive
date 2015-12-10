<h3>Event List</h3>

<div class="evt-list">
<?php

// get event info
$results = $wpdb->get_results("SELECT * FROM evtapp_events");
//echo '<pre>'.print_r($results,true).'</pre>';

echo '<ul class="list-unstyled">';

foreach($results as $row) {
	echo '<li>' .
			'<span>' . $row->event_date . '</span>' .
			'<span>' . $row->event_name . '</span>' .
			'<span>' . $row->capacity . '</span>' .
			'<button class="btnView" data-id="'. $row->id.'">View</button>' .
		 '</li>';
}

echo '</ul>';
?>
</div>
<div id="evt-controls">
	<button class="btnAdd">New Event</button>
</div>