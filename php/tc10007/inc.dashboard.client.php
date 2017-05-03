<?php
	// get all the resources the client has access to
	$query = "SELECT * FROM resources WHERE id IN (". implode(',',$_SESSION['user']['permissions']) .") ORDER BY name ASC";
	//echo $query;
	$results = $db->query($query);
	$data= array(); // intialize data array to store everything
	// loop through resources and add to data array
	while ($row = $results->fetch_assoc()) {
		$data[$row['id']] = $row;
	}

	foreach($data as $id => $resource) {
		// get most recent price info for each resource
		$query = "SELECT * FROM pricing WHERE resource_id = $id ORDER BY date DESC LIMIT 2";
		$results = $db->query($query);
		$prices = $results->fetch_all(MYSQLI_ASSOC);

		//echo '<pre>'.print_r($prices,true).'</pre>';

		$data[$id]['price_usd'] = $prices[0]['price_usd'];
		$data[$id]['delta'] = $prices[0]['price_usd'] - $prices[1]['price_usd'];

		// get most recent report for each resource
		$query = "(SELECT * FROM reports WHERE resource_id = $id AND type = 2 ORDER BY year DESC, month DESC) " .
				 "UNION " .
				 "(SELECT * FROM reports WHERE resource_id = $id AND type = 1 ORDER BY year DESC, month DESC) " .
				 "ORDER BY type ASC";
		$results = $db->query($query);
		// it's safer to properly check whether the query had an error instead of assuming it worked, cause you never know
		if ($results === false) {
			// error, handle error

		}
		
		//$data[$id]['report'] = $results->fetch_all(MYSQLI_ASSOC);
		// build report array manually
		$data[$id]['report']['1'] = array(); // initialize monthly report array
		$data[$id]['report']['2'] = array(); // initialize quarterly report array

		while($row = $results->fetch_assoc()) {
			if ($row['type'] == 1) $data[$id]['report']['1'][] = $row;
			if ($row['type'] == 2) $data[$id]['report']['2'][] = $row;
		}
	}

	//echo '<p>Final data:</p>';
	//echo '<pre>'.print_r($data,true).'</pre>';

	// display resource list data
	?>

<style type="text/css">


.fundlineitem {
	border-top: 1px solid #ccc;
	border-bottom: 1px solid #ccc;
	padding: 0;
}
.fundlineitem:first-child {
	border-bottom: none;
}

.fundlineitem h2 {
	margin: 0;
	padding: 0.3em 0;
	background: #efefef;
}

.fundlineitem div {
	
}
</style>

<h2>Extras section</h2>
<div><?php include('dashboard.client.extras.php'); ?></div>

<div id="fundlist">
	<?php foreach ($data as $resource) : ?>

		<div class="fundlineitem accordion">
			<h2 class="accordion-control"><span><?php echo $resource['name'].' ('.$resource['abbr'].')'; ?></span>
				<span><?php echo '$'.sprintf("%01.2f",($resource['price_usd'])); ?></span>
				<span><?php echo '$'.sprintf("%01.2f",($resource['delta'])); ?></span></h2>
			<div class="accordion-target">
				<h3>Reports</h3>
				<?php if (isset($resource['report'][1][0])): ?>
					<p>Monthly Report (<?php echo $monthLabels[$resource['report'][1][0]['month']] .' '.$resource['report'][1][0]['year'];  ?>) 
						<a href="<?php echo DOWNLOAD_BASE_URL_PATH.$resource['report'][1][0]['year'].'/'.$resource['report'][1][0]['pdf_file']; ?>">Download/View</a>
						Older reports: 
						<span class="monthlyoldercontainer">
							<select class="monthlyolder">
								<option value="">Choose Report Date</option>
								<?php 
								$count = count($resource['report'][1]);
								for ($c = 1; $c < $count; $c++) {
									?>
									<option value="<?php echo $resource['report'][1][$c]['pdf_file']; ?>" data-year="<?php echo $resource['report'][1][$c]['year']; ?>">
										<?php echo $monthLabels[$resource['report'][1][$c]['month']] .' '.$resource['report'][1][$c]['year'];  ?>
									</option>
									<?php
								} ?>
							</select>
							<a class="monthlyolderdownload" href="<?php echo DOWNLOAD_BASE_URL_PATH; ?>">Download/View</a>
						</span>
					</p>
				<?php endif; ?>
				<?php if (isset($resource['report'][2][0])): ?>
					<p>Quarterly Report (<?php echo $qtrLabels[$resource['report'][2][0]['month']] .' '.$resource['report'][2][0]['year'];  ?>)
						<a href="<?php echo DOWNLOAD_BASE_URL_PATH.$resource['report'][2][0]['year'].'/'.$resource['report'][2][0]['pdf_file']; ?>">Download/View</a>
						Older reports: 
						<span class="quarterlyoldercontainer">
							<select class="quarterlyolder">
								<option value="">Choose Report Date</option>
								<?php 
								$count = count($resource['report'][2]);
								for ($c = 1; $c < $count; $c++) {
									?>
									<option value="<?php echo $resource['report'][2][$c]['pdf_file']; ?>" data-year="<?php echo $resource['report'][2][$c]['year']; ?>">
										<?php echo $qtrLabels[$resource['report'][2][$c]['month']] .' '.$resource['report'][2][$c]['year'];  ?>
									</option>
									<?php
								} ?>
							</select>
							<a class="quarterlyolderdownload" href="<?php echo DOWNLOAD_BASE_URL_PATH; ?>">Download/View</a>
						</span>
					</p>
				<?php endif; ?>
			</div>
		</div>

	<?php endforeach; ?>
</div>
