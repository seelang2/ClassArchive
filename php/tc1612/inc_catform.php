
<form action="adm-categories.php?action=process<?php if(!empty($id)) echo '&id='.$id; ?>" method="post">
	<div>
    	<label for="name">Name:</label>
    	<input name="name" id="name" value="<?php if(!empty($row['name'])) echo $row['name']; ?>" />
    </div>
    <div>
    	<input type="submit" value="Update database" />
	</div>
</form>
