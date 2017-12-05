<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<form name="form1" action="comment_svc.php?action=login" method="post">
<p>Username: <input name="username" /></p>
<p><input type="submit" value="Log In" /></p>
</form>

<hr />
<form name="form2" action="comment_svc.php?action=getcomments" method="post">
<p>Token: <input name="token" /></p>
<p><input type="submit" value="Get Comments" /></p>
</form>

<hr />
<form name="form3" action="comment_svc.php?action=addcomment" method="post">
<p>Token: <input name="token" /></p>
<p>Comment: <input name="comment" /></p>
<p><input type="submit" value="Post Comment" /></p>
</form>

<hr />
<form name="form4" action="comment_svc.php?action=logout" method="post">
<p>Token: <input name="token" /></p>
<p><input type="submit" value="Log Out" /></p>
</form>







</body>
</html>