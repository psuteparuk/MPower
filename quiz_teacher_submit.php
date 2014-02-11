<?php
//if (isset($_SESSION['login_user']) && !empty($_SESSION['login_user'])) {
	include 'db/dbconfig.php';
	$user_query = mysql_query('SELECT * FROM user WHERE username="'.$_SESSION['login_user'].'"');
	$user = mysql_fetch_array($user_query);
	// Insert quiz
	$title = $_POST['title'];
	$subjectlevel = $_POST['subjectlevel'];
	$subjectid = $_POST['subject_level_'.$subjectlevel];
	$noquestion = $_POST['noquestion'];
	$timelimit = 60*$_POST['timelimit_minute'] + $_POST['timelimit_second'];
	$sql = 'INSERT INTO quiz (title, subjectid, noquestion, datecreation, timelimit) VALUES("'.$title.'", "'.$subjectid.'", '.$noquestion.', "'.date('Y-m-d H:i:s').'", '.$timelimit.')';
	if (!mysql_query($sql)) {
		die('Could not connect: ' . mysql_error());
	}
	// Insert questions
	$quizid = mysql_insert_id();
	$indQuestions = $_POST['indQuestions'];
	foreach ($indQuestions as $ind) {
		$problem = $_POST['problem_input-'.$ind];
		$subjectid = $_POST['subsubject_input-'.$ind];
		$A = $_POST['choiceA_input-'.$ind];
		$B = $_POST['choiceB_input-'.$ind];
		$C = $_POST['choiceC_input-'.$ind];
		$D = $_POST['choiceD_input-'.$ind];
		$E = $_POST['choiceE_input-'.$ind];
		$answer = $_POST['answer_input-'.$ind];
		$explanation = $_POST['explanation_input-'.$ind];
		$time = 60*$_POST['time_minute_input-'.$ind] + $_POST['time_second_input-'.$ind];
		$sql = 'INSERT INTO question (quizid, problem, subjectid, A, B, C, D, E, answer, explanation, time) VALUES('.$quizid.', "'.$problem.'", "'.$subjectid.'", "'.$A.'", "'.$B.'", "'.$C.'", "'.$D.'", "'.$E.'", "'.$answer.'", "'.$explanation.'", '.$time.')';
		if (!mysql_query($sql)) {
			die('Could not connect: ' . mysql_error());
		}
	}
	mysql_close();
	header('Location: quiz.php');
//}
?>