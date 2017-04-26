<?php
/* ---------------------------------------------------------------------------
 * filename    : fileupload.php
 * author      : Kyle Daly
 * description : This file allows a user to upload a picture file when adding a new attraction to the website
 * ---------------------------------------------------------------------------
 */
ini_set('file-uploads',true);
if($_FILES['file1']['size']>0){
	
	$filename = $_FILES['file1']['name'];
	$tempname = $_FILES['file1']['tmp_name'];
	$filesize = $_FILES['file1']['size'];
	$filetype = $_FILES['file1']['type'];
	
	$filetype = (get_magic_quotes_gpc() == 0
		? mysql_real_escape_string($filetype)
		: mysql_real_escape_string(stripslashes(
		$_FILES['file1'])));


$fp = fopen($tempname, 'r');
$content = fread($fp, filesize($tempname));
$content = addslashes($content);

echo 'filename: ' . $filename . '<br />';
echo 'filesize: ' . $filename . '<br />';
echo 'filetype: ' . $filename . '<br />';	
fclose($fp);

if(!get_magic_quotes_gpc()) {
	$filename = addslashes($filename);
}	
$con = mysql_connect('localhost','kddaly','627168') or die (mysql_error());
$db = mysql_select_db('kddaly',$con);

if($db) {
	$query = "INSERT INTO uploads (name,size,
	type,content) VALUES ('$filename', '$filesize',
	'$filetype', '$content')";
	mysql_query($query)or die ('query failed');
	mysql_close();
	echo "upload successful";
}
else echo "upload failed: " . mysql_error();
}
?>