<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Manage School Info</title>
	
	<style type="text/css">
	body {
		font-family: Verdana, Arial, sans-serif;
		color: #000;
		background: #ccc;
	}
	
	#wrapper {
		background: #fff;
		width: 800px;
		margin: auto;
		border: 1px solid #7a7a7a;
	}
	
	header {
		height: 80px;
		background: #009;
		color: #fff;
	}
	
	footer {
		height: 125px;
		background: #666;
		color: #efefef;
		font-size: 90%;
	}
	
	</style>
</head>
<body>

<div id="wrapper">
	<header>Test App</header>
	
	<div id="content">

	
<form id="form1" action="crud_school.php?action=save" method="post">
	<div>
		<label>
			<span>School Name:</span>
			<input name="name" />
		</label>
	</div>
	<div>
		<input type="submit" value="Save" />
	</div>
</form>

	
	
	</div><!-- content -->
	<footer>
		<span>Copyright &copy;<?php echo date('Y'); ?> TC Class 8027. Creative Commons License</span>
	</footer>
</div><!-- wrapper -->

<script type="text/javascript" src="jquery-2.1.1.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {

$('#form1').on('submit', function(evt) {
	
	evt.preventDefault();
	
	$.ajax({
		url:		'api/?model=schools&action=save',
		type:		'post',
		dataType:	'json',
		data:		$(this).serialize(),
		success:	function(response) {
			if (response.status == false) {
				alert('The data was NOT saved.');
			} else {
				alert('The data was saved.');
			}
		}
	});

});


}); // document.ready


</script>
</body>
</html>

