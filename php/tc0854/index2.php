<?php

$version = '3.4';

//value is  ../../ for the number of directories from the root of the website
$virtualroot = str_repeat("../", substr_count(dirname($_SERVER["SCRIPT_NAME"]), "/"));
require_once($virtualroot."includes/header.php");

$currentdir = $_SERVER["DOCUMENT_ROOT"]."/";
$currentdir = str_replace ("/", "\\", $currentdir);

echo "<table width='600' border='0' cellpadding='0' >";
echo "<tr><td colspan='2'><img src='/images/spacer.gif' width='100%' height='1' style='background-color: #BBBBBB;'></td></tr>";
echo "<tr><th colspan='2' nowrap align='left'><b>PortableWebAp Version $version</b></th></tr>";
echo "<tr><td colspan='2'><img src='/images/spacer.gif' width='100%' height='1' style='background-color: #BBBBBB;'></td></tr>";

//echo "	<tr><td class='e'>Localhost Path</td><td class='v'>".$currentdir."</td></tr>";

echo "	<tr><td class='e' nowrap>PHP Directory &nbsp; &nbsp;</td><td class='v'><a href='/admin/openwebdir.php'>".$currentdir."</a></td></tr>";
echo "	<tr><td colspan='2' class='e'><br><br></td></tr>";

echo "  <tr><td class='e' valign='top'>Instructions</td>";
echo "  <td valign='top'>";
echo "  To get started open the PHP directory with the link above. Then copy your PHP files into that directory. ";
echo "  The default index page is index.php. Feel free to modify this index.php or use your own. ";
echo "  <br><br>";
echo "  <a href='phpinfo.php'>PHPInfo()</a>";
echo "  <br><br>";
echo "  For more information read the readme.txt file in the main PortableWebAp directory. You may also find additional ";
echo "  information on at <a href='http://portablewebap.com/messageboard/'>http://portablewebap.com/messageboard/</a>. ";
echo "  <br><br>";
echo "  </td>";
echo "  </tr>";


echo "	<tr><td class='e'>Copyright</td><td class='v'>&copy; 2005 Mark J. Crane All Rights Reserved.</td></tr>";
echo "	<tr><td class='e'>Website</td><td class='v'><a href='http://portablewebap.com'>http://portablewebap.com</a></td></tr>";
//echo "	<tr><td class='e'>Admin</td><td class='v'><a href='admin'>View Admin</a></td></tr>";
//echo "	<tr><td class='e'>Examples</td><td class='v'><a href='examples'>View Examples</a></td></tr>";
echo "</table>";


require_once($virtualroot."includes/footer.php");



?>
