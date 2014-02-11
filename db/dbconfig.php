<?php
$host = 'localhost';
$username = 'root';
$password = '1234';
$db_name = 'mpower';

$link_db = mysql_connect($host, $username, $password);
if (!$link_db) {
	die("Could not connect: " . mysql_error());
}
mysql_select_db($db_name);
?>