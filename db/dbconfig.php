<?php
$host = 'us-cdbr-east-05.cleardb.net';
$username = 'b73caf52d5e3ca';
$password = '091cebe3';
$db_name = 'mpower';

$link_db = mysql_connect($host, $username, $password);
if (!$link_db) {
	die("Could not connect: " . mysql_error());
}
mysql_select_db($db_name);
?>