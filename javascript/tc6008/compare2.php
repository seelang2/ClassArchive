<?php
/*
	[
		{ id: 1231, name: 'Widget', thumbURL: ''},
		{ name: 'Doodad'},
		{ name: 'Thimgamajig'},
	];
*/
	
	$the_data = array(
		array('id' => 1231, 'name' => 'Widget', 'thumbURL' => ''),
		array('id' => 12, 'name' => 'Doodad', 'thumbURL' => ''),
		array('id' => 234, 'name' => 'Thimgamajig', 'thumbURL' => '')
	);
	
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>
	
	<style type="text/css">
	body {
		font-family: Verdana, Arial, sans-serif;
		font-size: 85%;
	}
	
	#wrapper {
		width: 800px;
		margin: auto;
		padding: 10px 30px;
		border: 1px solid #666;
	}
	
	.comparelist {
		height: 80px;
	}
	
	.item {
		border: 1px solid #7a7a7a;
		padding: 10px 20px;
	}
	
	.comparelist .item {
		display: inline-block;
		width: 80px;
		font-size: 80%;
	}
	
	</style>
</head>
<body>

<div id="wrapper">
	<div id="compareitems">
		<div class="comparelist">
			<!--
			<div class="item" data-itemid="1">
				<h2>Widget</h2>
			</div>
			-->
		</div>
		<div><button id="btnStartCompare">Compare Now!</button></div>
	</div>
	
	<div id="content">
		<div class="item" data-itemid="0">
			<h2>Widget</h2>
			<p>Description text, blah blah blah</p>
			<input class="chkCompare" type="checkbox" value="0" /> 
		</div>
		<div class="item" data-itemid="1">
			<h2>Doodad</h2>
			<p>Description text, blah blah blah</p>
			<input class="chkCompare" type="checkbox" value="1" /> 
		</div>
		<div class="item" data-itemid="2">
			<h2>Thimgamajig</h2>
			<p>Description text, blah blah blah</p>
			<input class="chkCompare" type="checkbox" value="2" /> 
		</div>
	
	</div>

</div><!-- wrapper -->



<script type="text/javascript" src="jquery-1.9.1.js"></script>
<script type="text/javascript">

var App = {
	data: {},
	
	init: function() {
		App.data.compareList = $('.comparelist');
		
		$('#content')
			.on(
				'click',
				'input:checked', // triggered when box is checked
				App.addToCompareList
			 )
			.on(
				'click',
				'input:not(:checked)', // triggered when box is unchecked
				App.removeFromCompareList
			 );

	}, // App.init
	
	addToCompareList: function(e) {
		console.log('Now checking',this);
		// build a compare item
		
		$('<div />')
			.addClass('item')
			.attr('data-itemid',$(this).closest('.item').attr('data-itemid'))
			.append('<h2>'+ itemList[$(this).val()].name +'</h2>')
			.appendTo(App.data.compareList);
		
		// add to compare section
	}, // App.addToCompareList
	
	removeFromCompareList: function(e) {
		console.log('Now unchecking',this);
		// remove item from compare section
		App.data.compareList
			.children('[data-itemid='+ $(this).val() +']')
			.remove();
	} // App.removeFromCompareList
	
}; // App


$(document).ready(App.init); // document.ready

</script>
<script type="text/javascript">
	var itemList = <?php echo json_encode($the_data); ?>;</script>
</body>
</html>