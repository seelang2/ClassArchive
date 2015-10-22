<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
</head>

<body>

<?php

$contacts = array('A'=>array('John','Doe',23),
				  'B'=>array('Jane','Smith',32),
				  'C'=>array('Alex','Trebec',57));

?>

<table>
	<tbody>
    	<tr>
        	<td><?php echo $contacts['A'][0]; ?></td>
        	<td><?php echo $contacts['A'][1]; ?></td>
        	<td><?php echo $contacts['A'][2]; ?></td>
        </tr>
    	<tr>
        	<td><?php echo $contacts['B'][0]; ?></td>
        	<td><?php echo $contacts['B'][1]; ?></td>
        	<td><?php echo $contacts['B'][2]; ?></td>
        </tr>
    	<tr>
        	<td><?php echo $contacts['C'][0]; ?></td>
        	<td><?php echo $contacts['C'][1]; ?></td>
        	<td><?php echo $contacts['C'][2]; ?></td>
        </tr>
    </tbody>
</table>


</body>
</html>