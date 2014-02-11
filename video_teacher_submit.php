<?php
if (isset($_SESSION['login_user']) && isset($_POST['title'])) {
	include 'db/dbconfig.php';
	$user_query = mysql_query('SELECT * FROM user WHERE username="'.$_SESSION['login_user'].'"');
	$user = mysql_fetch_array($user_query);
	// Insert quiz
	$title = $_POST['title'];
	$subject = $_POST['subject_level_0'];
	$link = $_POST['link'];
	$description = $_POST['description'];
	$userid = $user['id'];
	$sql = 'INSERT INTO video (title, subject, link, description, creator, date) VALUES("'.$title.'", "'.$subject.'", "'.$link.'","'.$description.'", "'.$userid.'","'.date('Y-m-d H:i:s').'")';
	if (!mysql_query($sql)) {
		die('Could not connect: ' . mysql_error());
	}
	mysql_close();
	header('Location: courses.php');
}
?>