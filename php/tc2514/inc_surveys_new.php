<div style="width: 300px;">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=process<?php echo ((empty($sid))?'':'&sid='.$sid); ?>" method="post">
    <label>
        Survey Name:
        <input type="text" name="name" 
         value="<?php echo ((empty($row['name']))?'':$row['name']); ?>" />
    </label>
    <div style="text-align:center">
        <input type="submit" value="Update Database" />
    </div>
</form>
</div>



