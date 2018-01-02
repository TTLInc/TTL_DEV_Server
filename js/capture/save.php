<?php
$data 	= $_POST['data'];
$file	= md5(uniqid()) . '.png';
$uri 	=  substr($data,strpos($data,",")+1);// remove "data:image/png;base64,"
file_put_contents('tmp/'.$file, base64_decode($uri));// save to file
echo $file;// return the filepath
exit;
?>