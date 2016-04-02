<?php


?>
<!doctype html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<style type="text/css">

</style>
</head>
<body>

<?php 

if (!empty($_POST)) {
	// process data
	echo '<pre>'.print_r($_POST,true).'</pre>';
	
} else {

?>

<form id="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div id="items">
	<div class="item">
		<label>
			<span>Name:</span>
			<input name="name[]" />
		</label>
		<label>
			<span>Age:</span>
			<input name="age[]" />
		</label>
		<label>
			<span>Gender:</span>
			<input name="gender[]" />
		</label>
		<button class="btnRemove">Remove</button>
	</div>
</div>
<div><button class="btnAdd">Add another row</button><input type="submit" /></div>
</form>

<?php } ?>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	var $itemDiv = $('#items'); // get reference to items container
	// get a copy of .item
	var $itemTemplate = $('.item').clone();
	
	$('#form1').on('click','button',function(e) {
		
		e.preventDefault(); // stops buttons from submitting form
		
		// set up button handler
		switch(true) {
			case $(this).hasClass('btnAdd'):
				$itemTemplate
					.clone()			// make a copy of the item template
					.appendTo($itemDiv)	// and add to bottom of item list
			break;
			case $(this).hasClass('btnRemove'):
				$(this)					// for the target button
					.closest('.item')	// traverse up ancestors to closest item elem
					.remove()			// and remove it
			break;
		} // switch
		
	 });
	
	
}); // document.ready
</script>
</body>
</html>