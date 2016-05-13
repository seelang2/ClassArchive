<?php

$today = new DateTime();

?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page</title>
	<style type="text/css">

	</style>
</head>
<body>

<input type="text" name="field" />
<button class="btnSet">Set</button>



<script src="jquery-2.2.3.min.js"></script>
<script>
<?php echo 'var today = "'.$today->format('l, F jS, Y').'";' ?>
</script>
<script>
$(document).ready(function() {
<?php echo 'var accessLevel = 7;'; ?>

console.log('Access Level', accessLevel);

$(document.body).append('<p>Today is '+ today +'.</p>');

$('input')
	.attr('name','data1')
	.val('Sample Content');

$(document.body)
	.on('click', '.btnSet', function(e) {
		// use .prop() to SET properties
		$('input').prop('readonly', true);

		$('button')
			.toggleClass('btnSet btnEdit')
			.html('Edit');
	 })
	.on('click', '.btnEdit', function(e) {

		$('input').prop('readonly', false);

		$('button')
			.toggleClass('btnSet btnEdit')
			.html('Set');

	 });

}); // document.ready
</script>
</body>
</html>