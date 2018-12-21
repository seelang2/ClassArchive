<?php

if (empty($_POST)) {
?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
		<div><input name="item[]" /></div>
		<div><input name="item[]" /></div>
		<div><input name="item[]" /></div>
		<div><input name="item[]" /></div>
		<hr />
		<div><input name="thing['prop1']" /></div>
		<div><input name="thing['prop2']" /></div>
		<div><input name="thing['prop3']" /></div>
		<hr />
		<fieldset>
			<div><input name="newthing[0]['prop1']" /></div>
			<div><input name="newthing[0]['prop2']" /></div>
			<div><input name="newthing[0]['prop3']" /></div>
		</fieldset>
		<fieldset>
			<div><input name="newthing[1]['prop1']" /></div>
			<div><input name="newthing[1]['prop2']" /></div>
			<div><input name="newthing[1]['prop3']" /></div>
		</fieldset>

			<div><input type="submit" /></div>
	</form>
<?php
} else {

	echo '<pre>'.print_r($_POST, true).'</pre>';

}

