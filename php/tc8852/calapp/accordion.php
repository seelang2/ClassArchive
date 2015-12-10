<?php


?>
<!doctype html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<style type="text/css">
body {
	font-family: Verdana, Arial, sans-serif;
}

ul {
	list-style-type: none;
	margin: 0;
	padding: 0;
}

li {
	border: 1px solid #ccc;
	padding: 0;
}

.subcontent li {
	padding: 0.5em 1em;
}

div.title {
	border: 1px solid #ccc;
	padding: .5em 1em;
}
</style>
</head>
<body>

<ul>
	<li>
		<div class="title">Entry 1</div>
		<div class="subcontent">
			<ul>
				<li>Item 1</li>
				<li>Item 2</li>
			</ul>
		<div>
	</li>
	<li>
		<div class="title">Entry 2</div>
		<div class="subcontent">
			<ul>
				<li>Item 1</li>
				<li>Item 2</li>
			</ul>
		<div>
	</li>
	<li>
		<div class="title">Entry 3</div>
		<div class="subcontent">
			<ul>
				<li>Item 1</li>
				<li>Item 2</li>
			</ul>
		<div>
	</li>
</ul>


<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	$subcontent = $('.subcontent').hide();

	$('.title')
		.each(function(index, elem) {
			$(elem).attr('data-index', index); // add collection index to each title elem
		 })
		.on('click', function(e) {
			
			var index = $(this).attr('data-index');
			
			$subcontent						// for all subcontent elems
				.not(':eq('+ index +')')	// that are not equal to index
				.slideUp()						// hide them
				.end()						// revert back to all subcontent elems
				.eq(index)					// select the one that is equal to index
				.slideToggle();					// and toggle it
				
			
		 });
	
}); // document.ready

</script>
</body>
</html>