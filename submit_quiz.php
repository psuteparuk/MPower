<?php
//if (isset($_SESSION['login_user']) && !empty($_SESSION['login_user'])) {
	if (!isset($_POST['answers']) || empty($_POST['answers'])) { echo 'Permission Denied'; die(); }
	include 'db/dbconfig.php';
	$user_query = mysql_query('SELECT * FROM user WHERE username="'.$_SESSION['login_user'].'"');
	$user = mysql_fetch_array($user_query);
	$problem_query = mysql_query('SELECT * FROM question WHERE quizid='.$_GET['quizid'].' ORDER BY id LIMIT 1 OFFSET '.($_GET['questionno']-1));
	$problem = mysql_fetch_array($problem_query);
	$sql = 'INSERT INTO history (userid, quizid, problemid, answer) VALUES(1, '.$_GET['quizid'].', '.$problem['id'].', '.$_POST['answers'].')';
	if (!mysql_query($sql)) {
		die('Could not connect: ' . mysql_error());
	}
	mysql_close();
//}
?>